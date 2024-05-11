<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppName from "@/Components/AppName.vue";
import LinkButton from "@/Components/LinkButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Navbar from "@/Components/Navbar.vue";

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
    form.post(route('games.create'));
};

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
                    <h2 class="text-xl font-semibold text-black dark:text-white">Create Fixture</h2>

                    <div class="mt-3">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-stone-600">
                          <thead class="bg-gray-50 dark:bg-stone-900">
                            <tr>
                              <th scope="col" colspan="2" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900  dark:text-neutral-200 sm:pl-6">
                                 <div class="flex items-center justify-between">
                                      Team Name

                                     <LinkButton :href="route('team.create')" class="text-blue-500">Create New</LinkButton>

                                 </div>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200 dark:divide-stone-600 bg-white dark:bg-stone-800">
                            <tr v-for="team in teams" :key="teams.id">
                              <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-neutral-200 sm:pl-6">
                                  {{ team.name }}
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

                    <p class="mt-4 text-sm/relaxed text-center">
                        <PrimaryButton @click="createFixture">Create Fixture</PrimaryButton>
                    </p>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
