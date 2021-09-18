<template>
    <div class="post">
        <user-card
            v-if="post.user"
            :user="post.user"
            :created_at="post.created_at"
        ></user-card>
        <div v-html="post.content"></div>
        <BookCard v-if="book" :book="book" compact></BookCard>
    </div>
</template>

<script>
import { ref } from "@vue/reactivity";
import { onMounted } from "@vue/runtime-core";
import BookCard from "@/Components/BookCard";
import axios from "axios";
import UserCard from "./UserCard.vue";
export default {
    props: { post: { type: Object, required: true } },
    components: { BookCard, UserCard },
    setup(props) {
        const book = ref(null);
        onMounted(() => {
            if (!book.value) {
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
            }
        });

        return { book };
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
    user-select: none;
}
</style>
