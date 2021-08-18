<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="create-post">
            <div class="d-flex mb-3">
                <button
                    type="button"
                    class="form-control create-post__toggler"
                    aria-label="Create post"
                    @click.prevent="formVisible = true"
                    v-if="!formVisible"
                >
                    Create a new post...
                </button>
                <button
                    v-else
                    type="button"
                    class="btn-close ms-auto"
                    aria-label="Close"
                    @click.prevent="formVisible = false"
                ></button>
            </div>
            <div v-show="formVisible" class="border-1">
                <!-- <div class="create-post__type mb-3 d-flex align-items-center">
                    <button class="btn btn-primary flex-1">Note</button>
                    <button class="btn btn-primary">Summary</button>
                </div> -->
                <input type="text" name="book" id="" class="form-control mb-3" placeholder="Select a book...">
                <div class="mb-3">
                <editor
                    apiKey="is6rpblo337k1uxj8x1yvvf8qd5oj4scymd865g6ti1z156p"
                    :init="{
                        placeholder: 'Write something...',
                        menubar: false,
                        resize: true,
                        branding: false,
                        plugins: [
                            'advlist autolink lists link image fullscreen media paste wordcount',
                        ],
                        toolbar:
                            'bold italic underline strikethrough link | h2 h3 bullist numlist | image media fullscreen ',
                    }"
                    v-model="form.content"
                >
                </editor>
                </div>
                <div class="d-flex justify-content-end">

                <button class="btn btn-dark" @click.prevent="submit">
                    Post
                </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Editor from "@tinymce/tinymce-vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Editor,
    },
    setup(props) {
        const formVisible = ref(false);
        const form = useForm({ content: null, type: "note", book: null });
        const submit = async () => {
            await form.post(
                "/post",
                {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (res) => {
                        console.log(res);
                    },
                },
                { resetOnSuccess: false }
            );
        };
        return { formVisible, form, submit };
    },
};
</script>
<style lang="scss" scoped>
@import '@scss/app';
.create-post {
    max-width: 700px;
    margin: 0 auto;
    &__toggler {
        text-align: start;
        color: #6c757d;
        height: 48px;
        cursor: text;
    }
    &__type > button {
        flex: 1;
    }
}
</style>