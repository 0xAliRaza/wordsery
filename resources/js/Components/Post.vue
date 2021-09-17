<template>
    <div class="post">
        <user-card
            v-if="user"
            :user="user"
            :created_at="post.created_at"
        ></user-card>
        <div v-html="post.content"></div>
        <BookCard v-if="book" :book="book" compact></BookCard>
    </div>
</template>

<script>
import { computed, ref } from "@vue/reactivity";
import { watchEffect } from "@vue/runtime-core";
import BookCard from "@/Components/BookCard";
import axios from "axios";
import UserCard from "./UserCard.vue";
import { usePage } from "@inertiajs/inertia-vue3";
export default {
    props: { post: { type: Object, required: true } },
    components: { BookCard, UserCard },
    setup(props) {
        const book = ref(null);
        watchEffect(() => {
            if (props.post.book) {
                axios
                    .get(
                        `https://www.googleapis.com/books/v1/volumes/${props.post.book}`
                    )
                    .then((res) => {
                        if (res.data) {
                            book.value = res.data;
                        } else {
                            book.value = null;
                        }
                    })
                    .catch((e) => console.log(e));
            } else {
                book.value = null;
            }
        });

        const user = computed(() => usePage().props.value.auth.user);

        return { book, user };
    },
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
}
</style>
