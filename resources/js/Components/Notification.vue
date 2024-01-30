<script setup>
import { ref, defineProps, onMounted, watch } from 'vue'


const props = defineProps({
  message: String
});


const showNotification = ref(false);

onMounted(() => {
  showNotification.value = true;
  setTimeout(() => showNotification.value = false, 2000);

});


</script>

<template>
  <div v-if="message && showNotification" class="flex items-center relative w-full p-4 mb-4 text-base leading-5 text-white bg-green-500 rounded-lg opacity-100 font-regular" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
      <span class="font-medium capitalize">{{ message }}</span>
    </div>
  </div>
</template>
