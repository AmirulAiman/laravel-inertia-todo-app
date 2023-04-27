<template>
    <div class="bg-white rounded-lg h-fill min-h-1/12 px-3 py-2 border-1">
        <h1 class="font-bold text-lg underline fonr-[Poppins] text-gray-800 mb-6">{{ title }}</h1>
        <TodoItem 
            v-for="todo in todos"
            :key="todo.id"
            :todo="todo"
        />
    </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3';
import TodoItem from '@/Components/TodoItem.vue'

const props = defineProps(['title', 'todos'])

</script>