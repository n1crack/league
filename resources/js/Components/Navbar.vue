<script setup>

import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>

    <NavLink :href="route('games.index')" :active="route().current('games.index*')">Fixture</NavLink>
    <NavLink :href="route('team.index')" :active="route().current('team.index*')">Teams</NavLink>
    <NavLink :href="route('simulation.create')" :active="route().current('simulation.create*')">Simulation</NavLink>

</template>

<style scoped>

</style>
