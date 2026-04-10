<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue';

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
    // Jangan ubah status toggle jika sedang dalam mode edit
    if (editingTodoId.value === todo.id) return;
    
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

// State dan fungsi untuk Edit Inline
const editingTodoId = ref(null);
const editTitle = ref('');
const editInputs = ref({});

const startEditing = async (todo) => {
    if (todo.is_completed) return; // Optional: Jangan izinkan edit jika sudah selesai

    editingTodoId.value = todo.id;
    editTitle.value = todo.title;
    
    await nextTick();
    if (editInputs.value[todo.id]) {
        editInputs.value[todo.id].focus();
    }
};

const saveEdit = (todo) => {
    // Hindari penyimpanan ganda dari onBlur & onEnter
    if (editingTodoId.value !== todo.id) return;
    
    const newTitle = editTitle.value.trim();
    
    // Jika ada perubahan pada teksnya, maka request ke server (auto-save)
    if (newTitle && newTitle !== todo.title) {
        const updateForm = useForm({
            title: newTitle,
            description: todo.description,
        });
        updateForm.put(route('todos.update', todo.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                editingTodoId.value = null;
            }
        });
    } else {
        // Jika teks sama atau kosong, cukup batalkan mode edit
        editingTodoId.value = null;
    }
};

const cancelEdit = () => {
    editingTodoId.value = null;
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
                <!-- Form Tambah Todo -->
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
                        
                        <p class="text-sm text-gray-500 italic mt-2">💡 Tip: Double-click a todo text to edit it.</p>
                    </div>
                </div>

                <!-- Daftar Todo -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul class="divide-y divide-gray-200">
                        <li v-for="todo in todos" :key="todo.id" class="p-6 flex items-center justify-between hover:bg-gray-50 transition min-h-[80px]">
                            
                            <!-- Bagian Kiri: Checkbox & Title -->
                            <div class="flex items-center gap-4 flex-1">
                                <input
                                    type="checkbox"
                                    :checked="todo.is_completed"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 cursor-pointer h-5 w-5"
                                    @change="toggleCompleted(todo)"
                                />
                                
                                <!-- Mode Edit Form (Input) -->
                                <input
                                    v-if="editingTodoId === todo.id"
                                    :ref="(el) => { if(el) editInputs[todo.id] = el }"
                                    v-model="editTitle"
                                    @blur="saveEdit(todo)"
                                    @keydown.enter="saveEdit(todo)"
                                    @keydown.esc="cancelEdit"
                                    class="flex-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-3 py-1 mr-4"
                                    type="text"
                                />
                                
                                <!-- Mode Normal (Teks) -->
                                <span 
                                    v-else
                                    @dblclick="startEditing(todo)"
                                    :title="todo.is_completed ? '' : 'Double click to edit'"
                                    :class="{
                                        'line-through text-gray-400': todo.is_completed, 
                                        'text-gray-900 font-medium cursor-text': !todo.is_completed
                                    }"
                                    class="flex-1 select-none py-1 mr-4 transition-colors"
                                >
                                    {{ todo.title }}
                                </span>
                            </div>
                            
                            <!-- Bagian Kanan: Delete Button -->
                            <button
                                @click="deleteTodo(todo)"
                                class="text-red-500 hover:text-red-700 transition opacity-60 hover:opacity-100 p-2"
                                title="Delete Todo"
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
