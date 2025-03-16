<template>
    <div>
      <h1>Создать новый пост</h1>
      <form @submit.prevent="submitForm">
        <!-- Поле для заголовка -->
        <div>
          <label for="title">Заголовок:</label>
          <input type="text" id="title" v-model="form.title" />
          <p v-if="form.errors.title">{{ form.errors.title }}</p>
        </div>

        <!-- Поле для содержания -->
        <div>
          <label for="content">Содержание:</label>
          <textarea id="content" v-model="form.content" rows="4"></textarea>
          <p v-if="form.errors.content">{{ form.errors.content }}</p>
        </div>

        <!-- Поле для выбора сообщества -->
        <div>
          <label for="community_id">Сообщество:</label>
          <select id="community_id" v-model="form.community_id">
            <option value="">Выберите сообщество</option>
            <option v-for="community in communities" :key="community.id" :value="community.id">
              {{ community.name }}
            </option>
          </select>
          <p v-if="form.errors.community_id">{{ form.errors.community_id }}</p>
        </div>

        <!-- Поле для загрузки изображения -->
        <div>
          <label for="image">Изображение:</label>
          <input type="file" id="image" @change="handleImageUpload" />
          <p v-if="form.errors.image">{{ form.errors.image }}</p>
        </div>

        <!-- Кнопка отправки формы -->
        <div>
          <button type="submit" :disabled="form.processing">Создать пост</button>
        </div>
      </form>
    </div>
</template>

<script setup lang="ts">
import { Community } from '@/types/types';
import { useForm } from '@inertiajs/vue3';

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
