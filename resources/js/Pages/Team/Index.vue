<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import AppName from "@/Components/AppName.vue";
import LinkButton from "@/Components/LinkButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Navbar from "@/Components/Navbar.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    teams: Array,
});

const form = useForm({
    id: null
});

const deleteUser = (id) => {
    if (!confirm('Are you sure you want to delete this team?')) {
        return;
    }

    form.delete(route('team.destroy', {team: id}));
};

const createFixture = () => {
    form.post(route('games.store'));
};

</script>

<template>
    <AppLayout>
        <Head title="Teams"/>

        <AppName/>
        <div
            class="items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <Navbar />
            <div>
                <div class="pt-3 sm:pt-5">
                    <h2 class="text-xl font-semibold text-black dark:text-white">Teams</h2>

                    <div class="mt-3">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-stone-600">
                            <thead class="bg-gray-50 dark:bg-stone-900">
                            <tr>
                                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                    Team Name
                                </th>
                                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                    Team Power
                                </th>
                                <th class="">
                                    <div>
                                        <LinkButton :href="route('team.create')" class="whitespace-nowrap">Create Team </LinkButton>
                                    </div>
                                </th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 dark:divide-stone-600 bg-white dark:bg-stone-800">
                            <tr v-for="team in teams" :key="teams.id">
                              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  {{ team.name }}
                              </td>
                              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  {{ team.team_power }}
                              </td>
                              <td class="w-24 whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  <DangerButton type="button" @click="deleteUser(team.id)" >Delete</DangerButton>
                              </td>
                            </tr>
                          </tbody>
                        </table>


                        <div v-if="!teams.length">
                            Please add a team first
                        </div>
                    </div>

                    <div class="mt-4 text-sm/relaxed text-center space-y-3">
                        <div>
                            You can create a fixture once you have added teams.
                            This will regenerate the fixture for the teams.
                        </div>
                        <SecondaryButton @click="createFixture">Create Fixture</SecondaryButton>
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
