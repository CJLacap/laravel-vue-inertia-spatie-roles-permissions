<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  pagination: Object
})
</script>

<template>
  <nav class="relative flex justify-center my-4">
    <template v-for="link in pagination.links" :key="link.label">
      <Link
        preserve-scroll
        :href="link.url ?? ''"
        v-html="link.label"
        class="flex items-center justify-items-center px-3 py-2 text-sm rounded-lg text-gray-600 dark:text-gray-400"
        :class="{'dark:bg-white bg-gray-500 text-white dark:text-gray-700' :link.active }"/>
    </template>
  </nav>
</template>
