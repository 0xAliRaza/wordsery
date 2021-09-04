<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="modelPlaceholder"
        ref="input"
        :type="modelType || 'text'"
    />
</template>

<script>
export default {
    props: ["modelValue", "modelPlaceholder", "modelType"],

    emits: ["update:modelValue"],

    methods: {
        focus() {
            this.$refs.input.focus();
        },
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
input {
    @include gray-border;

    border-radius: 4px;
    padding: pxToRem(10) pxToRem(12);
    color: $dark;
    &::placeholder {
        font-size: pxToRem(16);
        color: $gray-5;
    }
    width: 100%;
}
</style>
