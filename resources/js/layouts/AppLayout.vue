<template>
    <div class="min-h-screen bg-[#1a1a1a]">
      <!-- Шапка -->
      <AppHeader />

      <div class="container mx-auto flex gap-4 p-4">
        <!-- Основное содержимое -->
        <main class="flex-1">
          <slot />
        </main>

        <!-- Сайдбар -->
        <aside class="w-64">
          <AppSidebar />
        </aside>
      </div>
    </div>
  </template>

  <script setup lang="ts">
  import AppHeader from '@/components/AppHeader.vue';
import AppSidebar from '@/components/AppSidebar.vue';
  </script>