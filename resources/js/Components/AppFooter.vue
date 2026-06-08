<template>
    <footer class="relative z-10 border-t border-white/[0.04] bg-[#02050d]/60 backdrop-blur-md mt-auto">
        <div
            class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-slate-500">

            <div class="flex items-center flex-wrap gap-x-3 gap-y-1">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500/40"></span>
                    <span>&copy; {{ currentYear }} Core Cryptography Engine.</span>
                </div>
                <span class="hidden sm:inline text-slate-700">|</span>
                <span class="text-slate-400">
                    Built by <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 font-semibold selection:text-white">Pial
                        Mahmud</span>
                </span>
            </div>

            <div class="flex items-center gap-6">
                <a href="#docs" class="hover:text-slate-300 transition-colors flex items-center gap-1">
                    <span>API Docs</span>
                    <svg class="w-3 h-3 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
                <a href="#status" class="hover:text-slate-300 transition-colors flex items-center gap-1">
                    <span class="w-1 h-1 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>System Operational</span>
                </a>
                <a href="#terms" class="hover:text-slate-300 transition-colors">Security Architecture</a>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue'

const currentYear = computed(() => new Date().getFullYear())
</script>