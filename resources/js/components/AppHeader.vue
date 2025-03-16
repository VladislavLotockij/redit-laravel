<template>
    <header class="bg-[#1a1a1a] shadow border-b border-b-gray-300 w-full">
      <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Логотип -->
        <Link href="/">
          <div class="flex items-center space-x-2">
            <img src="/assets/logo.svg" alt="Logo" class="h-[30px]" />
            <span class="text-xl font-bold">Reddit Clone</span>
          </div>
        </Link>

        <!-- Поиск -->
        <input
          type="text"
          placeholder="Поиск..."
          class="px-4 py-2 border border-[#3333] rounded-lg bg-[#333333] w-80 focus:border-black-500 focus:outline-none "
        />

        <!-- Навигация -->
        <nav>
          <ul class="flex space-x-4 cursor-pointer text-white-500 hover:nounderline ">
            <li class="hover:text-gray-400">
              <a href="/posts/create" class="flex items-center space-x-2">
                <img src="/assets/plus-icon.svg" alt="Plus" class="h-[30px] w-[30px]" />
                <span>Создать пост</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
  </template>

  <script setup lang="ts">
  import { Link } from '@inertiajs/vue3';
  </script>
