<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section class="w-full">
        <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-5">
            <div class="space-y-1.5">
                <InputLabel for="name" value="User Handle Name"
                    class="text-xs font-mono tracking-wider text-slate-400 uppercase" />

                <TextInput id="name" type="text"
                    class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                    v-model="form.name" required autofocus autocomplete="name"
                    placeholder="Input array identification string..." />

                <InputError class="mt-1.5 font-mono text-xs text-red-400" :message="form.errors.name" />
            </div>

            <div class="space-y-1.5">
                <InputLabel for="email" value="Identity Routing Coordinate (Email)"
                    class="text-xs font-mono tracking-wider text-slate-400 uppercase" />

                <TextInput id="email" type="email"
                    class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                    v-model="form.email" required autocomplete="username"
                    placeholder="Input absolute routing address..." />

                <InputError class="mt-1.5 font-mono text-xs text-red-400" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null"
                class="rounded-xl border border-amber-500/10 bg-amber-500/[0.02] p-4">
                <p class="text-xs font-mono text-amber-400/90 leading-relaxed flex items-start gap-2">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>
                        Identity routing address validation token unassigned.
                        <Link :href="route('verification.send')" method="post" as="button"
                            class="block mt-1 text-slate-300 underline underline-offset-2 hover:text-white transition-colors cursor-pointer text-left font-bold">
                            Dispatch activation sequence packet →
                        </Link>
                    </span>
                </p>

                <div v-show="status === 'verification-link-sent'"
                    class="mt-3 text-xs font-mono font-bold text-emerald-400 flex items-center gap-1.5">
                    <span class="w-1 h-1 rounded-full bg-emerald-400 animate-ping"></span>
                    Verification array payload pushed to destination mailbox.
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2 select-none">
                <PrimaryButton :disabled="form.processing"
                    class="h-9 px-5 rounded-lg bg-blue-500 hover:bg-blue-400 disabled:bg-blue-500/20 disabled:text-blue-400/30 text-white border border-blue-600 shadow-md shadow-blue-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer disabled:cursor-not-allowed">
                    {{ form.processing ? 'Syncing...' : 'Commit Changes' }}
                </PrimaryButton>

                <Transition enter-active-class="transition duration-300 ease-out"
                    enter-from-class="opacity-0 translate-x-2" leave-active-class="transition duration-200 ease-in"
                    leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful"
                        class="text-xs font-mono text-emerald-400 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        State synchronized.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>