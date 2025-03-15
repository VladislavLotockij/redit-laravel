<template>
    <div class="max-w-2xl mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
      <h1 class="text-2xl font-bold mb-6">Создать новый пост</h1>
      <form @submit.prevent="submitForm" class="space-y-4">
        <!-- Поле для заголовка -->
        <div>
          <label for="title" class="block text-sm font-medium text-gray-300">Заголовок:</label>
          <input
            type="text"
            id="title"
            v-model="form.title"
            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
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
            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
          ></textarea>
          <p v-if="form.errors.content" class="mt-2 text-sm text-red-500">{{ form.errors.content }}</p>
        </div>

        <!-- Поле для выбора сообщества -->
        <div>
          <label for="community_id" class="block text-sm font-medium text-gray-300">Сообщество:</label>
          <select
            id="community_id"
            v-model="form.community_id"
            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            <option value="">Выберите сообщество</option>
            <option v-for="community in communities" :key="community.id" :value="community.id">
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
            class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"
          />
          <p v-if="form.errors.image" class="mt-2 text-sm text-red-500">{{ form.errors.image }}</p>
        </div>

        <!-- Кнопка отправки формы -->
        <div>
          <button
            type="submit"
            :disabled="form.processing"
            class="inline-flex justify-center py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
          >
            Создать пост
          </button>
        </div>
      </form>
    </div>
  </template>

  <script setup lang="ts">
  import { Community } from '@/types/types';
  import { useForm } from '@inertiajs/vue3';

  // Определяем тип для данных формы
  interface PostForm {
    title: string;
    content: string;
    community_id: number | null;
    image: File | null;
    [key: string]: any; // Добавляем индексную сигнатуру
  }

  // Получаем пропсы
  const { communities } = defineProps<{
    communities: Community[];
  }>();

  // Создаем реактивную форму с использованием useForm из Inertia.js
  const form = useForm<PostForm>({
    title: '',
    content: '',
    community_id: null,
    image: null,
  });

  // Обработка загрузки изображения
  const handleImageUpload = (event: Event) => {
    const input = event.target as HTMLInputElement;
    if (input.files && input.files[0]) {
      form.image = input.files[0];
    }
  };

  // Функция для отправки формы
  const submitForm = () => {
    form.post(route('posts.store'), {
      onSuccess: () => {
        // Очищаем форму после успешной отправки
        form.reset();
      },
      onError: (errors) => {
        console.error('Ошибка при создании поста:', errors);
      },
    });
  };
  </script>