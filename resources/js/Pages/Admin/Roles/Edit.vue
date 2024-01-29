<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Multiselect} from 'vue-multiselect';


const props = defineProps({
  role: {
    type: Object,
    required: true,
  },
  permissions: Array,
});

const form = useForm({
  name: props.role.name,
  permissions: [],
});




</script>

<template>
  <Head title="Edit Role" />

  <AdminLayout>
     <!--Nav Header-->
     <template #nav_header>
      Add Role
    </template>

    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link :href="route('roles.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
          Back
        </Link>
      </div>

      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 dark:bg-gray-800 shadow-lg rounded-lg p-6">
        <form @submit.prevent="form.put(route('roles.update', role.id))">
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
                  Update
              </PrimaryButton>
          </div>
      </form>
      </div>
    </div>
  </AdminLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
<style>
.multiselect__tags {
  @apply border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm
}
.multiselect__input{
  @apply dark:bg-gray-900 dark:text-gray-300
}
.multiselect__input::placeholder{
  @apply dark:text-gray-300
}
.multiselect__element{
  @apply dark:bg-gray-900 dark:text-gray-300
}
</style>
