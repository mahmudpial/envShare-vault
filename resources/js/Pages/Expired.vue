<template>
    <div class="min-h-screen bg-[#030712] text-slate-100 font-jakarta relative overflow-hidden flex flex-col">

        <div class="absolute inset-0 bg-grid opacity-[0.08] pointer-events-none"></div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-red-500/[0.04] rounded-full blur-[160px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-indigo-500/[0.03] rounded-full blur-[140px] pointer-events-none">
        </div>

        <AppNavbar />

        <div
            class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 py-16 text-center max-w-3xl mx-auto w-full">

            <div class="relative mb-8 select-none">
                <div
                    class="w-20 h-20 rounded-2xl bg-red-500/[0.02] border border-red-500/20 flex items-center justify-center mx-auto shadow-2xl shadow-red-500/5">
                    <svg class="w-9 h-9 text-red-400/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="absolute inset-0 rounded-2xl border border-red-500/10 animate-ping-slow"></div>
            </div>

            <div class="space-y-3 mb-10">
                <h1 class="text-3xl font-bold tracking-tight text-white">
                    Secret <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 via-rose-300 to-amber-300">Not
                        Found</span>
                </h1>
                <p class="text-slate-400 text-sm max-w-sm mx-auto leading-relaxed">
                    The requested data payload has been fully purged from live memory registers due to one of the
                    following compliance triggers:
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full max-w-xl mb-10">

                <div
                    class="glass-card rounded-xl border border-white/[0.04] bg-[#070b18]/40 p-4 text-left relative shadow-xl">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>
                    <div
                        class="w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mb-3">
                        <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-slate-300 font-mono uppercase tracking-wide">Accessed</p>
                    <p class="text-[11px] text-slate-500 font-mono mt-1 leading-normal">Volatile links self-destruct
                        instantly after standard read cycles.</p>
                </div>

                <div
                    class="glass-card rounded-xl border border-white/[0.04] bg-[#070b18]/40 p-4 text-left relative shadow-xl">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-amber-500/20 to-transparent">
                    </div>
                    <div
                        class="w-7 h-7 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mb-3">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-slate-300 font-mono uppercase tracking-wide">TTL Expired</p>
                    <p class="text-[11px] text-slate-500 font-mono mt-1 leading-normal">Staged memory pools are wiped
                        immediately post duration limit.</p>
                </div>

                <div
                    class="glass-card rounded-xl border border-white/[0.04] bg-[#070b18]/40 p-4 text-left relative shadow-xl">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-rose-500/20 to-transparent">
                    </div>
                    <div
                        class="w-7 h-7 rounded-lg bg-rose-500/10 border border-rose-500/20 flex items-center justify-center mb-3">
                        <svg class="w-3.5 h-3.5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-slate-300 font-mono uppercase tracking-wide">Zero Trace</p>
                    <p class="text-[11px] text-slate-500 font-mono mt-1 leading-normal">No database logs, caches, or
                        snapshots survive purge actions.</p>
                </div>
            </div>

            <div class="flex flex-col items-center gap-3 select-none">
                <a href="/"
                    class="inline-flex items-center justify-center gap-2 px-6 h-11 rounded-xl bg-blue-500 hover:bg-blue-400 text-white text-xs font-bold tracking-wider uppercase border border-blue-600 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Vector Array
                </a>

                <p class="text-[10px] font-mono uppercase tracking-widest text-slate-600">
                    Request sender to dispatch a secondary link session
                </p>
            </div>
        </div>

        <AppFooter />

    </div>
</template>

<script setup>
import AppNavbar from '@/Components/AppNavbar.vue'
import AppFooter from '@/Components/AppFooter.vue'
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

@keyframes ping-slow {
    0% {
        transform: scale(1);
        opacity: 0.4;
    }

    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

.animate-ping-slow {
    animation: ping-slow 2.5s cubic-bezier(0.16, 1, 0.3, 1) infinite;
}
</style>