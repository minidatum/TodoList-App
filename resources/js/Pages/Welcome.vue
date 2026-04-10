<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome to TodoList" />

    <div class="min-h-screen bg-slate-50 font-sans selection:bg-indigo-500 selection:text-white">
        <!-- Navigation -->
        <nav class="absolute top-0 w-full z-50 transition duration-300 ease-in-out px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-xl text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900 tracking-tight">FocusFlow</span>
                </div>
                
                <div v-if="canLogin" class="flex gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="px-5 py-2.5 rounded-full bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-200"
                    >
                        Go to Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="px-5 py-2.5 rounded-full text-gray-700 font-medium hover:text-indigo-600 transition"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-5 py-2.5 rounded-full bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 hover:-translate-y-0.5"
                        >
                            Start for free
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <!-- Decorative Gradients -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 text-center">
                <h1 class="mx-auto max-w-4xl font-display text-5xl font-extrabold tracking-tight text-slate-900 sm:text-7xl">
                    Master your day with <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-cyan-500">FocusFlow</span>
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg tracking-tight text-slate-600 leading-relaxed">
                    A beautifully minimal, yet powerful Todo list application designed to keep your mind clear and your tasks organized. Experience seamless task management like never before.
                </p>
                <div class="mt-10 flex justify-center gap-x-6">
                    <Link
                        v-if="!$page.props.auth.user"
                        :href="route('register')"
                        class="rounded-full bg-indigo-600 px-8 py-3.5 text-sm font-semibold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-500 hover:scale-105 transition duration-300 ease-out flex items-center gap-2"
                    >
                        Get Started Free
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </Link>
                    <Link
                        v-else
                        :href="route('dashboard')"
                        class="rounded-full bg-indigo-600 px-8 py-3.5 text-sm font-semibold text-white shadow-xl shadow-indigo-200 hover:bg-indigo-500 hover:scale-105 transition duration-300 ease-out"
                    >
                        Return to your Todos
                    </Link>
                </div>
            </div>
            
            <!-- Floating Dashboard Preview (Abstract) -->
            <div class="mt-16 sm:mt-24 lg:mt-32 max-w-5xl mx-auto px-6 lg:px-8">
                <div class="rounded-2xl bg-white/40 ring-1 ring-white/60 backdrop-blur-xl p-2 shadow-2xl overflow-hidden">
                    <div class="rounded-xl border border-gray-100 bg-white shadow-sm p-8 h-64 flex flex-col items-center justify-center relative overflow-hidden group">
                        <!-- Simulated App UI -->
                        <div class="w-full max-w-lg space-y-4 relative z-10">
                            <div class="h-10 w-full rounded-lg bg-gray-50 flex items-center px-4 border border-indigo-100 shadow-sm">
                                <span class="text-gray-400 text-sm">Add a new task...</span>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-white rounded-lg shadow-sm border border-gray-100 group-hover:-translate-y-1 transition duration-300">
                                <div class="w-5 h-5 rounded-md border-2 border-indigo-500"></div>
                                <span class="text-gray-700 font-medium select-none">Finish reviewing pull requests</span>
                                <div class="ml-auto w-16 h-2 bg-gray-100 rounded"></div>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-white rounded-lg shadow-sm border border-gray-100 opacity-60">
                                <div class="w-5 h-5 rounded-md border-2 border-green-500 bg-green-500 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span class="text-gray-400 font-medium line-through">Morning coffee run</span>
                            </div>
                        </div>
                        
                        <!-- Abstract Gradient Blob -->
                        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                        <div class="absolute -left-20 -top-20 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Grid -->
        <div class="bg-white py-24 sm:py-32 border-t border-gray-100">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600">Productivity Amplified</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need to get things done</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-3 lg:gap-y-16">
                        
                        <!-- Feature 1 -->
                        <div class="relative pl-16 group">
                            <dt class="text-base font-semibold leading-7 text-gray-900 group-hover:text-indigo-600 transition">
                                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 group-hover:bg-indigo-600 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                                Lightning Fast Inline Edits
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Double click any task to edit it right then and there. No clunky modals or page reloads to slow down your workflow.</dd>
                        </div>
                        
                        <!-- Feature 2 -->
                        <div class="relative pl-16 group">
                            <dt class="text-base font-semibold leading-7 text-gray-900 group-hover:text-cyan-600 transition">
                                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-xl bg-cyan-50 group-hover:bg-cyan-600 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600 group-hover:text-white transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </div>
                                Magic Auto-Save
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">The moment you stop typing and click away, your data is securely persisted to the server. Never lose your progress.</dd>
                        </div>

                        <!-- Feature 3 -->
                        <div class="relative pl-16 group">
                            <dt class="text-base font-semibold leading-7 text-gray-900 group-hover:text-indigo-600 transition">
                                <div class="absolute left-0 top-0 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 group-hover:bg-indigo-600 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white transition duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                Secure & Private Design
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Powered by Laravel Breeze. Your data is isolated, protected by modern encryption, and fully visible only to you.</dd>
                        </div>

                    </dl>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-50 py-12 border-t border-gray-200">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <span class="font-semibold text-gray-700">FocusFlow</span>
                </div>
                <div class="text-sm text-gray-400">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }}) <span class="mx-2">&bull;</span> Built with ✨
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
/* Font overrides if default isn't looking good enough */
.font-display {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}
</style>
