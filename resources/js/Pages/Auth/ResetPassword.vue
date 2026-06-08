<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppNavbar from '@/Components/AppNavbar.vue';
import AppFooter from '@/Components/AppFooter.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

    <Head title="Override Cryptographic Password" />

    <div class="min-h-screen bg-[#030712] text-slate-100 font-jakarta relative overflow-hidden flex flex-col">

        <div class="absolute inset-0 bg-grid opacity-[0.08] pointer-events-none"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-blue-500/[0.04] rounded-full blur-[140px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-cyan-500/[0.03] rounded-full blur-[120px] pointer-events-none">
        </div>

        <AppNavbar />

        <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 py-12 select-none">

            <div class="w-full max-w-md">
                <div
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>

                    <header class="mb-6 text-center sm:text-left">
                        <div
                            class="inline-flex items-center gap-1.5 font-mono text-[9px] uppercase tracking-widest text-blue-400 mb-1">
                            <span class="h-1 w-1 rounded-full bg-blue-400 animate-pulse"></span>
                            Token Override Sequence
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-white">Re-assign <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Node
                                Credentials</span></h2>
                        <p class="text-slate-500 text-xs font-mono mt-0.5">Authorization token verified. Commit your new
                            key mapping array.</p>
                    </header>

                    <form @submit.prevent="submit" class="space-y-4">

                        <div class="space-y-1.5">
                            <InputLabel for="email" value="Target Account Coordinate"
                                class="text-[10px] font-mono tracking-wider text-slate-400 uppercase" />

                            <TextInput id="email" type="email"
                                class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                                v-model="form.email" required autofocus autocomplete="username"
                                placeholder="Input access routing coordinate..." />

                            <InputError class="mt-1 font-mono text-[11px] text-red-400" :message="form.errors.email" />
                        </div>

                        <div class="space-y-1.5">
                            <InputLabel for="password" value="New Vector Target Passphrase"
                                class="text-[10px] font-mono tracking-wider text-slate-400 uppercase" />

                            <TextInput id="password" type="password"
                                class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                                v-model="form.password" required autocomplete="new-password"
                                placeholder="Generate complex pass array..." />

                            <InputError class="mt-1 font-mono text-[11px] text-red-400"
                                :message="form.errors.password" />
                        </div>

                        <div class="space-y-1.5">
                            <InputLabel for="password_confirmation" value="Verify Vector Target Passphrase"
                                class="text-[10px] font-mono tracking-wider text-slate-400 uppercase" />

                            <TextInput id="password_confirmation" type="password"
                                class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                                v-model="form.password_confirmation" required autocomplete="new-password"
                                placeholder="Re-type key string to match parity..." />

                            <InputError class="mt-1 font-mono text-[11px] text-red-400"
                                :message="form.errors.password_confirmation" />
                        </div>

                        <div class="pt-2">
                            <PrimaryButton
                                class="w-full h-10 rounded-lg bg-blue-500 hover:bg-blue-400 disabled:bg-blue-500/20 disabled:text-blue-400/30 text-white border border-blue-600 shadow-md shadow-blue-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer disabled:cursor-not-allowed"
                                :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                {{ form.processing ? 'Updating Cipher Cache...' : 'Commit New Password Keys' }}
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <AppFooter />
    </div>
</template>

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