<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    todos: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    title: '',
    description: '',
});

const submitTodo = () => {
    form.post(route('todos.store'), {
        onSuccess: () => form.reset(),
    });
};

const toggleCompleted = (todo) => {
    const updateForm = useForm({
        is_completed: !todo.is_completed,
    });
    updateForm.put(route('todos.update', todo.id), {
        preserveScroll: true,
    });
};

const deleteTodo = (todo) => {
    if (confirm('Are you sure you want to delete this todo?')) {
        const deleteForm = useForm({});
        deleteForm.delete(route('todos.destroy', todo.id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Todos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Todo List</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submitTodo" class="mb-4">
                            <div class="flex gap-4">
                                <input
                                    v-model="form.title"
                                    type="text"
                                    placeholder="What needs to be done?"
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                    required
                                />
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
                                >
                                    Add Todo
                                </button>
                            </div>
                            <div v-if="form.errors.title" class="text-sm text-red-600 mt-2">{{ form.errors.title }}</div>
                        </form>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="todo in todos" :key="todo.id" class="p-6 flex items-center justify-between hover:bg-gray-50 transition">
                            <div class="flex items-center gap-4 cursor-pointer flex-1" @click="toggleCompleted(todo)">
                                <input
                                    type="checkbox"
                                    :checked="todo.is_completed"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer h-5 w-5"
                                    @click.stop="toggleCompleted(todo)"
                                />
                                <span :class="{'line-through text-gray-400': todo.is_completed, 'text-gray-900 font-medium': !todo.is_completed}">
                                    {{ todo.title }}
                                </span>
                            </div>
                            <button
                                @click="deleteTodo(todo)"
                                class="text-red-500 hover:text-red-700 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </li>
                        <li v-if="todos.length === 0" class="p-6 text-center text-gray-500">
                            No todos yet. Try adding one!
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
