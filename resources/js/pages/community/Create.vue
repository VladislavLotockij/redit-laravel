<template>
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <h2 class="text-center text-3xl font-extrabold text-gray-900">
                    Создать новое комьюнити
                </h2>
                <form @submit.prevent="submit" class="mt-8 space-y-6">
                    <div>
                        <label for="name" class="sr-only">Название комьюнити</label>
                        <input id="name" v-model="form.name" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Название комьюнити">
                    </div>
                    <div>
                        <label for="description" class="sr-only">Описание</label>
                        <textarea id="description" v-model="form.description" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Описание"></textarea>
                    </div>
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Создать комьюнити
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'; // Или '@inertiajs/inertia-vue3' для старой версии

const form = useForm({
    name: '',
    description: '',
});

const submit = () => {
    try {
        console.log(route('community.store')); // Проверка маршрута
        form.post(route('community.store'), {
            onSuccess: () => form.reset(),
            onError: (errors) => {
                console.error('Ошибка при отправке формы:', errors);
            },
        });
    } catch (error) {
        console.error('Ошибка:', error);
    }
};
</script>