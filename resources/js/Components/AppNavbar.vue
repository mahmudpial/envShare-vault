<template>
    <nav class="sticky top-0 z-50 w-full border-b border-white/[0.04] bg-[#080c14]/65 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-14 items-center justify-between">

                <div class="flex items-center gap-8">
                    <Link href="/" class="flex items-center gap-2.5 group">
                        <div
                            class="relative flex h-8 w-8 items-center justify-center rounded-lg bg-slate-900 border border-white/[0.08] group-hover:border-blue-500/30 transition-all duration-300">
                            <div
                                class="absolute inset-0 rounded-lg bg-gradient-to-br from-blue-500/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <svg class="h-3.5 w-3.5 text-slate-400 group-hover:text-blue-400 transition-colors duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span
                            class="text-sm font-semibold tracking-tight text-[#f8fafc] group-hover:text-white transition-colors">
                            .env<span class="text-blue-400">Share</span>
                        </span>
                    </Link>
                </div>

                <div class="flex items-center gap-3">

                    <div v-if="badge"
                        class="hidden md:flex items-center gap-2 px-2.5 py-1 rounded-md bg-white/[0.02] border border-white/[0.05] font-mono text-[10px] tracking-wider uppercase text-slate-400">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-40"
                                :class="badgeColor"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5" :class="badgeColor"></span>
                        </span>
                        {{ badge }}
                    </div>

                    <div class="flex items-center gap-1.5">
                        <template v-if="user">

                            <Link href="/dashboard"
                                class="h-8 px-3 rounded-md text-xs font-medium transition-all duration-200 flex items-center justify-center border"
                                :class="$page.component === 'Dashboard'
                                    ? 'bg-blue-500/[0.07] text-blue-400 border-blue-500/20 shadow-sm shadow-blue-500/5'
                                    : 'text-slate-300 hover:text-white bg-transparent border-transparent hover:bg-white/[0.03]'">
                                Dashboard
                            </Link>

                            <div class="relative inline-block text-left" ref="dropdownRef">
                                <button @click="toggleDropdown"
                                    class="h-8 pl-3 pr-2 rounded-md bg-[#0f1422]/60 hover:bg-[#141b2d] border border-white/[0.05] flex items-center gap-2 transition-all duration-200 select-none group focus:outline-none">
                                    <div class="flex flex-col items-end justify-center">
                                        <span
                                            class="text-[10px] font-mono font-medium text-slate-400 group-hover:text-slate-200 max-w-[100px] sm:max-w-[130px] truncate leading-tight">
                                            {{ user.name || user.email }}
                                        </span>
                                    </div>
                                    <svg class="w-3 h-3 text-slate-500 group-hover:text-slate-300 transition-transform duration-200"
                                        :class="{ 'rotate-180': dropdownOpen }" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <transition enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0">
                                    <div v-if="dropdownOpen"
                                        class="absolute right-0 mt-1.5 w-52 origin-top-right rounded-xl border border-white/[0.06] bg-[#0b0f19] shadow-2xl shadow-black/80 backdrop-blur-xl focus:outline-none overflow-hidden z-50">

                                        <div class="px-4 py-3 border-b border-white/[0.04] bg-[#0d1222]/40 select-none">
                                            <p
                                                class="text-[9px] font-bold tracking-widest text-slate-500 font-mono uppercase">
                                                Node Session Auth</p>
                                            <p class="text-[11px] font-mono text-slate-400 truncate mt-0.5"
                                                :title="user.email">{{ user.email }}</p>
                                        </div>

                                        <div class="p-1.5 space-y-0.5">
                                            <Link href="/profile" @click="dropdownOpen = false"
                                                class="flex w-full items-center gap-2 px-3 py-2 rounded-lg text-xs font-mono text-slate-400 hover:text-white hover:bg-white/[0.03] transition-colors group">
                                                <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-blue-400 transition-colors"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                Identity Matrix Settings
                                            </Link>

                                            <Link href="/logout" method="post" as="button" @click="dropdownOpen = false"
                                                class="flex w-full items-center gap-2 px-3 py-2 rounded-lg text-xs font-mono text-slate-500 hover:text-red-400 hover:bg-red-500/[0.04] transition-all group text-left">
                                                <svg class="w-3.5 h-3.5 text-slate-600 group-hover:text-red-400/80 transition-colors"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Disconnect Node
                                            </Link>
                                        </div>
                                    </div>
                                </transition>
                            </div>

                        </template>

                        <template v-else>
                            <Link href="/login"
                                class="h-8 px-3 text-xs font-medium text-slate-400 hover:text-white transition-colors flex items-center justify-center">
                                Sign In
                            </Link>
                            <Link href="/register"
                                class="h-8 px-3.5 rounded-md bg-white text-black hover:bg-slate-200 text-xs font-semibold shadow-sm transition-all flex items-center justify-center">
                                Get Started
                            </Link>
                        </template>
                    </div>

                </div>

            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

defineProps({
    badge: { type: String, default: '' },
    badgeColor: { type: String, default: 'bg-emerald-400' },
})

const page = usePage()
const user = computed(() => page.props.auth?.user)

const dropdownOpen = ref(false)
const dropdownRef = ref(null)

const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value
}

// Global click event dispatcher to catch outside canvas user activity interaction
const closeDropdownOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        dropdownOpen.value = false
    }
}

onMounted(() => {
    window.addEventListener('click', closeDropdownOutside)
})

onBeforeUnmount(() => {
    window.removeEventListener('click', closeDropdownOutside)
})
</script>

<style scoped>
button,
a {
    outline: none;
}
</style>