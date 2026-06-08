<script setup>
import { computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppNavbar from '@/Components/AppNavbar.vue';
import AppFooter from '@/Components/AppFooter.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>

<template>

    <Head title="Verify Identity Payload Matrix" />

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
                <div v-if="verificationLinkSent"
                    class="mb-5 p-3.5 rounded-xl border border-emerald-500/10 bg-emerald-500/[0.02] font-mono text-xs text-emerald-400 flex items-start gap-2 leading-relaxed">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping mt-1 shrink-0"></span>
                    <span>A new validation parity token stream has been dispatched to the destination address specified
                        during network alignment.</span>
                </div>

                <div
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 shadow-2xl relative overflow-hidden">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>

                    <header class="mb-5 text-center sm:text-left">
                        <div
                            class="inline-flex items-center gap-1.5 font-mono text-[9px] uppercase tracking-widest text-blue-400 mb-1">
                            <span class="h-1 w-1 rounded-full bg-blue-400 animate-pulse"></span>
                            Identity Verification Queue
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-white">Validate <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Node
                                Coordinates</span></h2>
                    </header>

                    <div
                        class="mb-6 p-3.5 rounded-xl border border-white/[0.03] bg-white/[0.01] font-mono text-[11px] text-slate-400 leading-relaxed">
                        <span class="text-slate-500 font-bold block mb-1 uppercase tracking-wider text-[9px]">Awaiting
                            Handshake:</span>
                        Registration request acknowledged. To finalize core data stream allocations, click the
                        validation coordinate link sent to your inbound communication node. Missing packet? Trigger an
                        on-demand retransmission array below.
                    </div>

                    <form @submit.prevent="submit">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 select-none pt-1">

                            <PrimaryButton
                                class="w-full sm:w-auto h-10 px-5 rounded-lg bg-blue-500 hover:bg-blue-400 disabled:bg-blue-500/20 disabled:text-blue-400/30 text-white border border-blue-600 shadow-md shadow-blue-500/5 font-mono text-xs font-bold tracking-wider uppercase transition-all flex items-center justify-center cursor-pointer disabled:cursor-not-allowed"
                                :class="{ 'opacity-50': form.processing }" :disabled="form.processing">
                                {{ form.processing ? 'Re-routing Packet...' : 'Resend Verification Token' }}
                            </PrimaryButton>

                            <Link :href="route('logout')" method="post" as="button"
                                class="w-full sm:w-auto font-mono text-[11px] text-slate-500 hover:text-red-400 transition-colors text-center py-2 sm:py-0 cursor-pointer">
                                Clear Session [Log Out]
                            </Link>
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