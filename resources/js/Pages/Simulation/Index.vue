<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppName from "@/Components/AppName.vue";
import LinkButton from "@/Components/LinkButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Navbar from "@/Components/Navbar.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    teams: Array,
});

const form = useForm({

});

</script>

<template>
    <AppLayout>
        <Head title="Create Fixture"/>

        <AppName/>
        <div
            class="items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <Navbar />
            <div>

                <div class="pt-3 sm:pt-5">
                    <div class="mt-3">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-stone-600">
                          <thead class="bg-gray-50 dark:bg-stone-900">
                            <tr>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  Team
                              </th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  P
                              </th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  W
                              </th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  D
                              </th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  L
                              </th>
                              <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                  GD
                              </th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 dark:divide-stone-600 bg-white dark:bg-stone-800">
                            <tr v-for="team in teams" :key="teams.id">
                              <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  {{ team.name }}
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  1
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  2
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  3
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  4
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  5
                              </td>
                            </tr>
                          </tbody>
                        </table>

                        <div v-if="!teams.length">
                            Please add a team first
                        </div>

                    </div>
                    <div class="mt-4 grid md:grid-cols-2 gap-3">
                        <div class="p-3 border dark:border-neutral-600 rounded">
                            <div class="bg-gray-50 dark:bg-stone-900 text-sm">
                                <div
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-neutral-200 sm:pl-6">
                                    1. Week
                                </div>
                                <div class="grid grid-cols-11 justify-center py-2 bg-white dark:bg-stone-800">
                                    <div class="col-span-5 text-right">Home Team</div>
                                    <div class="col-span-1 text-center"> - </div>
                                    <div class="col-span-5">Away Team</div>
                                </div>
                                <div class="grid grid-cols-11 justify-center py-2 bg-white dark:bg-stone-800">
                                    <div class="col-span-5 text-right">Home Team</div>
                                    <div class="col-span-1 text-center"> - </div>
                                    <div class="col-span-5">Away Team</div>
                                </div>

                                <!--                                <div v-for="game in weekGames" :key="game.id" class="grid grid-cols-11 justify-center mb-2">-->
<!--                                    <div class="col-span-5 text-right">{{ game.home_team.name }}</div>-->
<!--                                    <div class="col-span-1 text-center"> - </div>-->
<!--                                    <div class="col-span-5">{{ game.away_team.name }}</div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="p-3 border dark:border-neutral-600 rounded">
                                <table class="min-w-full divide-y divide-gray-300 dark:divide-stone-600">
                                  <thead class="bg-gray-50 dark:bg-stone-900">
                                    <tr>
                                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                          Championship Predictions
                                      </th>
                                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                          %
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody class="divide-y divide-gray-200 dark:divide-stone-600 bg-white dark:bg-stone-800">
                                    <tr v-for="team in teams" :key="teams.id">
                                      <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                          {{ team.name }}
                                      </td>
                                      <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                          1
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                        </div>
                    </div>

                    <p class="mt-4 text-sm/relaxed text-center space-x-6">
                        <SecondaryButton>Play All</SecondaryButton>
                        <SecondaryButton>Play Next</SecondaryButton>
                        <SecondaryButton>Reset Data</SecondaryButton>
                    </p>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
