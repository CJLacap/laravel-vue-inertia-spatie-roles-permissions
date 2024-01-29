<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import DeleteUserModal from './Partials/DeleteUserModal.vue';

defineProps(['users'])


</script>

<template>
  <Head title="Users" />

  <AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
        Users
    </template>

    <div class="max-w-7xl mx-auto py-4 lg:px-8">
      <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-slate-200">Users Index</h1>
        <Link :href="route('users.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          New User
        </Link>
      </div>

      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Name</TableHeaderCell>
              <TableHeaderCell>Email</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="user in users" :key="user.id" class="border-b">
              <TableDataCell>{{ user.id }}</TableDataCell>
              <TableDataCell>{{ user.name }}</TableDataCell>
              <TableDataCell>{{ user.email }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link :href="route('users.edit', user.id)" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-15">Edit</Link>
                <!-- <Link :href="route('users.destroy', user.id)" method="DELETE" as="button" class="text-red-400 hover:text-red-600">Delete</Link> -->
                <DeleteUserModal :user="user">Delete</DeleteUserModal>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>
