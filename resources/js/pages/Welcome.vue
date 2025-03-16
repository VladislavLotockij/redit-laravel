<template>
    <AppLayout :communities="communities">
      <div class="bg-black">
        <!-- Ваш контент -->
      </div>
    </AppLayout>
  </template>

  <script setup lang="ts">
  import AppLayout from '@/layouts/AppLayout.vue';
  import { usePage } from '@inertiajs/vue3';
  import { computed } from 'vue';

  interface Community {
    id: number;
    name: string;
  }

  // Используем данные из shareUserSubscriptions
  const communities = computed(() => usePage().props.shareUserSubscriptions as Community[]);
  </script>