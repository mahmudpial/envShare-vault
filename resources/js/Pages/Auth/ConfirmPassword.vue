<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppNavbar from '@/Components/AppNavbar.vue';
import AppFooter from '@/Components/AppFooter.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>

    <Head title="Security Key Challenge Matrix" />

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
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-amber-500/20 to-transparent">
                    </div>

                    <header class="mb-5 text-center sm:text-left">
                        <div
                            class="inline-flex items-center gap-1.5 font-mono text-[9px] uppercase tracking-widest text-amber-400 mb-1">
                            <span class="h-1 w-1 rounded-full bg-amber-400 animate-pulse"></span>
                            Cryptographic Challenge Gate
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-white">Re-Authenticate <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-400">Node
                                Access</span></h2>
                    </header>

                    <div
                        class="mb-6 p-3.5 rounded-xl border border-amber-500/10 bg-amber-500/[0.01] font-mono text-[11px] text-slate-400 leading-relaxed">
                        <span class="text-amber-500 font-bold block mb-1 uppercase tracking-wider text-[9px]">Protected
                            Core Array:</span>
                        You are entering a secure perimeter of the ecosystem layout. Confirm your primary database
                        access passphrase before dispatching command variables.
                    </div>

                    <form @submit.prevent="submit" class="space-y-4">

                        <div class="space-y-1.5">
                            <InputLabel for="password" value="Confirm Node Key Passphrase"
                                class="text-[10px] font-mono tracking-wider text-slate-400 uppercase" />

                            <TextInput id="password" type="password"
                                class="w-full bg-[#02050d] border border-white/[0.06] focus:border-amber-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                                v-model="form.password" required autocomplete="current-password" autofocus
                                placeholder="Stipulate authorization password..." />

                            <InputError class="mt-1 font-mono text-[11px] text-red-400"
                                :message="form.errors.password" />
                        </div>

                        <div class="pt-2">
                            <PrimaryButton
                                class="w-full h-10 rounded-lg bg-amber-500 hover:bg-amber-400 disabled:bg-amber-500/20 disabled:text-amber-400/30 text-slate-950 border border-amber-600 shadow-md shadow-amber-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer disabled:cursor-not-allowed"
                                :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                {{ form.processing ? 'Verifying Credentials...' : 'Unlock Perimeter Area' }}
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