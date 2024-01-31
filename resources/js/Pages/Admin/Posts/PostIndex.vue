<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import { usePermission } from '@/Composables/permissions';
import Table from '@/Components/Table.vue';
import TableRow from '@/Components/TableRow.vue';
import TableHeaderCell from '@/Components/TableHeaderCell.vue';
import TableDataCell from '@/Components/TableDataCell.vue';
import DeletePostModal from './Partials/DeletePostModal.vue';


defineProps(['posts'])

const { hasPermission } = usePermission();
</script>

<template>
  <Head title="Posts" />

  <AdminLayout>
    <!--Nav Header-->
    <template #nav_header>
        Posts
    </template>

    <div class="max-w-7xl mx-auto py-4 lg:px-8">
      <div class="flex justify-between">
        <h1 class="text-2xl font-medium text-gray-600 dark:text-slate-200">Posts Index</h1>
        <template v-if="hasPermission('create post')">
          <Link :href="route('posts.create')" class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
            New Post
          </Link>
        </template>
      </div>

      <div class="mt-6">
        <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>ID</TableHeaderCell>
              <TableHeaderCell>Title</TableHeaderCell>
              <TableHeaderCell>Action</TableHeaderCell>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="post in posts" :key="post.id" class="border-b">
              <TableDataCell>{{ post.id }}</TableDataCell>
              <TableDataCell>{{ post.title }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <template v-if="hasPermission('update post')">
                  <Link :href="route('posts.edit', post)" class="text-sky-400 hover:text-sky-600">Edit</Link>
                </template>
                <template v-if="hasPermission('delete post')">
                  <DeletePostModal :post="post"><p class="text-red-400 hover:text-red-600">Delete</p></DeletePostModal>
                </template>
              </TableDataCell>
            </TableRow>
          </template>
        </Table>
      </div>
    </div>
  </AdminLayout>
</template>
