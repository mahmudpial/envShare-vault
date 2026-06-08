<template>
    <div class="min-h-screen bg-[#030712] text-slate-100 font-jakarta relative overflow-hidden flex flex-col">

        <div class="absolute inset-0 bg-grid opacity-[0.08] pointer-events-none"></div>
        <div
            class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-indigo-500/[0.06] rounded-full blur-[160px] pointer-events-none">
        </div>
        <div
            class="absolute top-0 left-1/3 w-[300px] h-[300px] bg-cyan-500/[0.04] rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[10%] right-[-5%] w-[500px] h-[500px] bg-blue-600/[0.05] rounded-full blur-[140px] pointer-events-none">
        </div>

        <AppNavbar badge="My Secrets" badge-color="bg-blue-400" />

        <div
            class="relative z-10 flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col justify-start">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-10">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-200 to-cyan-400">Dashboard</span>
                    </h1>
                    <p class="text-slate-400 text-sm max-w-md leading-relaxed">
                        Track telemetry signatures, monitor active lifetimes, or immediately force de-allocation cycles
                        on staged secrets.
                    </p>
                </div>
                <a href="/"
                    class="inline-flex items-center justify-center gap-2 px-5 h-10 rounded-lg bg-blue-500 hover:bg-blue-400 text-white text-xs font-bold tracking-wider uppercase border border-blue-600 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20 transition-all shrink-0 self-start sm:self-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Secret
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                <div class="glass-card rounded-xl border border-white/[0.04] p-4 bg-[#070b18]/40 shadow-xl relative">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-slate-500/10 to-transparent">
                    </div>
                    <p class="text-[10px] font-mono tracking-wider uppercase text-slate-500 mb-1">Total Staged</p>
                    <p class="text-2xl font-bold tracking-tight text-white font-mono">{{ stats.total }}</p>
                </div>
                <div class="glass-card rounded-xl border border-white/[0.04] p-4 bg-[#070b18]/40 shadow-xl relative">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent">
                    </div>
                    <p class="text-[10px] font-mono tracking-wider uppercase text-slate-500 mb-1">Active Memory</p>
                    <p class="text-2xl font-bold tracking-tight text-emerald-400 font-mono">{{ stats.active }}</p>
                </div>
                <div class="glass-card rounded-xl border border-white/[0.04] p-4 bg-[#070b18]/40 shadow-xl relative">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>
                    <p class="text-[10px] font-mono tracking-wider uppercase text-slate-500 mb-1">Purged Ops</p>
                    <p class="text-2xl font-bold tracking-tight text-blue-400 font-mono">{{ stats.destroyed }}</p>
                </div>
                <div class="glass-card rounded-xl border border-white/[0.04] p-4 bg-[#070b18]/40 shadow-xl relative">
                    <div
                        class="absolute -top-px left-4 right-4 h-px bg-gradient-to-r from-transparent via-amber-500/20 to-transparent">
                    </div>
                    <p class="text-[10px] font-mono tracking-wider uppercase text-slate-500 mb-1">Expired TTL</p>
                    <p class="text-2xl font-bold tracking-tight text-amber-400 font-mono">{{ stats.expired }}</p>
                </div>
            </div>

            <div
                class="flex items-center bg-[#040814] border border-white/[0.06] p-0.5 rounded-xl select-none mb-6 self-start">
                <button v-for="tab in tabs" :key="tab.value" @click="activeTab = tab.value"
                    class="px-4 py-1.5 rounded-lg text-[11px] font-mono font-medium tracking-wide uppercase transition-all flex items-center gap-2"
                    :class="activeTab === tab.value
                        ? 'bg-white/[0.06] text-white border border-white/[0.06] shadow'
                        : 'text-slate-500 hover:text-slate-300 border border-transparent'">
                    {{ tab.label }}
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono"
                        :class="activeTab === tab.value ? 'bg-blue-500/20 text-blue-400' : 'bg-white/[0.02] text-slate-600'">
                        {{ tab.count }}
                    </span>
                </button>
            </div>

            <div v-if="filteredSecrets.length === 0"
                class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/20 p-16 text-center shadow-2xl">
                <div
                    class="w-12 h-12 rounded-xl bg-white/[0.02] border border-white/[0.06] flex items-center justify-center mx-auto mb-4">
                    <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-medium">No Secret Vectors Documented</p>
                <p class="text-slate-600 text-xs font-mono mt-1.5">
                    {{ activeTab === 'all' ? 'Initiate a secure transfer session to fill buffer.' : `No items marked as
                    [${activeTab}].` }}
                </p>
            </div>

            <div v-else class="space-y-4">
                <div v-for="secret in filteredSecrets" :key="secret.token"
                    class="glass-card rounded-xl border border-white/[0.04] bg-[#070b18]/20 p-5 hover:border-white/[0.08] hover:bg-[#070b18]/30 transition-all shadow-lg relative group">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                        <div class="flex items-start gap-4 min-w-0">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5 transition-colors"
                                :class="{
                                    'bg-emerald-500/10 border border-emerald-500/20': secret.status === 'active',
                                    'bg-blue-500/10 border border-blue-500/20': secret.status === 'destroyed',
                                    'bg-amber-500/10 border border-amber-500/20': secret.status === 'expired',
                                }">
                                <svg v-if="secret.status === 'active'" class="w-4 h-4 text-emerald-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <svg v-else-if="secret.status === 'destroyed'" class="w-4 h-4 text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <svg v-else class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div class="min-w-0 space-y-2">
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <span class="text-sm font-mono text-slate-200 truncate select-all tracking-wide">
                                        {{ secret.token.substring(0, 16) }}...
                                    </span>
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-mono uppercase tracking-wider border"
                                        :class="{
                                            'bg-emerald-500/10 border-emerald-500/15 text-emerald-400': secret.status === 'active',
                                            'bg-blue-500/10 border-blue-500/15 text-blue-400': secret.status === 'destroyed',
                                            'bg-amber-500/10 border-amber-500/15 text-amber-400': secret.status === 'expired',
                                        }">
                                        {{ secret.status }}
                                    </span>
                                    <span v-if="secret.has_password"
                                        class="px-2 py-0.5 rounded text-[10px] font-mono uppercase tracking-wider border bg-white/[0.02] border-white/[0.06] text-slate-400 flex items-center gap-1">
                                        <span>🔑</span> pass-locked
                                    </span>
                                </div>

                                <div
                                    class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs font-mono text-slate-500">
                                    <span>Init: {{ secret.created_at }}</span>
                                    <span class="text-slate-700">·</span>
                                    <span v-if="secret.viewed_at">Opened: {{ secret.viewed_at }}</span>
                                    <span v-else-if="secret.status === 'active'">TTL: {{ secret.expires_at }}</span>
                                    <span class="text-slate-700">·</span>
                                    <span>Ops: {{ secret.view_count }}/{{ secret.max_views }} reads</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0 self-end md:self-center">
                            <button v-if="secret.status === 'active'" @click="copySecretLink(secret.token)"
                                class="px-3 h-8 rounded-lg bg-[#040814] border border-white/[0.06] hover:border-white/[0.12] text-xs font-mono text-slate-400 hover:text-slate-200 transition-colors">
                                {{ copiedToken === secret.token ? '✓ Copied' : 'Copy URL' }}
                            </button>

                            <a v-if="secret.audit_token" :href="`/audit/${secret.audit_token}`"
                                class="inline-flex items-center justify-center px-3 h-8 rounded-lg bg-purple-500/10 hover:bg-purple-500/15 border border-purple-500/20 text-xs font-mono text-purple-400 transition-colors">
                                Audit
                            </a>

                            <button @click="confirmDelete(secret.token)"
                                class="px-3 h-8 rounded-lg bg-red-500/10 hover:bg-red-500/15 border border-red-500/20 text-xs font-mono text-red-400 transition-colors">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showSuccessModal"
            class="fixed inset-0 bg-black/80 backdrop-blur-md flex items-center justify-center z-50 px-4">
            <div
                class="glass-card rounded-2xl p-6 sm:p-8 w-full max-w-xl space-y-6 border border-white/[0.06] bg-[#070b18]/90 shadow-2xl relative">
                <div
                    class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent">
                </div>

                <div class="text-center space-y-2">
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-tight">Cryptographic Memory Initialized</h3>
                    <p class="text-slate-400 text-xs">Decryption pathways and tokens generated cleanly.</p>
                </div>

                <div class="border-t border-white/[0.04]"></div>

                <div class="space-y-4">
                    <div class="space-y-2">
                        <div
                            class="flex items-center justify-between text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            <span class="flex items-center gap-1.5"><span
                                    class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Share Link</span>
                            <span class="text-slate-600">Volatile Entrypoint</span>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-[#040814] border border-white/[0.06] rounded-xl p-2 pl-4">
                            <span class="text-blue-400 text-xs font-mono flex-1 truncate select-all">{{
                                generatedShareUrl }}</span>
                            <button @click="copyFlashedLink('share')"
                                class="shrink-0 px-3.5 h-9 rounded-lg bg-blue-500/10 hover:bg-blue-500/15 border border-blue-500/20 text-blue-400 text-xs font-semibold transition-all min-w-[75px]">
                                {{ modalCopiedShare ? '✓ Saved' : 'Copy' }}
                            </button>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div
                            class="flex items-center justify-between text-[10px] font-mono uppercase tracking-widest text-slate-400">
                            <span class="flex items-center gap-1.5"><span
                                    class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>Telemetry Audit Link</span>
                            <span class="text-slate-600">Private Signature</span>
                        </div>
                        <div
                            class="flex items-center gap-2 bg-[#040814] border border-purple-500/15 rounded-xl p-2 pl-4">
                            <span class="text-purple-300 text-xs font-mono flex-1 truncate select-all">{{
                                generatedAuditUrl }}</span>
                            <button @click="copyFlashedLink('audit')"
                                class="shrink-0 px-3.5 h-9 rounded-lg bg-purple-500/10 hover:bg-purple-500/15 border border-purple-500/20 text-purple-400 text-xs font-semibold transition-all min-w-[75px]">
                                {{ modalCopiedAudit ? '✓ Saved' : 'Copy' }}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/[0.04]"></div>

                <button @click="closeSuccessModal"
                    class="w-full h-11 rounded-xl border border-white/[0.05] bg-white/[0.01] hover:bg-white/[0.03] text-slate-300 font-medium text-xs tracking-wide transition-colors">
                    Dismiss to Dashboard Terminal
                </button>
            </div>
        </div>

        <div v-if="deleteToken"
            class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 px-4">
            <div
                class="glass-card rounded-2xl p-6 w-full max-w-sm space-y-5 border border-white/[0.06] bg-[#070b18]/90 shadow-2xl relative">
                <div
                    class="absolute -top-px left-6 right-6 h-px bg-gradient-to-r from-transparent via-red-500/20 to-transparent">
                </div>

                <div
                    class="w-11 h-11 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-white tracking-tight">Revoke Cryptographic Memory?</h3>
                    <p class="text-slate-400 text-xs leading-relaxed mt-1">This event completely obliterates the active
                        payload and associated entry strings from regional cache. Action is absolute and irreversible.
                    </p>
                </div>
                <div class="flex gap-3">
                    <button @click="deleteToken = null"
                        class="flex-1 h-10 rounded-lg border border-white/[0.05] bg-white/[0.01] hover:bg-white/[0.03] text-slate-400 hover:text-white text-xs font-medium tracking-wide transition-colors">
                        Cancel
                    </button>
                    <button @click="deleteSecret"
                        class="flex-1 h-10 rounded-lg bg-red-500 hover:bg-red-400 text-white text-xs font-bold tracking-wider uppercase border border-red-600 shadow-lg shadow-red-500/10 transition-all">
                        Purge Vector
                    </button>
                </div>
            </div>
        </div>

        <AppFooter />

    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AppNavbar from '@/Components/AppNavbar.vue'
import AppFooter from '@/Components/AppFooter.vue'

const props = defineProps({
    secrets: Array,
    stats: Object,
})

const page = usePage()
const activeTab = ref('all')
const deleteToken = ref(null)
const copiedToken = ref(null)

// Flash presentation tracking states
const showSuccessModal = ref(false)
const modalCopiedShare = ref(false)
const modalCopiedAudit = ref(false)

const tabs = computed(() => [
    { label: 'All Vectors', value: 'all', count: props.stats.total },
    { label: 'Active', value: 'active', count: props.stats.active },
    { label: 'Purged', value: 'destroyed', count: props.stats.destroyed },
    { label: 'Expired', value: 'expired', count: props.stats.expired },
])

const filteredSecrets = computed(() => {
    if (activeTab.value === 'all') return props.secrets
    return props.secrets.filter(s => s.status === activeTab.value)
})

const generatedShareUrl = computed(() => {
    const token = page.props.flash?.token
    return token ? `${window.location.origin}/s/${token}` : ''
})

const generatedAuditUrl = computed(() => {
    const audit = page.props.flash?.audit_token
    return audit ? `${window.location.origin}/audit/${audit}` : ''
})

onMounted(() => {
    if (page.props.flash?.token) {
        showSuccessModal.value = true
    }
})

const copySecretLink = async (token) => {
    await navigator.clipboard.writeText(`${window.location.origin}/s/${token}`)
    copiedToken.value = token
    setTimeout(() => (copiedToken.value = null), 2000)
}

const copyFlashedLink = async (type) => {
    if (type === 'share') {
        await navigator.clipboard.writeText(generatedShareUrl.value)
        modalCopiedShare.value = true
        setTimeout(() => (modalCopiedShare.value = false), 2000)
    } else if (type === 'audit') {
        await navigator.clipboard.writeText(generatedAuditUrl.value)
        modalCopiedAudit.value = true
        setTimeout(() => (modalCopiedAudit.value = false), 2000)
    }
}

const closeSuccessModal = () => {
    showSuccessModal.value = false
    if (page.props.flash) {
        page.props.flash.token = null
        page.props.flash.audit_token = null
    }
}

const confirmDelete = (token) => {
    deleteToken.value = token
}

const deleteSecret = () => {
    router.delete(`/dashboard/secrets/${deleteToken.value}`, {
        onSuccess: () => { deleteToken.value = null },
    })
}
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