<script setup>

import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
<div class="space-x-1 md:space-x-5">
    <NavLink :href="route('games.index')" :active="route().current('games.index*')">Fixture</NavLink>
    <NavLink :href="route('team.index')" :active="route().current('team.index*')">Teams</NavLink>
    <NavLink :href="route('simulation.create')" :active="route().current('simulation.create*')">Simulation</NavLink>
</div>
</template>

<style scoped>

</style>
