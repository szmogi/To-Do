<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

</script>

<template>
    <Link :href="href" >
        <slot />
    </Link>
</template>
