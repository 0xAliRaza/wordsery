<template>
    <div class="post">
        <user-card
            v-if="post.user"
            :user="post.user"
            :created_at="post.created_at"
        ></user-card>
        <div v-html="post.content"></div>
        <BookCard v-if="post.book" :book="post.book" compact></BookCard>
    </div>
</template>

<script>
import BookCard from "@/Components/BookCard";
import UserCard from "./UserCard.vue";
export default {
    props: { post: { type: Object, required: true } },
    components: { BookCard, UserCard },
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
.post {
    @include gray-border;
    border-radius: 4px;
    padding: pxToRem(16);
    background: $light;
    cursor: pointer;
    user-select: none;
}
</style>
