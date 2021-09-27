<template>
    <div class="card">
        <img
            v-if="book.thumbnail_link"
            :src="book.thumbnail_link"
            :alt="book.title"
            :class="{ thumb: true, 'thumb--compact': compact }"
        />
        <div class="meta">
            <div class="title">
                {{ book.title }}
            </div>
            <div class="authors">
                <template
                    v-for="(author, index) in book.authors"
                    v-bind:key="index"
                >
                    <template v-if="index > 0">, </template>{{ author.name }}
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        book: {
            type: Object,
            required: true,
        },
        compact: Boolean,
    },
    setup() {},
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
.card {
    background-color: $light;
    display: flex;
    border: 1px solid $gray-3;
    border-radius: 2px;
    overflow: hidden;
}
.thumb {
    width: 100%;
    max-width: pxToRem(60);
    height: auto;
    &--compact {
        max-width: pxToRem(50);
    }
}
.meta {
    display: flex;
    flex: 1;
    flex-direction: column;
    justify-content: center;
    padding: pxToRem(16);
}
.title {
    font-size: pxToRem(16);
    color: $primary;
    font-weight: 600;
    margin-bottom: 3px;
}
.authors {
    font-size: pxToRem(14);
    color: $gray-6;
}
</style>
