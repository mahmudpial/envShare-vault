<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section class="w-full">
        <form @submit.prevent="updatePassword" class="space-y-5">

            <div class="space-y-1.5">
                <InputLabel for="current_password" value="Current Master Key"
                    class="text-xs font-mono tracking-wider text-slate-400 uppercase" />

                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                    type="password"
                    class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                    autocomplete="current-password" placeholder="Stipulate active credentials secret..." />

                <InputError :message="form.errors.current_password" class="mt-1.5 font-mono text-xs text-red-400" />
            </div>

            <div class="space-y-1.5">
                <InputLabel for="password" value="New Vector Target Key"
                    class="text-xs font-mono tracking-wider text-slate-400 uppercase" />

                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                    autocomplete="new-password" placeholder="Generate complex dynamic key stream..." />

                <InputError :message="form.errors.password" class="mt-1.5 font-mono text-xs text-red-400" />
            </div>

            <div class="space-y-1.5">
                <InputLabel for="password_confirmation" value="Verify Vector Target Key"
                    class="text-xs font-mono tracking-wider text-slate-400 uppercase" />

                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="w-full bg-[#02050d] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                    autocomplete="new-password" placeholder="Re-type key stream to match parity..." />

                <InputError :message="form.errors.password_confirmation"
                    class="mt-1.5 font-mono text-xs text-red-400" />
            </div>

            <div class="flex items-center gap-4 pt-2 select-none">
                <PrimaryButton :disabled="form.processing"
                    class="h-9 px-5 rounded-lg bg-blue-500 hover:bg-blue-400 disabled:bg-blue-500/20 disabled:text-blue-400/30 text-white border border-blue-600 shadow-md shadow-blue-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer disabled:cursor-not-allowed">
                    {{ form.processing ? 'Re-encrypting...' : 'Rotate Key' }}
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
                        Encryption updated.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>