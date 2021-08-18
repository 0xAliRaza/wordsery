<template>
    <Head title="Submit" />

    <AuthenticatedLayout>
        <div class="">
            <div class="input-group mb-3">
                <select class="form-select" aria-label="Select post type">
                    <option selected>Post type</option>
                    <option value="note">Note</option>
                    <option value="summary">Summary</option>
                </select>
            </div>
            <editor
                apiKey="is6rpblo337k1uxj8x1yvvf8qd5oj4scymd865g6ti1z156p"
                :init="{
                    placeholder: 'Create a post...',
                    menubar: false,
                    statusbar: false,
                    plugins: [
                        'advlist autolink lists link image fullscreen media paste wordcount',
                    ],
                    toolbar:
                        'bold italic link | h2 h3 bullist numlist | image media fullscreen ',
                }"
                v-model="form.content"
            >
            </editor>
            <button class="btn btn-primary btn-lg" @click.prevent="submit">
                Post
            </button>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Editor from "@tinymce/tinymce-vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Editor,
    },
    setup(props) {
        const form = useForm({
            content: null,
            book: null,
            type: "note",
        });
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
        return { form, submit };
    },
};
</script>
