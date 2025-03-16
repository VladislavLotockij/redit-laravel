<template>
    <div class="bg-[#1a1a1a] p-4 rounded-lg shadow">
      <div class="flex items-center space-x-2 mb-2">
        <span class="text-sm text-gray-500">r/{{ post.community }}</span>
        <span class="text-sm text-gray-500">•</span>
        <span class="text-sm text-gray-500">Автор: {{ post.user }}</span>
      </div>
      <h2 class="text-xl font-bold">{{ post.title }}</h2>
      <p class="text-gray-700">{{ post.content }}</p>
    </div>
  </template>

  <script setup lang="ts">
  interface Post {
    id: number;
    title: string;
    content: string;
    community: string;
    user: string;
  }

  defineProps<{
    post: Post;
  }>();
  </script>