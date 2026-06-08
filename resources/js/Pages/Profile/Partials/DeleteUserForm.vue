<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};
</script>

<template>
    <section class="w-full">
        <div class="space-y-4">
            <p class="text-xs font-mono text-slate-400 leading-relaxed">
                Initiating this routine will execute a non-reversible wipe sequence. All hosted keys, configuration
                caches, and account ownership meta records will be dropped entirely from active system matrices.
            </p>

            <div class="pt-2 select-none">
                <DangerButton @click="confirmUserDeletion"
                    class="h-9 px-5 rounded-lg bg-red-500/10 hover:bg-red-500 text-red-400 hover:text-white border border-red-500/20 shadow-md shadow-red-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer">
                    Remove Identity Array
                </DangerButton>
            </div>
        </div>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div
                class="p-6 bg-[#0b0f19] border border-white/[0.08] rounded-2xl relative overflow-hidden font-jakarta text-slate-100">
                <div
                    class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-red-500/40 to-transparent">
                </div>

                <header class="select-none">
                    <h2
                        class="text-sm font-bold tracking-wider text-red-400 uppercase font-mono flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Confirm Remove Parameters
                    </h2>

                    <p class="mt-2 text-xs font-mono text-slate-400 leading-relaxed">
                        Are you certain you wish to terminate this account array? Please input your account access token
                        key to authorize structural platform allocation removal.
                    </p>
                </header>

                <div class="mt-5 space-y-1.5">
                    <InputLabel for="password" value="Verification Passphrase"
                        class="text-[10px] font-mono tracking-wider text-slate-500 uppercase" />

                    <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                        class="w-full bg-[#02050d] border border-white/[0.06] focus:border-red-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-700 focus:outline-none focus:ring-0 transition-all font-mono"
                        placeholder="Input account security key..." @keyup.enter="deleteUser" />

                    <InputError :message="form.errors.password" class="mt-1.5 font-mono text-xs text-red-400" />
                </div>

                <div class="mt-6 flex justify-end gap-3 select-none">
                    <SecondaryButton @click="closeModal"
                        class="h-9 px-4 rounded-lg bg-transparent hover:bg-white/[0.03] border border-white/[0.06] text-slate-400 hover:text-slate-200 font-mono text-xs font-medium transition-colors cursor-pointer">
                        Abort Sequence
                    </SecondaryButton>

                    <DangerButton
                        class="h-9 px-5 rounded-lg bg-red-500 hover:bg-red-400 disabled:bg-red-500/20 text-white border border-red-600 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="deleteUser">
                        {{ form.processing ? 'Purging Matrix...' : 'Authorize Execution' }}
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>