<template>
    <Head title="Submit" />
    <AuthenticatedLayout>
        <div class="submit">
            <div class="post-type">
                <button
                    :class="{ active: form.type === 'note' }"
                    @click.prevent="form.type = 'note'"
                >
                    Note
                </button>
                <button
                    :class="{ active: form.type === 'summary' }"
                    @click.prevent="form.type = 'summary'"
                >
                    Summary
                </button>
            </div>
            <form @submit.prevent="submitPost">
                <div class="submit__box">
                    <div v-if="selectedBook" class="mb-1 flex flex-column">
                        <BookCard
                            class="book-card"
                            :book="selectedBook"
                        ></BookCard>
                        <Button
                            @click="selectedBook = null"
                            class="ml-auto"
                            sm
                            link
                            danger
                            >remove</Button
                        >
                    </div>

                    <div class="books-query mb-1" v-else>
                        <Input
                            modelPlaceholder="Book"
                            v-model="searchQuery"
                            modelType="search"
                        ></Input>
                        <InputError
                            v-if="errors.book"
                            :message="errors.book"
                        ></InputError>
                    </div>
                    <div v-if="books" class="books">
                        <div class="books__list">
                            <div
                                v-for="book in books"
                                v-bind:key="book.id"
                                class="books__list-item"
                                @click="selectBook(book)"
                                @keyup.enter="selectBook(book)"
                                @keyup.space="selectBook(book)"
                                tabindex="0"
                            >
                                <img
                                    v-if="book.volumeInfo.imageLinks"
                                    :src="
                                        book.volumeInfo.imageLinks
                                            .smallThumbnail
                                    "
                                    :alt="book.volumeInfo.title"
                                    class="books__thumb"
                                />
                                <div class="books__meta">
                                    <div class="books__title">
                                        {{ book.volumeInfo.title }}
                                    </div>
                                    <div class="books__authors">
                                        <template
                                            v-for="(author, index) in book
                                                .volumeInfo.authors"
                                            v-bind:key="author"
                                        >
                                            <template v-if="index > 0"
                                                >, </template
                                            >{{ author }}
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="editor-container mb-1"
                        v-if="!editorInitialized"
                    >
                        Loading editor...
                    </div>
                    <div class="mb-1" v-show="editorInitialized">
                        <editor
                            apiKey="is6rpblo337k1uxj8x1yvvf8qd5oj4scymd865g6ti1z156p"
                            @init="editorInitialized = true"
                            :init="{
                                placeholder: 'Let those words out...',
                                menubar: false,
                                branding: false,
                                min_height: 250,
                                plugins: [
                                    'advlist autolink lists link image fullscreen media paste wordcount',
                                ],
                                toolbar:
                                    'bold italic link | h3 bullist numlist | image media fullscreen ',
                            }"
                            v-model="form.content"
                        >
                        </editor>
                        <InputError
                            v-if="errors.content"
                            :message="errors.content"
                        ></InputError>
                    </div>
                    <Button
                        class="ml-auto"
                        primary
                        type="submit"
                        :disabled="
                            form.processing || !form.book || !form.content
                        "
                        >Post</Button
                    >
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Button from "@/Components/Button.vue";
import useDebouncedRef from "@/Composables/useDebouncedRef";
import BookCard from "@/Components/BookCard.vue";
import Editor from "@tinymce/tinymce-vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";

export default {
    props: {
        errors: Object,
    },
    components: {
        AuthenticatedLayout,
        Head,
        Editor,
        Input,
        Button,
        BookCard,
        InputError,
    },
    setup(props) {
        const editorInitialized = ref(false);
        const form = useForm({
            content: "",
            book: null,
            type: "note",
        });
        const books = ref(null);
        const searchQuery = useDebouncedRef("", 400);
        watch(searchQuery, (newQuery) => {
            if (newQuery !== "") {
                axios
                    .get(
                        `https://www.googleapis.com/books/v1/volumes?q=intitle:${newQuery}&maxResults=10`
                    )
                    .then((res) => {
                        if (res.data && res.data.items) {
                            books.value = res.data.items;
                        } else {
                            books.value = null;
                        }
                    })
                    .catch((e) => console.log(e));
            } else {
                books.value = null;
            }
        });
        const selectedBook = ref(null);
        const selectBook = (book) => {
            const filteredBook = {};
            filteredBook.google_uuid = book.id;
            filteredBook.title = book.volumeInfo.title;
            filteredBook.subtitle = book.volumeInfo.subtitle || "";
            filteredBook.publisher = book.volumeInfo.publisher;
            filteredBook.published_date =
                new Date(book.volumeInfo.publishedDate).getYear() + 1900;
            filteredBook.self_link = book.selfLink;
            filteredBook.thumbnail_link =
                book.volumeInfo.imageLinks.smallThumbnail ||
                book.volumeInfo.imageLinks.thumbnail ||
                "";
            filteredBook.authors = book.volumeInfo.authors;
            books.value = null;
            searchQuery.value = "";
            form.book = filteredBook;
            selectedBook.value = book;
        };

        const submitPost = () => {
            form.post("/post");
        };

        return {
            editorInitialized,
            form,
            searchQuery,
            books,
            selectBook,
            selectedBook,
            submitPost,
        };
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
.submit {
    border-radius: 4px;
    background: $light;
    &__box {
        display: flex;
        flex-direction: column;
        padding: pxToRem(16);
    }
}
.editor-container {
    min-height: 250px;
    background: $gray-1;
    color: $gray-5;
    font-size: pxToRem(16);
    font-weight: 400;
    display: flex;
    align-items: center;
    justify-content: center;
}
.post-type {
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
    overflow: hidden;
    display: flex;
    align-items: center;
    button {
        color: $gray-5;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1;
        padding: pxToRem(12) pxToRem(18);
        background: $light;
        border: none;
        border-bottom: 2px solid $gray-2;
        &:not(:last-of-type) {
            border-right: 2px solid $gray-2;
        }
        &.active {
            color: $primary;
            border-bottom: 2px solid $primary;
            background: rgba($primary, 0.08);
        }

        &:hover,
        &:focus {
            background: rgba($primary, 0.08);
        }
    }
}

.books-query {
    z-index: 102;
}
.books {
    z-index: 101;
    position: relative;
    &__list {
        position: absolute;
        width: 100%;
        height: pxToRem(500);
        padding: pxToRem(8) 0;
        overflow: auto;
        top: pxToRem(-16);
        bottom: 0;
        background-color: $gray-1;
        border: 1px solid $gray-3;
    }
    &__list-item {
        padding: pxToRem(8) pxToRem(10);
        cursor: pointer;
        display: flex;
        align-items: center;
        &:hover,
        &:focus {
            // background-color: $gray-2;
            background-color: $gray-2;
        }
    }
    &__thumb {
        width: 100%;
        max-width: pxToRem(50);
        height: auto;
    }
    &__meta {
        display: flex;
        flex-direction: column;
        padding: pxToRem(14);
    }

    &__title {
        font-size: pxToRem(16);
        color: $gray-6;
        font-weight: 600;
        margin-bottom: pxToRem(3);
    }

    &__authors {
        font-size: pxToRem(14);
        color: $gray-6;
    }
}

.book-card {
    &__remove {
        background-color: $danger;
        color: $light;
        padding: pxToRem(3);
        border: 0;
        display: inline-flex;
        margin-left: auto;
        font-size: pxToRem(14);
        font-weight: 400;
    }
}
</style>
