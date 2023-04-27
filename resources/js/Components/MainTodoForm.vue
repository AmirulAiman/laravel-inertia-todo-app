<template>
    <form @submit.prevent="submit">
        <div class="mt-3">
            <InputLabel for="task" value="Task" />

            <TextInput id="task" type="text" class="mt-1 block w-full" v-model="form.task" required/>
            <InputError class="mt-2" :message="form.errors.task" />
        </div>
        <div class="mt-3">
            <InputLabel for="detail" value="Details" />
            <TextareaInput id="detail" class="mt-1 block w-full" v-model="form.detail" />
            <InputError class="mt-2" :message="form.errors.detail" />
        </div>
        <div class="flex mt-4">
            <div class="flex items-center justify-start mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.completed" />
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Completed</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="mx-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </PrimaryButton>
                <Link :href="route('todo.create')"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 hover:text-gray-200 dark:bg-gray-800 border border-transparent rounded-md font-semibold text-xs dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Add Details
                </Link>
            </div>
        </div>
    </form>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue'

const form = useForm({
    task: '',
    detail: '',
    completed: false
})

const submit = () => {
    form.post(route('todo.store'), {
        onFinish: () => form.reset({
            task: '',
            detail: '',
            completed: false
        })
    })
}

</script>