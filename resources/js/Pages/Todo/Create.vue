<template>
    <Head title="Create Todo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg=gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit">
                            <div class="mt-3">
                                <InputLabel for="task" value="Task" />

                                <TextInput id="task" type="text" class="mt-1 block w-full" v-model="form.task" required
                                    autofocus />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="mt-3">
                                <InputLabel for="detail" value="Details" />
                                <TextareaInput id="detail" class="mt-1 block w-full" v-model="form.detail" />
                            </div>
                            <div class="mt-3">
                                <InputLabel for="status" value="Status"/>
                                <select 
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="status" 
                                    id="status" 
                                    required 
                                    v-model="form.status"
                                >
                                    <option value="">-- Select Status--</option>
                                    <option 
                                        :value="opt.value"
                                        :key="index"
                                        v-for="(opt,index) in status"
                                    >{{ opt.label }}</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <InputLabel for="due_date" value="Due Date"/>
                                <TextInput id="due_date" type="date" class="mt-1 block w-full" v-model="form.due_date"/>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="mx-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'

const status = ref([
    {'label': 'New', 'value':'new'},
    {'label': 'In Progress', 'value':'in-progress'},
    {'label': 'Done', 'value':'done'}
]);
const form = useForm({
    task: '',
    detail: '',
    due_date: '',
    status: 'new'
})

const submit = () => {
    form.post(route('todo.store'), {
        onFinish: () => {
            form.reset('task', 'detail', 'due_date', 'status')
            alert('Task created')
        }
    })
}

</script>