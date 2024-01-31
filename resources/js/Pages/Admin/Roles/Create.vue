<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Multiselect} from 'vue-multiselect';

defineProps({
  permissions: Array,
});

const form = useForm({
    name: '',
    permissions: []
});

</script>

<template>
  <Head title="Create New Role" />

  <AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
        Create Role
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('roles.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          Back
        </Link>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-gray-600 dark:text-slate-200">New Role</h1>
        <form @submit.prevent="form.post(route('roles.store'))">
          <div class="mt-4">
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
            <InputLabel for="permissions" value="Permissions" />

            <Multiselect
            v-model="form.permissions"
            :options="permissions"
            :multiple="true"
            :close-on-select="false"
            placeholder="Choose permissions"
            label="name"
            track-by="id"
            id="permissions"
          ></Multiselect>
          </div>

          <div class="flex items-center mt-4">
              <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Create
              </PrimaryButton>
          </div>
      </form>
      </div>
    </div>
  </AdminLayout>
</template>
