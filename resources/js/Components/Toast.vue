<template>
    <div
        :class="{
            'bottom-left': options.position === 'bottom-left',
            success: options.type === 'success',
        }"
        @click="emitCloseEvent"
    >
        <svg
            v-if="options.type === 'success'"
            class="icon icon-check"
            viewBox="0 0 32 32"
        >
            <path
                d="M16 0c-8.836 0-16 7.164-16 16s7.164 16 16 16 16-7.164 16-16-7.164-16-16-16zM13.52 23.383l-7.362-7.363 2.828-2.828 4.533 4.535 9.617-9.617 2.828 2.828-12.444 12.445z"
            ></path>
        </svg>
        <svg
            v-else-if="options.type === 'danger'"
            class="icon icon-cross"
            viewBox="0 0 32 32"
        >
            <path
                d="M16 0c-8.836 0-16 7.164-16 16s7.164 16 16 16 16-7.164 16-16-7.164-16-16-16zM23.914 21.086l-2.828 2.828-5.086-5.086-5.086 5.086-2.828-2.828 5.086-5.086-5.086-5.086 2.828-2.828 5.086 5.086 5.086-5.086 2.828 2.828-5.086 5.086 5.086 5.086z"
            ></path>
        </svg>
        <svg
            v-else-if="options.type === 'warning'"
            class="icon icon-warning"
            viewBox="0 0 32 32"
        >
            <path
                d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"
            ></path>
        </svg>
        <slot></slot>
    </div>
</template>

<script>
import { onMounted } from "vue";
export default {
    props: {
        options: {
            type: Object,
            default: {
                position: "bottom-left",
                type: "success",
            },
        },
    },
    emits: ["close"],
    setup(props, { emit }) {
        const emitCloseEvent = () => {
            emit("close");
            clearTimeout(timeout);
        };
        let timeout = null;
        onMounted(() => {
            timeout = setTimeout(() => {
                emitCloseEvent();
            }, 7000);
        });
        return { emitCloseEvent };
    },
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
div {
    position: fixed;
    z-index: 110;
    display: flex;
    align-items: center;
    padding: pxToRem(20) pxToRem(20);
    font-size: pxToRem(16);
    background: $light;
    border: 1px solid $gray-2;
    border-radius: 4px;
    overflow: hidden;
    user-select: none;
    @include secondary-font;
    box-shadow: pxToRem(2) pxToRem(2) 16px rgba($gray-4, 0.5);
    cursor: pointer;
    animation: slideInUp 150ms cubic-bezier(0.16, 1, 0.3, 1);
}

.success {
    background-color: $success;
    color: $light;
    border: 1px solid darken($success, 3);
}

.bottom-left {
    bottom: pxToRem(20);
    left: pxToRem(20);
}

.icon {
    display: inline-block;
    width: pxToRem(22);
    height: pxToRem(22);
    stroke-width: 0;
    stroke: currentColor;
    fill: currentColor;
    margin-right: pxToRem(8);
}

@keyframes slideInUp {
    from {
        transform: translate3d(0, 100%, 0);
        visibility: visible;
        opacity: 0.7;
    }

    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}
</style>
