<template>
    <AppLayout :communities="communities">
      <div class="max-w-2xl mx-auto p-6 bg-[#1a1a1a] border border-gray-600 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-white mb-6">Создать новый пост</h1>

        <!-- Форма -->
        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Поле для заголовка -->
          <div>
            <label for="title" class="block text-sm font-medium text-gray-300">Заголовок:</label>
            <input
              type="text"
              id="title"
              v-model="form.title"
              class="mt-1 block w-full px-4 py-2 bg-[#2a2a2a] border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500"
            />
            <p v-if="form.errors.title" class="mt-2 text-sm text-red-500">{{ form.errors.title }}</p>
          </div>

          <!-- Поле для содержания -->
          <div>
            <label for="content" class="block text-sm font-medium text-gray-300">Содержание:</label>
            <textarea
              id="content"
              v-model="form.content"
              rows="4"
              class="mt-1 block w-full px-4 py-2 bg-[#2a2a2a] border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500"
            ></textarea>
            <p v-if="form.errors.content" class="mt-2 text-sm text-red-500">{{ form.errors.content }}</p>
          </div>

          <!-- Поле для выбора сообщества -->
          <div>
            <label for="community_id" class="block text-sm font-medium text-gray-300">Сообщество:</label>
            <select
              id="community_id"
              v-model="form.community_id"
              class="mt-1 block w-full px-4 py-2 bg-[#2a2a2a] border border-gray-600 rounded-md text-white focus:ring-2 focus:ring-blue-500"
            >
              <option value="" disabled>Выберите сообщество</option>
              <option
                v-for="community in communities"
                :key="community.id"
                :value="community.id"
                class="bg-[#2a2a2a]"
              >
                {{ community.name }}
              </option>
            </select>
            <p v-if="form.errors.community_id" class="mt-2 text-sm text-red-500">{{ form.errors.community_id }}</p>
          </div>

          <!-- Поле для загрузки изображения -->
          <div>
            <label for="image" class="block text-sm font-medium text-gray-300">Изображение:</label>
            <input
              type="file"
              id="image"
              @change="handleImageUpload"
              class="mt-1 block w-full text-white"
            />
            <p v-if="form.errors.image" class="mt-2 text-sm text-red-500">{{ form.errors.image }}</p>
          </div>

          <!-- Кнопка отправки формы -->
          <div>
            <button
              type="submit"
              :disabled="form.processing"
              class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50"
            >
              <span v-if="form.processing">Создание...</span>
              <span v-else>Создать пост</span>
            </button>
          </div>
        </form>
      </div>
    </AppLayout>
  </template>

  <script setup lang="ts">
  import { useForm } from '@inertiajs/vue3';
  import AppLayout from '@/layouts/AppLayout.vue';
  import { Community } from '@/types/types';

  interface PostForm {
    title: string;
    content: string;
    community_id: number | null;
    image: File | null;
    [key: string]: any;
  }

  const { communities } = defineProps<{ communities: Community[] }>();

  const form = useForm<PostForm>({
    title: '',
    content: '',
    community_id: null,
    image: null,
  });

  const handleImageUpload = (event: Event) => {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files[0]) {
      form.image = input.files[0];
    }
  };

  const submitForm = () => {
    form.post(route('posts.store'), {
      onSuccess: () => {
        form.reset();
      },
      onError: (errors) => {
        console.error('Ошибка при создании поста:', errors);
      },
    });
  };
  </script>