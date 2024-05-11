<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppName from "@/Components/AppName.vue";
import LinkButton from "@/Components/LinkButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import Navbar from "@/Components/Navbar.vue";

defineProps({
    games: Array,
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

                         asdsdsad
                    </div>

                    <p class="mt-4 text-sm/relaxed text-center">
                        <PrimaryButton>Go to Simulation</PrimaryButton>
                    </p>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
