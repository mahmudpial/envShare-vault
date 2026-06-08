<template>
    <div class="min-h-screen bg-[#080c14] text-white font-jakarta relative overflow-hidden">

        <div class="absolute inset-0 bg-grid opacity-20 pointer-events-none"></div>
        <div
            class="absolute top-[-8rem] left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-blue-600/8 rounded-full blur-[120px] pointer-events-none">
        </div>

        <AppNavbar badge="Audit Trail" badge-color="bg-purple-400" />

        <div class="relative z-10 max-w-3xl mx-auto px-4 py-12">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-2">
                    <div
                        class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-white">Secret Audit Log</h1>
                        <p class="text-xs text-slate-500">All activity recorded for this secret link</p>
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-3 gap-3 mb-6">
                <div class="glass-card rounded-xl p-4">
                    <p class="text-xs text-slate-500 mb-1">Total Events</p>
                    <p class="text-2xl font-bold text-white">{{ logs.length }}</p>
                </div>
                <div class="glass-card rounded-xl p-4">
                    <p class="text-xs text-slate-500 mb-1">Successful Views</p>
                    <p class="text-2xl font-bold text-emerald-400">{{ viewedCount }}</p>
                </div>
                <div class="glass-card rounded-xl p-4">
                    <p class="text-xs text-slate-500 mb-1">Failed Attempts</p>
                    <p class="text-2xl font-bold text-red-400">{{ failedCount }}</p>
                </div>
            </div>

            <!-- Secret Status -->
            <div class="glass-card rounded-xl px-5 py-3 mb-6 flex items-center gap-3"
                :class="exists ? 'border border-emerald-500/10' : 'border border-red-500/10'">
                <div class="w-2 h-2 rounded-full" :class="exists ? 'bg-emerald-400' : 'bg-red-400'"></div>
                <p class="text-sm" :class="exists ? 'text-emerald-400' : 'text-red-400'">
                    {{ exists ? 'Secret is still active' : 'Secret has been destroyed' }}
                </p>
            </div>

            <!-- No Logs -->
            <div v-if="logs.length === 0" class="glass-card rounded-2xl p-12 text-center">
                <div
                    class="w-14 h-14 rounded-2xl bg-white/3 border border-white/8 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-medium">No activity yet</p>
                <p class="text-slate-600 text-xs mt-1">Events will appear here when the link is opened</p>
            </div>

            <!-- Log Table -->
            <div v-else class="glass-card rounded-2xl overflow-hidden">
                <div class="px-5 py-4 border-b border-white/5 flex items-center justify-between">
                    <h2 class="text-sm font-medium text-slate-300">Activity Timeline</h2>
                    <span class="text-xs text-slate-600">{{ logs.length }} event{{ logs.length !== 1 ? 's' : ''
                    }}</span>
                </div>

                <div class="divide-y divide-white/4">
                    <div v-for="log in logs" :key="log.id" class="px-5 py-4 hover:bg-white/2 transition-colors">
                        <div class="flex items-start justify-between gap-4">
                            <!-- Event badge + info -->
                            <div class="flex items-start gap-3">
                                <!-- Icon -->
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5" :class="{
                                    'bg-emerald-500/10 border border-emerald-500/20': log.event === 'viewed',
                                    'bg-red-500/10 border border-red-500/20': log.event === 'failed_password',
                                    'bg-amber-500/10 border border-amber-500/20': log.event === 'expired',
                                }">
                                    <!-- Viewed icon -->
                                    <svg v-if="log.event === 'viewed'" class="w-4 h-4 text-emerald-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Failed icon -->
                                    <svg v-else-if="log.event === 'failed_password'" class="w-4 h-4 text-red-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <!-- Expired icon -->
                                    <svg v-else class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>

                                <div>
                                    <!-- Event label -->
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-sm font-medium" :class="{
                                            'text-emerald-400': log.event === 'viewed',
                                            'text-red-400': log.event === 'failed_password',
                                            'text-amber-400': log.event === 'expired',
                                        }">
                                            {{ eventLabel(log.event) }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-full text-xs border" :class="{
                                            'bg-emerald-500/10 border-emerald-500/20 text-emerald-400': log.event === 'viewed',
                                            'bg-red-500/10 border-red-500/20 text-red-400': log.event === 'failed_password',
                                            'bg-amber-500/10 border-amber-500/20 text-amber-400': log.event === 'expired',
                                        }">
                                            {{ log.event }}
                                        </span>
                                    </div>

                                    <!-- Details -->
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9" />
                                            </svg>
                                            {{ log.ip_address }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2" />
                                            </svg>
                                            {{ log.device }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                                            </svg>
                                            {{ log.browser }} · {{ log.os }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Time -->
                            <span class="text-xs text-slate-600 shrink-0 mt-1">{{ log.time }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back link -->
            <div class="text-center mt-8">
                <a href="/"
                    class="text-sm text-blue-400 hover:text-blue-300 transition-colors underline underline-offset-4">
                    Create a new secret →
                </a>
            </div>

        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import AppNavbar from '@/Components/AppNavbar.vue'

const props = defineProps({
    logs: Array,
    exists: Boolean,
})

const viewedCount = computed(() =>
    props.logs.filter(l => l.event === 'viewed').length
)

const failedCount = computed(() =>
    props.logs.filter(l => l.event === 'failed_password').length
)

const eventLabel = (event) => {
    const map = {
        viewed: 'Secret Viewed',
        failed_password: 'Wrong Password',
        expired: 'Link Expired',
    }
    return map[event] || event
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

.font-jakarta {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.glass-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(12px);
}

.bg-grid {
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 40px 40px;
}
</style>