<template>
    <div class="flex">
      <!-- Sidebar -->
      <div class="bg-[#1a1a1a] p-4 shadow h-screen w-64 fixed top-20 left-0 border-r border-r-gray-300">
        <h2 class="text-white font-bold text-xl mb-4">Сообщества</h2>
        <ul>
          <li v-for="community in communities" :key="community.id" class="text-white mb-2">
            <a href="#" class="hover:text-gray-400">{{ community.name }}</a>
          </li>
        </ul>
      </div>

      <!-- Основной контент -->
      <div class="ml-64 pt-20 p-4"> <!-- Увеличил отступ сверху на 20px -->
        <!-- Основной контент страницы -->
        <h1>Основной контент страницы</h1>
      </div>
    </div>
  </template>

  <script setup lang="ts">
  interface Community {
    id: number;
    name: string;
  }

  const communities: Community[] = [
    { id: 1, name: 'Программирование' },
    { id: 2, name: 'Кино' },
    { id: 3, name: 'Игры' },
  ];
  </script>
