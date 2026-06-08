Here is the completely redesigned Reveal / Share layout (`Reveal.vue` or `Show.vue`).

The dark space foundations, ambient gradient light bubbles, structural weights, typography rules, interactive cards
(`glass-card`), inputs, and custom scrollbars have all been perfectly harmonized to mirror your exact production theme
across your other application templates.

The master `
<AppFooter />` component has also been registered at the very bottom to maintain consistent platform boundaries.

```vue
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

        <AppNavbar badge="One-time secret link" badge-color="bg-amber-400" />

        <div class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 py-12">
            <div class="w-full max-w-2xl relative">

                <div v-if="needsPassword && !content"
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 text-center space-y-6 shadow-2xl relative">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-amber-500/20 to-transparent">
                    </div>

                    <div
                        class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center mx-auto">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>

                    <div class="space-y-1">
                        <h2 class="text-xl font-bold tracking-tight text-white">Cryptographic Vault Locked</h2>
                        <p class="text-slate-400 text-sm">This matrix contains encrypted payloads. Input pass key to
                            reveal node streams.</p>
                    </div>

                    <div class="space-y-4 max-w-md mx-auto">
                        <div class="relative">
                            <input v-model="password" :type="showPwd ? 'text' : 'password'"
                                placeholder="Stipulate secret key phrase..." @keyup.enter="revealSecret"
                                class="w-full bg-[#0b0f19] border border-white/[0.06] focus:border-blue-500/50 rounded-lg px-4 py-2.5 text-xs text-slate-200 placeholder-slate-600 focus:outline-none transition-all pr-10 font-mono" />
                            <button @click="showPwd = !showPwd"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <p v-if="pwdError" class="text-xs text-red-400 text-left font-mono flex items-center gap-1.5">
                            <span class="w-1 h-1 rounded-full bg-red-400"></span> {{ pwdError }}
                        </p>

                        <button @click="revealSecret" :disabled="loading || !password"
                            class="w-full h-11 rounded-xl font-bold text-xs tracking-wider uppercase transition-all duration-200 flex items-center justify-center border"
                            :class="loading || !password
                                ? 'bg-blue-500/10 text-blue-400/30 border-blue-500/10 cursor-not-allowed'
                                : 'bg-blue-500 hover:bg-blue-400 text-white border-blue-600 shadow-lg shadow-blue-500/10'">
                            {{ loading ? 'Verifying Hashes...' : 'Unlock Vector' }}
                        </button>
                    </div>
                </div>

                <div v-else-if="!needsPassword && !content"
                    class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/30 p-6 sm:p-8 text-center space-y-6 shadow-2xl relative">
                    <div
                        class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-blue-500/20 to-transparent">
                    </div>

                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mx-auto">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>

                    <div class="space-y-1">
                        <h2 class="text-xl font-bold tracking-tight text-white">Encrypted Secret Staged</h2>
                        <p class="text-slate-400 text-sm">This operation is destructive. Viewing this buffer immediately
                            flags data blocks for memory wiping.</p>
                    </div>

                    <div
                        class="bg-red-500/5 border border-red-500/10 rounded-xl px-4 py-3 text-xs font-mono text-red-400 leading-relaxed text-center max-w-md mx-auto">
                        ⚠️ ALERT: URL paths wipe completely following decompression event.
                    </div>

                    <button @click="revealSecret" :disabled="loading"
                        class="w-full max-w-md mx-auto h-11 rounded-xl font-bold text-xs tracking-wider uppercase transition-all border bg-blue-500 hover:bg-blue-400 text-white border-blue-600 shadow-lg shadow-blue-500/10 flex items-center justify-center">
                        {{ loading ? 'Decompressing Block...' : '🔓 Reveal Buffer Link' }}
                    </button>
                </div>

                <div v-if="content" class="space-y-5">
                    <div
                        class="glass-card rounded-2xl border border-white/[0.05] bg-[#070b18]/20 overflow-hidden shadow-2xl relative">
                        <div
                            class="absolute -top-px left-10 right-10 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent">
                        </div>

                        <div
                            class="px-5 py-3.5 border-b border-white/[0.04] bg-[#060a14]/60 flex items-center justify-between select-none">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span
                                    class="font-mono text-[11px] text-slate-400 tracking-tight">payload_output.raw</span>
                            </div>
                            <button @click="copyContent"
                                class="flex items-center gap-1.5 px-3 h-7 rounded-md bg-white/[0.03] hover:bg-white/[0.06] border border-white/[0.05] text-[11px] font-mono text-slate-400 hover:text-slate-200 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                {{ contentCopied ? '✓ Saved' : 'Copy Plaintext' }}
                            </button>
                        </div>

                        <div class="bg-[#02050d] p-5">
                            <pre
                                class="text-xs text-slate-200 font-mono whitespace-pre-wrap break-all leading-relaxed max-h-96 overflow-y-auto custom-scroll selection:bg-emerald-500/20">{{ content }}</pre>
                        </div>
                    </div>

                    <div
                        class="glass-card rounded-xl px-5 py-4 flex items-center gap-3.5 border border-red-500/15 bg-red-500/[0.01] relative">
                        <div
                            class="w-9 h-9 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div class="space-y-0.5">
                            <p class="text-xs font-mono font-bold uppercase tracking-wide text-red-400">Vector
                                Life-Cycle Wiped</p>
                            <p class="text-[11px] text-slate-500 font-mono">This exact URL directory matrix has expired.
                                Memory tables clean across remote arrays.</p>
                        </div>
                    </div>

                    <div class="text-center pt-2">
                        <a href="/"
                            class="text-xs font-mono text-blue-400 hover:text-blue-300 transition-colors underline underline-offset-4">
                            Stipulate your own secure channel array →
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <AppFooter />

    </div>
</template>

<script setup>
import { ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import AppNavbar from '@/Components/AppNavbar.vue'
import AppFooter from '@/Components/AppFooter.vue'

const props = defineProps({
    token: String,
    needsPassword: Boolean,
    content: String,
})

const page = usePage()
const password = ref('')
const pwdError = ref('')
const loading = ref(false)
const showPwd = ref(false)
const content = ref(props.content || '')
const contentCopied = ref(false)

const revealSecret = () => {
    pwdError.value = ''
    loading.value = true
    router.post(`/s/${props.token}/reveal`, { password: password.value }, {
        preserveScroll: true,
        onSuccess: () => {
            content.value = page.props.content || ''
            loading.value = false
        },
        onError: (errors) => {
            pwdError.value = errors.password || 'Authorization validation error.'
            loading.value = false
        },
    })
}

const copyContent = async () => {
    await navigator.clipboard.writeText(content.value)
    contentCopied.value = true
    setTimeout(() => (contentCopied.value = false), 2000)
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

.custom-scroll::-webkit-scrollbar {
    width: 4px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.08);
    border-radius: 4px;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.15);
}
</style>

```