<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <Link class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs text-gray-300 hover:text-white uppercase tracking-widest focus:outline-none  disabled:opacity-50 transition ease-in-out duration-150">
        <slot />
    </Link>
</template>
