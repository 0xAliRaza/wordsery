<template>
    <button
        :type="type"
        :class="{
            small: sm,
            link: link,
            primary: primary,
            danger: danger,
            squared: squared,
        }"
    >
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: "button",
        },
        sm: Boolean,
        link: Boolean,
        primary: Boolean,
        danger: Boolean,
        squared: Boolean,
    },
    setup() {
        const tests = () => {
            alert("test");
        };
        return { tests };
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
button {
    font-size: pxToRem(15);
    font-weight: 600;
    border: none;
    padding: pxToRem(8) pxToRem(16);
    border-radius: 100px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    color: $dark;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.2s ease;
    &:hover,
    &:focus {
        &:not(:disabled) {
            outline: none;
        }
    }
    &:disabled {
        cursor: initial;
    }
}

.primary {
    background: $primary;
    color: $light;
    &:hover,
    &:focus {
        &:not(:disabled) {
            background: darken($primary, 10);
        }
    }
    &:disabled {
        background: lighten($primary, 10);
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
