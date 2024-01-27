<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Dashboard" />

  <AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
        Admin Dashboard
    </template>

    <div class="py-4">
      <h1>Welcome to Admin Dashboard</h1>
    </div>
  </AdminLayout>
</template>
