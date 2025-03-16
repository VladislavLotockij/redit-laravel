<template>
    <div class="bg-[#1a1a1a] p-4 shadow h-screen w-64 fixed top-20 left-0 border-r border-r-gray-300">
      <h2 class="text-white font-bold text-xl mb-4">Сообщества</h2>

      <!-- Проверяем, есть ли данные -->
      <ul v-if="subscribtionsUserCommunity.length > 0">
        <li
          v-for="community in subscribtionsUserCommunity"
          :key="community.id"
          class="text-white mb-2"
        >
          {{ community.name }}
        </li>
      </ul>

      <!-- Если данных нет -->
      <p v-else class="text-white">Вы не подписаны ни на одно сообщество.</p>
    </div>
  </template>

  <script setup lang="ts">
  import { usePage } from '@inertiajs/vue3';
  import { computed } from 'vue';

  interface Community {
    id: number;
    name: string;
  }

  const subscribtionsUserCommunity = computed(() => usePage().props.shareUserSubscriptions as Community[]);

  </script>