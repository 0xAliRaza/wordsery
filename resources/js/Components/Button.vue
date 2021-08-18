<template>
    <button :type="type">
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'submit',
        },
    }
}
</script>
<style lang="scss" scoped>
@import '@scss/abstracts';
button {
    @include secondary-font;
    font-size: pxToRem(15);
    font-weight: 500;
    border: none;
    padding: pxToRem(8) pxToRem(16);
    border-radius: 100px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: $primary;
    color: $light;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.2s ease;
    &:hover, &:focus {
        outline: none;
        background: $primary-dark;
    }
}
</style>
