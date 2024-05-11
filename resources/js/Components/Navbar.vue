<script setup>

import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>

        <NavLink :href="route('games.create')" class="text-blue-500">Teams</NavLink>
        <NavLink :href="route('games.index')" class="text-blue-500">Fixture</NavLink>
        <NavLink :href="route('simulation.create')" class="text-blue-500">Simulation</NavLink>

</template>

<style scoped>

</style>
