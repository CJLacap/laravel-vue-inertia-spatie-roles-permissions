<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import DeleteRoleModal from './Partials/DeleteRoleModal.vue';

defineProps(['roles'])
</script>

<template>
  <Head title="Roles" />

  <AdminLayout>
    <!--Nav Header-->
    <template #nav_header>
        Roles
    </template>

    <div class="max-w-7xl mx-auto py-4 lg:px-8">
      <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-600 dark:text-slate-200">Roles Index</h1>
        <Link :href="route('roles.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          Add Role
        </Link>
      </div>

      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="role in roles" :key="role.id" class="border-b">
              <TableDataCell>{{ role.id }}</TableDataCell>
              <TableDataCell>{{ role.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link :href="route('roles.edit', role.id)" class="text-sky-400 hover:text-sky-600">Edit</Link>
                <DeleteRoleModal :role="role"><p class="text-red-400 hover:text-red-600">Delete</p></DeleteRoleModal>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>
