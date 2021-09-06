<template>
    <button :type="type" :class="{ small: sm }">
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: "submit",
        },
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
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
    &:hover,
    &:focus {
        outline: none;
        background: darken($primary, 7);
    }
}
.danger {
    background: $danger;
    &:hover,
    &:focus {
        background: darken($danger, 7);
    }
}
.small {
    padding: pxToRem(6) pxToRem(12);
    font-size: pxToRem(12);
}

.link {
    border-radius: 0;
    color: $primary;
    background: transparent;
    text-decoration: underline;
    &:hover,
    &:focus {
        color: darken($primary, 7);
        background: transparent;
    }
}
.link.danger {
    color: $danger;
    background: transparent;
    &:hover,
    &:focus {
        color: darken($danger, 7);
        background: transparent;
    }
}


.squared {
    border-radius: 4px;
}
</style>
