<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import DeleteUserModal from './Partials/DeleteUserModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import {Multiselect} from 'vue-multiselect';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import { onMounted, watch } from 'vue';


const props = defineProps({
  user: {
    type: Object,
    required: true
  },
  roles: Array,
  permissions: Array,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    roles: [],
    permissions: [],
});

onMounted(() => {
  form.roles = props.user?.roles;
  form.permissions = props.user?.permissions;
});

watch(
  () => props.user,
  () =>{
    form.roles = props.user?.roles
    form.permissions = props.user?.permissions
  }
)

</script>

<template>
  <Head title="Update User" />

  <AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
        Update User
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('users.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          Back
        </Link>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <form @submit.prevent="form.patch(route('users.update', user))">
          <div>
              <InputLabel for="name" value="Name" />

              <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                  autofocus
                  autocomplete="name"
              />

              <InputError class="mt-2" :message="form.errors.name" />
          </div>
          <div class="mt-4">
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />

            <div class="mt-4">
              <InputLabel for="roles" value="Roles" />
              <Multiselect
              v-model="form.roles"
              :options="roles"
              :multiple="true"
              :close-on-select="false"
              placeholder="Choose roles"
              label="name"
              track-by="id"
              id="roles"
              ></Multiselect>
            </div>

            <div class="mt-4">
              <InputLabel for="permissions" value="Permissions" />
              <Multiselect
              v-model="form.permissions"
              :options="permissions"
              :multiple="true"
              :close-on-select="false"
              placeholder="Choose roles"
              label="name"
              track-by="id"
              id="permissions"
              ></Multiselect>
            </div>
        </div>

          <div class="flex items-center mt-4">
              <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Update
              </PrimaryButton>
          </div>
      </form>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-200 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-slate-200 mb-4">Roles</h1>
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="userRoles in user.roles" :key="userRoles.id" class="border-b">
              <TableDataCell>{{ userRoles.id }}</TableDataCell>
              <TableDataCell>{{ userRoles.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link :href="route('users.roles.destroy', [user, userRoles])"
                method="DELETE" as="button" class="text-red-400 hover:text-red-600" preserve-scroll>
                  Revoke
                </Link>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-200 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-slate-200 mb-4">Permissions</h1>
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="userPermission in user.permissions" :key="userPermission.id" class="border-b">
              <TableDataCell>{{ userPermission.id }}</TableDataCell>
              <TableDataCell>{{ userPermission.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link :href="route('users.permissions.destroy', [user, userPermission])"
                method="DELETE" as="button" class="text-red-400 hover:text-red-600" preserve-scroll>
                  Revoke
                </Link>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <header class="mb-6">
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Delete Account</h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
              your account, please download any data or information that you wish to retain.
          </p>
      </header>
      <DeleteUserModal :user="user"><DangerButton>Delete User Account</DangerButton></DeleteUserModal>
      </div>



    </div>
  </AdminLayout>
</template>
