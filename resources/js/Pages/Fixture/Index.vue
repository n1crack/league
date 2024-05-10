<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({});


</script>

<template>
    <AppLayout>

        <h2 class="text-3xl">The League Simulation</h2>
        <div
            class="md:flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >

            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-soccer-field">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"/>
                    <path d="M3 9h3v6h-3z"/>
                    <path d="M18 9h3v6h-3z"/>
                    <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"/>
                    <path d="M12 5l0 14"/>
                </svg>
            </div>

            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black dark:text-white">Create a Fixture</h2>

                <p class="mt-4 text-sm/relaxed">
H
                </p>
            </div>

        </div>
    </AppLayout>
</template>
