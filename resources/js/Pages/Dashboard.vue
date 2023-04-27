<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MiniTodoForm from '@/Components/MainTodoForm.vue';
import TodoList from '@/Components/TodoList.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue'

const props = defineProps(['todos'])

const todosExist = computed(() => {
    return props.todos.length > 0
})

const newTodos = computed(() => {
    return props.todos.filter((todo) => {
        return todo.status == 'new'
    })
})

const inProgressTodos = computed(() => {
    return props.todos.filter((todo) => {
        return todo.status == 'in-progress'
    })
})

const doneTodos = computed(() => {
    return props.todos.filter((todo) => {
        return todo.status == 'done'
    })
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg=gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <MiniTodoForm />
                    </div>
                </div>
                <div
                    class="mx-3 sm:hidden"
                    v-if="todosExist"
                >
                    <TodoList title="Tasks" :todos="todos"/>
                </div>
                <div 
                    class="mx-3 hidden sm:grid grid-cols-3 gap-3 space-x-3 h-screen"
                    v-if="todosExist"
                >
                    <TodoList title="New" :todos="newTodos"/>
                    <TodoList title="In Progress" :todos="inProgressTodos"/>
                    <TodoList title="Done" :todos="doneTodos"/>
                </div>
                <div v-else class="text-center dark:bg-gray-800 overflow-hidden sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">No task created</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
