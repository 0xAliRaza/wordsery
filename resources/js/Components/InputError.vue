<template>
    <div v-show="message">
        <p class="">
            {{ message }}
        </p>
    </div>
</template>

<script>
export default {
    props: ["message"],
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
div > p {
    font-size: pxToRem(14);
    color: $danger;
    padding: 4px;
}
</style>
