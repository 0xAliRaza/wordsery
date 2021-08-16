<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">Dashboard</h2>
        </template>

        <div class="">
            <div class="">You're logged in!</div>
            <div v-if="post" v-html="post.data"></div>

            <div class="centered-editor">
                <div class="input-group mb-3">
                    <select class="form-select" aria-label="Select post type">
                        <option selected>Post type</option>
                        <option value="note">Note</option>
                        <option value="summary">Summary</option>
                    </select>
                </div>
                <editor
                    initialValue="<p>Initial editor content</p>"
                    apiKey="is6rpblo337k1uxj8x1yvvf8qd5oj4scymd865g6ti1z156p"
                    :init="{
                        menubar: false,
                        statusbar: false,
                        plugins: [
                            'advlist autolink lists link image fullscreen media paste wordcount',
                        ],
                        toolbar:
                            'bold italic link | h2 h3 bullist numlist | image media fullscreen ',
                    }"
                    v-model="form.data"
                >
                </editor>
                <button class="btn btn-primary btn-lg" @click.prevent="submit">
                    Post
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Editor from "@tinymce/tinymce-vue";
import { Head } from "@inertiajs/inertia-vue3";
import { reactive } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Editor,
    },
    props: {
        post: { type: Object, required: false },
    },
    setup(props) {
        const form = reactive({
            data: null,
        });
        const submit = async () => {
            await Inertia.post(
                "/post",
                form,
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
        return { form, submit };
    },
};
</script>
