<script setup>
import {Head, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppName from "@/Components/AppName.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Navbar from "@/Components/Navbar.vue";

const form = useForm(
    {
        name: null,
        team_power: null,
    }
);

const submit = () => {
    form.post(route('team.create'));
};

</script>

<template>
    <AppLayout>
        <Head title="Create Team"/>
        <AppName/>

        <div
            class=" items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <Navbar/>
            <div class="pt-3 sm:pt-5">
                <h2 class="text-xl font-semibold text-black dark:text-white">Create Team</h2>

                <p class="mt-4 text-sm/relaxed">

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Name"/>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name"/>
                        </div>

                        <div>
                            <InputLabel for="team_power" value="Team Power"/>
                            <TextInput
                                id="team_power"
                                v-model="form.team_power"
                                type="number"
                                class="mt-1 block w-full"
                                required
                                min="1"
                                max="120"
                                autofocus
                                autocomplete="team_power"
                            />
                            <InputError class="mt-2" :message="form.errors.team_power"/>
                        </div>

                        <div class="flex items-center  mt-4">
                            <PrimaryButton class="" :class="{ 'opacity-25': form.processing }"
                                           :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>


                </p>
            </div>

        </div>
    </AppLayout>
</template>
