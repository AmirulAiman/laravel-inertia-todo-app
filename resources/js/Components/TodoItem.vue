<template>
    <div 
    class="dark:bg-gray-800 overflow-hidden shadow-sm sm:shadow-lg rounded-md sm:rounded-lg mb-6 mx-3 py-6 px-4"
    :class="statusBg"
    v-on:dblclick="completed"
    >
    <div class="flex justify-between items-center w-fill">
            <Link 
                :href="route('todo.edit', todo.id)"
            >
                <h1 class="font-semibold sm:font-bold font-[Poppins] text-xl sm:text-lg">{{ todo.task }}</h1>
                <span class="font-[Poppins] text-sm sm:text-md overflow-hidden" v-if="todo.task.length > 0">{{ todo.detail }}</span>
            </Link>
        </div>
    </div>
</template>

<script setup>
    import { Link, useForm } from '@inertiajs/vue3';
    import { computed, ref } from 'vue'

    const props = defineProps(['todo'])

    const form = useForm({...props.todo})

    const completed = () => {
        form.status = form.status != 'done' ? 'done' : 'new'
        form.patch(route('todo.update',props.todo.id))
    }

    const statusBg = computed(() => {
        switch (props.todo.status) {
            case 'in-progress':
                return 'bg-orange-200 text-orange-800 hover:bg-orange-400 hover:text-orange-200'
                break;
            case 'done':
                return 'bg-green-200 hover:bg-green-400 text-green-800 hover:text-green-200 line-through'
                break;
            default:
                return 'bg-white text-gray-800 hover:bg-gray-200 text-gray-600'
                break;
        }
    })
</script>