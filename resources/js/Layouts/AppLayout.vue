<script setup>
import {Head} from '@inertiajs/vue3';

defineProps({
    title: String,
});

</script>

<template>
    <div>
        <Head :title="title"/>
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="fixed -left-20 top-0 max-w-[877px] "
                 src="https://laravel.com/assets/img/welcome/background.svg"/>
            <div
                class="relative min-h-screen flex flex-col items-center pt-16 md:pt-32 selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-3xl px-6 lg:max-w-7xl">
                    <main class="mt-6">

                        <slot/>

                    </main>
                </div>
            </div>
        </div>
    </div>
</template>
