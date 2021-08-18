<template>
    <Link @click="$emit('clicked')" as="button" :href="route('submit')"
        >Create a post</Link
    >
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: { Link },
    emits: ["clicked"],
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
button {
    font-size: pxToRem(16);
    padding: pxToRem(12) pxToRem(18);
    border-radius: 4px;
    background: $light;
    @include gray-border;
    width: 100%;
    text-align: start;
    color: $gray-5;
    cursor: text;
}
</style>
