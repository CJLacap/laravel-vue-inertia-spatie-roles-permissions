<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import DeletePermissionModal from './Partials/DeletePermissionModal.vue';

defineProps(['permissions'])
</script>

<template>
	<Head title="Permissions"/>

	<AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
        Permissions
    </template>

    <div class="max-w-7xl mx-auto py-4 lg:px-8">
      <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-slate-200">Permissions Index</h1>
        <Link :href="route('permissions.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          New Permission
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
            <TableRow v-for="permission in permissions" :key="permission.id" class="border-b">
              <TableDataCell>{{ permission.id }}</TableDataCell>
              <TableDataCell>{{ permission.name }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <Link :href="route('permissions.edit', permission.id)" class="text-sky-400 hover:text-sky-600">Edit</Link>
                <DeletePermissionModal :permission="permission"><p class="text-red-400 hover:text-red-600">Delete</p></DeletePermissionModal>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
	</AdminLayout>
</template>
