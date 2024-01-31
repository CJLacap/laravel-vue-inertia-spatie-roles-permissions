<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingPostDeletion = ref(false);
const passwordInput = ref(null);

const props = defineProps({
  post: {
    type: Object,
    required: true
  }
});

const form = useForm({
    password: '',
});

const confirmPostDeletion = () => {
    confirmingPostDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deletePost = () => {
    form.delete(route('posts.destroy', props.post.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingPostDeletion.value = false;

    form.reset();
};
</script>

<template>
  <button @click="confirmPostDeletion"><slot/></button>

  <Modal :show="confirmingPostDeletion" @close="closeModal">
      <div class="p-6">
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
              Are you sure you want to delete this post?
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
              Once this post is deleted, all of its resources and data will be permanently deleted. Please
              enter your password to confirm you would like to permanently this post.
          </p>

          <div class="mt-6">
              <InputLabel for="password" value="Password" class="sr-only" />

              <TextInput
                  id="password"
                  ref="passwordInput"
                  v-model="form.password"
                  type="password"
                  class="mt-1 block w-3/4"
                  placeholder="Password"
                  @keyup.enter="deletePost"
              />

              <InputError :message="form.errors.password" class="mt-2" />
          </div>

          <div class="mt-6 flex justify-end">
              <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

              <DangerButton
                  class="ms-3"
                  @click="deletePost"
              >
                  Delete Post
              </DangerButton>
          </div>
      </div>
  </Modal>
</template>
