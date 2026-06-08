<template>

    <Head title="Identity Matrix Settings" />

    <div class="min-h-screen bg-[#030712] text-slate-100 font-jakarta relative overflow-hidden flex flex-col">

        <div class="absolute inset-0 bg-grid opacity-[0.08] pointer-events-none"></div>
        <div
            class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-indigo-500/[0.05] rounded-full blur-[160px] pointer-events-none">
        </div>
        <div
            class="absolute top-[20%] right-[-10%] w-[500px] h-[500px] bg-blue-600/[0.04] rounded-full blur-[140px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] left-[20%] w-[400px] h-[400px] bg-cyan-500/[0.03] rounded-full blur-[120px] pointer-events-none">
        </div>

        <AppNavbar />

        <div class="relative z-10 flex-1 w-full mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8 space-y-8">

            <div class="border-b border-white/[0.04] pb-6 select-none">
                <div
                    class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-widest text-blue-400 mb-1.5">
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                    Security Control Panel
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                    Identity <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-400">Settings
                        Matrix</span>
                </h1>
                <p class="text-slate-400 text-xs font-mono mt-1">Manage user record validation states, cryptographic
                    keys, and cluster access arrays.</p>
            </div>

            <div class="space-y-6">

                <div
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>

                    <div class="mb-6">
                        <h2
                            class="text-sm font-bold tracking-wider text-slate-200 uppercase font-mono flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile Information
                        </h2>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">Update your account's profile metadata and
                            primary authentication email coordinate.</p>
                    </div>

                    <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status"
                        class="max-w-2xl text-slate-300" />
                </div>

                <div
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-indigo-500/20 to-transparent">
                    </div>

                    <div class="mb-6">
                        <h2
                            class="text-sm font-bold tracking-wider text-slate-200 uppercase font-mono flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Update Credentials Key
                        </h2>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">Ensure your security profile utilizes a
                            lengthy, randomized pass key string sequence.</p>
                    </div>

                    <UpdatePasswordForm class="max-w-2xl text-slate-300" />
                </div>

                <div
                    class="glass-card rounded-2xl border border-red-500/10 bg-red-500/[0.01] p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-red-500/20 to-transparent">
                    </div>

                    <div class="mb-6">
                        <h2
                            class="text-sm font-bold tracking-wider text-red-400 uppercase font-mono flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Danger Zone / Remove Node
                        </h2>
                        <p class="text-xs text-slate-500 font-mono mt-0.5">Once this process is executed, all structural
                            active data arrays and references will be cleanly wiped.</p>
                    </div>

                    <DeleteUserForm class="max-w-2xl text-slate-300" />
                </div>

            </div>
        </div>

        <AppFooter />
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
import AppNavbar from '@/Components/AppNavbar.vue'
import AppFooter from '@/Components/AppFooter.vue'
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

.font-jakarta {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.glass-card {
    background: rgba(11, 17, 35, 0.45);
    backdrop-filter: blur(20px);
}

.bg-grid {
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
    background-size: 24px 24px;
}
</style>