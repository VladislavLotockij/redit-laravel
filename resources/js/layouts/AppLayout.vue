<template>
  <div class="min-h-screen bg-[#1a1a1a]">
    <!-- Шапка -->
    <AppHeader />

    <div class="container mx-auto flex gap-4 p-4 pt-20"> <!-- pt-20 для отступа под хедер -->
      <!-- Основное содержимое -->
      <main class="flex-1">
        <slot />
      </main>

      <!-- Сайдбар -->
      <aside class="w-64">
        <AppSidebar :communities="communities" />
      </aside>
    </div>
  </div>
</template>

  <script setup lang="ts">
  import AppHeader from '@/components/AppHeader.vue';
import AppSidebar from '@/components/AppSidebar.vue';
defineProps({
  communities: {
    type: Array as () => { id: number; name: string }[],
    required: true,
  },
});
  </script>