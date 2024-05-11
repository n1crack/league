<script setup>
import {Head} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import AppName from "@/Components/AppName.vue";
import LinkButton from "@/Components/LinkButton.vue";
import Navbar from "@/Components/Navbar.vue";

defineProps({
    games: [Array, Object],
    lastPlayedWeek: Number
});

</script>

<template>
    <AppLayout>
        <Head title="Fixture"/>

        <AppName/>

        <div class="items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
            <Navbar />
            <div class="pt-3 sm:pt-5">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-black dark:text-white">Fixture</h2>
                    <LinkButton :href="route('team.index')">Create New</LinkButton>
                </div>
                <div class="py-4 max-w-96 m-auto">
                    <div v-if="Object.values(games).length && !lastPlayedWeek">
                             <div class="flex justify-center">
                                <div>Upcoming Matches</div>
                            </div>
                     </div>
                    <div v-for="(weekGames, weekNo) in games" :key="weekNo">
                        <div class="border dark:border-gray-500 mb-3 rounded-lg">

                        <div class="flex justify-center text-red-400 text-lg">
                            {{ weekNo }}. Week
                        </div>
                        <div v-for="game in weekGames" :key="game.id" class="grid grid-cols-11 justify-center mb-2">
                            <div class="col-span-5 text-right">{{ game.home_team.name }} <span v-if="game.played" class="px-2 py-1 rounded bg-neutral-200 dark:bg-neutral-700 text-sm">{{ game.home_team_score }}</span></div>
                            <div class="col-span-1 text-center"> - </div>
                            <div class="col-span-5"><span v-if="game.played" class="px-2 py-1 rounded bg-neutral-200 dark:bg-neutral-700 text-sm">{{ game.away_team_score }}</span> {{ game.away_team.name }}</div>
                        </div>
                        </div>

                        <div class="mb-3" v-if="Number(weekNo) === lastPlayedWeek && lastPlayedWeek !== Object.values(games).length">
                            <div class="flex justify-center">
                                <div>Upcoming Matches</div>
                            </div>
                        </div>
                    </div>

                    <div v-if="!Object.values(games).length" class="p-4 text-center">
                        You have no games yet. Click the button above to create a fixture.
                    </div>
                </div>

            </div>

        </div>
    </AppLayout>
</template>
