<template>
    <div class="card">
        <img
            v-if="book.volumeInfo.imageLinks"
            :src="book.volumeInfo.imageLinks.smallThumbnail"
            :alt="book.volumeInfo.title"
            class="thumb"
        />
        <div class="meta">
            <div class="title">
                {{ book.volumeInfo.title }}
            </div>
            <div class="authors">
                {{ book.volumeInfo.authors[0] }}
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
}
.meta {
    display: flex;
    flex: 1;
    flex-direction: column;
    justify-content: center;
    padding: 0 pxToRem(16);
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
