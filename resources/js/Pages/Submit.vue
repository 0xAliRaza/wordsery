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
            <div class="submit__box">
                <Input
                    class="books-input mb-1"
                    modelPlaceholder="Book"
                    v-model="form.book"
                    @change="searchBooks"
                ></Input>
                <div v-if="books" class="books ">
                    <div class="books__list">
                        <div
                            v-for="book in books"
                            v-bind:key="book.id"
                            class="books__list-item"
                        >
                            {{ book.volumeInfo.title }}
                        </div>
                    </div>
                </div>
                <div class="editor-container mb-1" v-if="!editorInitialized">
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
                </div>
                <Button class="ml-auto">Post</Button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import Editor from "@tinymce/tinymce-vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Editor,
        Input,
        Button,
    },
    setup(props) {
        const editorInitialized = ref(false);
        const form = useForm({
            content: "",
            book: "",
            type: "note",
        });
        const books = ref(null);
        const searchBooks = async () => {
            console.log(form.book);
            try {
                books.value = (
                    await axios.get(
                        `https://www.googleapis.com/books/v1/volumes?q=intitle:${form.book}&maxResults=10`
                    )
                ).data.items;
            } catch (e) {
                console.log("error>>", e);
            }
        };
        //     const submit = async () => {
        //         await form.post(
        //             "/post",
        //             {
        //                 preserveState: true,
        //                 preserveScroll: true,
        //                 onSuccess: (res) => {
        //                     console.log(res);
        //                 },
        //             },
        //             { resetOnSuccess: false }
        //         );
        //     };
        //     return { form, submit };
        return { editorInitialized, form, searchBooks, books };
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

.books {
    z-index: 1020;
    position: relative;
    display: block;
    border: 1px solid green;
        background-color: white;
    &__list {
        position: absolute;
        width: 100%;
        height: auto;
        top: pxToRem(-14);
        bottom: 0;
    }
    &__list-item {
        background-color: yellow;
    }
}
</style>
