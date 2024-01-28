<script setup>

</script>

<template>
  <div class="bg-white dark:bg-gray-800 text-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
    <div class=" max-w-7xl relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <slot name="header"></slot>
        </thead>
        <tbody>
          <slot></slot>
        </tbody>
      </table>
    </div>
</div>
</template>
