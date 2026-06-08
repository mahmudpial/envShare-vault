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

        <AppNavbar :badge="badgeText" badge-color="bg-emerald-400" />

        <div
            class="relative z-10 flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col justify-center">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start" :class="{ 'dir-rtl': !isLeftAligned }">

                <div class="lg:col-span-5 space-y-6 lg:sticky lg:top-24" :class="{ 'dir-ltr': !isLeftAligned }">

                    <div class="space-y-4">
                        <div
                            class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-gradient-to-r from-blue-500/10 to-indigo-500/10 border border-blue-500/15 text-blue-400 font-mono text-[10px] tracking-widest uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                            Zero-Knowledge Cryptography
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold tracking-tight text-white leading-[1.15]">
                            Secure Environment <br />
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-200 to-cyan-400">
                                Payload Transfer
                            </span>
                        </h1>
                        <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                            Input runtime configuration arrays, raw strings, or API pairs. Outputs highly volatile,
                            self-destructing links engineered with end-to-end AES-256 local decryption tokens.
                        </p>
                    </div>

                    <div v-if="!generatedToken"
                        class="glass-card rounded-xl border border-white/[0.04] p-5 space-y-5 bg-[#070b18]/40 shadow-2xl relative">
                        <div
                            class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                        </div>

                        <h2
                            class="text-xs font-bold tracking-widest text-slate-500 uppercase font-mono flex items-center gap-2 pb-2 border-b border-white/[0.04]">
                            <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Configuration Parameters
                        </h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[11px] font-medium text-slate-400 tracking-wide">TTL Duration</label>
                                <div class="relative">
                                    <select v-model="form.expires_in"
                                        class="w-full bg-[#0b0f19] border border-white/[0.06] hover:border-white/[0.12] rounded-lg px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500/50 transition-all cursor-pointer appearance-none font-mono">
                                        <option value="5m">5 Minutes</option>
                                        <option value="15m">15 Minutes</option>
                                        <option value="30m">30 Minutes</option>
                                        <option value="1h">1 Hour</option>
                                        <option value="12h">12 Hours</option>
                                        <option value="24h">24 Hours / 1 Day</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-medium text-slate-400 tracking-wide">Access
                                    Threshold</label>
                                <div class="relative">
                                    <select v-model="form.max_views"
                                        class="w-full bg-[#0b0f19] border border-white/[0.06] hover:border-white/[0.12] rounded-lg px-3 py-2 text-xs text-slate-200 focus:outline-none focus:border-blue-500/50 transition-all cursor-pointer appearance-none font-mono">
                                        <option value="1">1 View (Strict)</option>
                                        <option value="2">2 Views</option>
                                        <option value="3">3 Views</option>
                                        <option value="5">5 Views</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-500">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-medium text-slate-400 tracking-wide flex items-center justify-between">
                                <span>Cryptographic Passphrase</span>
                                <span class="text-slate-600 text-[10px] font-mono">Optional</span>
                            </label>
                            <div class="relative">
                                <input v-model="form.password" :type="showPassword ? 'text' : 'password'"
                                    placeholder="Stipulate access PIN or hash..."
                                    class="w-full bg-[#0b0f19] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-3 py-2 text-xs text-slate-200 placeholder-slate-600 focus:outline-none transition-all pr-10 font-mono" />
                                <button @click="showPassword = !showPassword" type="button"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path v-if="!showPassword" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[11px] font-medium text-slate-400 tracking-wide flex items-center justify-between">
                                <span>De-allocation Callback Email</span>
                                <span class="text-slate-600 text-[10px] font-mono">Optional</span>
                            </label>
                            <input v-model="form.notify_email" type="email" placeholder="security@company.com"
                                class="w-full bg-[#0b0f19] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-3 py-2 text-xs text-slate-200 placeholder-slate-600 focus:outline-none transition-all font-mono" />
                        </div>
                    </div>

                    <div
                        class="glass-card rounded-xl border border-white/[0.04] p-4 bg-[#070b18]/20 flex items-center justify-between shadow-lg">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            <span class="text-[11px] font-mono text-slate-400 tracking-wider uppercase">Workspace
                                Layout</span>
                        </div>
                        <div class="flex bg-[#040814] border border-white/[0.06] p-0.5 rounded-lg select-none">
                            <button @click="isLeftAligned = true"
                                class="px-3 py-1 rounded-md text-[10px] font-mono font-medium tracking-wide uppercase transition-all"
                                :class="isLeftAligned ? 'bg-blue-500 text-white shadow' : 'text-slate-500 hover:text-slate-300'">
                                Left-Bound
                            </button>
                            <button @click="isLeftAligned = false"
                                class="px-3 py-1 rounded-md text-[10px] font-mono font-medium tracking-wide uppercase transition-all"
                                :class="!isLeftAligned ? 'bg-blue-500 text-white shadow' : 'text-slate-500 hover:text-slate-300'">
                                Right-Bound
                            </button>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 lg:mt-32 transition-all duration-300" :class="{ 'dir-ltr': !isLeftAligned }">

                    <div v-if="generatedToken"
                        class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 space-y-6 shadow-2xl relative">
                        <div
                            class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent">
                        </div>

                        <div class="flex items-center gap-3.5 pb-5 border-b border-white/[0.04]">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-white tracking-tight">Secret Array Deployed</h2>
                                <p class="text-xs text-slate-500">Secure cryptographic paths initialized successfully.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2.5">
                                <div
                                    class="flex items-center justify-between text-[10px] font-mono uppercase tracking-widest text-slate-400">
                                    <span class="flex items-center gap-2"><span
                                            class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>Share Link</span>
                                    <span class="text-slate-600">Volatile Entrypoint</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 bg-[#040814] border border-white/[0.06] rounded-xl p-2 pl-4">
                                    <span class="text-blue-400 text-xs font-mono flex-1 truncate select-all">{{ shareUrl
                                        }}</span>
                                    <button @click="copyLink"
                                        class="shrink-0 px-3.5 h-9 rounded-lg bg-blue-500/10 hover:bg-blue-500/15 border border-blue-500/20 text-blue-400 text-xs font-semibold transition-all min-w-[75px]">
                                        {{ copied ? '✓ Saved' : 'Copy' }}
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2.5" v-if="auditToken">
                                <div
                                    class="flex items-center justify-between text-[10px] font-mono uppercase tracking-widest text-slate-400">
                                    <span class="flex items-center gap-2"><span
                                            class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>Telemetry Audit
                                        Link</span>
                                    <span class="text-slate-600">Private Signature</span>
                                </div>
                                <div
                                    class="flex items-center gap-2 bg-[#040814] border border-purple-500/15 rounded-xl p-2 pl-4">
                                    <span class="text-purple-300 text-xs font-mono flex-1 truncate select-all">{{
                                        auditUrl }}</span>
                                    <button @click="copyAudit"
                                        class="shrink-0 px-3.5 h-9 rounded-lg bg-purple-500/10 hover:bg-purple-500/15 border border-purple-500/20 text-purple-400 text-xs font-semibold transition-all min-w-[75px]">
                                        {{ auditCopied ? '✓ Saved' : 'Copy' }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white/[0.01] rounded-xl p-4 border border-white/[0.04] flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500 font-mono">
                            <span>LIFETIME: {{ expiryLabel }}</span>
                            <span>BOUNDS: {{ form.max_views }} ops</span>
                            <span v-if="form.password" class="text-blue-400 flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-blue-400 animate-ping"></span>
                                ENCRYPTED_KEY_SET
                            </span>
                        </div>

                        <button @click="reset"
                            class="w-full h-11 rounded-xl border border-white/[0.05] bg-white/[0.01] hover:bg-white/[0.03] text-slate-300 font-medium text-xs tracking-wide transition-colors">
                            Initialize New Secure Session
                        </button>
                    </div>

                    <div v-else class="space-y-6">
                        <div
                            class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/20 overflow-hidden shadow-2xl relative">
                            <div
                                class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                            </div>

                            <div
                                class="px-5 py-3.5 border-b border-white/[0.04] bg-[#060a14]/60 flex items-center justify-between select-none">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-[#ef4444]/20 border border-[#ef4444]/40"></span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-[#f59e0b]/20 border border-[#f59e0b]/40"></span>
                                    <span
                                        class="w-2.5 h-2.5 rounded-full bg-[#10b981]/20 border border-[#10b981]/40"></span>
                                    <span
                                        class="ml-2 font-mono text-[11px] text-slate-400 tracking-tight">payload_buffer.raw</span>
                                </div>
                                <span
                                    class="px-2 py-0.5 font-mono text-[10px] text-slate-500 rounded bg-white/[0.03] border border-white/[0.05]">
                                    {{ form.content.length }} blocks
                                </span>
                            </div>

                            <div class="bg-[#02050d]">
                                <textarea v-model="form.content"
                                    placeholder="Paste runtime variables (.env), raw server SSH arrays, configuration strings or private text..."
                                    rows="13"
                                    class="w-full bg-transparent text-slate-200 placeholder-slate-600 font-mono text-xs leading-relaxed p-5 resize-none focus:outline-none transition-all focus:ring-0 border-none min-h-[310px] selection:bg-blue-500/20"></textarea>
                            </div>

                            <div
                                class="p-4 border-t border-white/[0.04] bg-[#060a14]/40 sm:flex sm:items-center sm:justify-between gap-4 space-y-3 sm:space-y-0">
                                <p v-if="errors.content"
                                    class="text-xs text-red-400 font-medium font-mono flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>
                                    {{ errors.content }}
                                </p>
                                <p v-else class="text-[11px] text-slate-500 font-mono flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-slate-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Payload undergoes memory encryption on execution event.
                                </p>

                                <button @click="submit" :disabled="loading"
                                    class="w-full sm:w-auto px-5 h-10 rounded-lg font-bold text-xs tracking-wider uppercase transition-all duration-200 flex items-center justify-center gap-2 shrink-0 border"
                                    :class="loading
                                        ? 'bg-blue-500/10 text-blue-400/40 cursor-not-allowed border-blue-500/10'
                                        : 'bg-blue-500 hover:bg-blue-400 text-white border-blue-600 shadow-lg shadow-blue-500/10 hover:shadow-blue-500/20'">
                                    <template v-if="loading">
                                        <svg class="animate-spin w-3.5 h-3.5" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4" />
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                                        </svg>
                                    </template>
                                    <span v-else>Generate Link</span>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 pt-1">
                            <div v-for="feat in features" :key="feat"
                                class="px-3 py-1.5 rounded-lg bg-[#070b18]/30 border border-white/[0.04] text-[10px] font-mono text-slate-400 tracking-wider uppercase transition-colors hover:border-white/[0.08] hover:text-slate-200 select-none">
                                {{ feat }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <AppFooter />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AppNavbar from '@/Components/AppNavbar.vue'
import AppFooter from '@/Components/AppFooter.vue'

const page = usePage()

const isLeftAligned = ref(true)
const badgeText = ref('AES-256 Encrypted · Zero Logs')

const form = ref({
    content: '',
    expires_in: '24h', // Initialized default state matching the new mapping structure safely
    max_views: 1,
    password: '',
    notify_email: '',
})

const loading = ref(false)
const errors = ref({})
const copied = ref(false)
const auditCopied = ref(false)
const showPassword = ref(false)
const generatedToken = ref(null)
const auditToken = ref(null)

const shareUrl = computed(() =>
    generatedToken.value ? `${window.location.origin}/s/${generatedToken.value}` : ''
)

const auditUrl = computed(() =>
    auditToken.value ? `${window.location.origin}/audit/${auditToken.value}` : ''
)

// Reconfigured to precisely parse custom duration intervals for clean metric delivery layouts
const expiryLabel = computed(() => {
    const map = {
        '5m': '5 minutes',
        '15m': '15 minutes',
        '30m': '30 minutes',
        '1h': '1 hour',
        '12h': '12 hours',
        '24h': '24 hours',
    }
    return map[form.value.expires_in] || '24 hours'
})

const features = [
    'AES-256-GCM',
    'TLS 1.3',
    'Zero-Logs',
    'Self-Destruct',
    'Rate-Limited'
]

const submit = async () => {
    errors.value = {}

    if (!page.props.auth?.user) {
        router.get('/login')
        return
    }

    if (!form.value.content.trim()) {
        errors.value.content = 'Payload block cannot remain unassigned.'
        return
    }

    loading.value = true
    router.post('/secrets', form.value, {
        preserveState: true,
        onSuccess: () => {
            const token = page.props.flash?.token
            const audit = page.props.flash?.audit_token
            if (token) generatedToken.value = token
            if (audit) auditToken.value = audit
            loading.value = false
        },
        onError: (e) => {
            errors.value = e
            loading.value = false
        },
    })
}

const copyLink = async () => {
    await navigator.clipboard.writeText(shareUrl.value)
    copied.value = true
    setTimeout(() => (copied.value = false), 2000)
}

const copyAudit = async () => {
    await navigator.clipboard.writeText(auditUrl.value)
    auditCopied.value = true
    setTimeout(() => (auditCopied.value = false), 2000)
}

const reset = () => {
    generatedToken.value = null
    auditToken.value = null
    form.value = { content: '', expires_in: '24h', max_views: 1, password: '', notify_email: '' }
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

.dir-rtl {
    direction: rtl;
}

.dir-ltr {
    direction: ltr;
}

select option {
    background: #030712;
    color: #cbd5e1;
}
</style>