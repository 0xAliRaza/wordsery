<template>
    <Head title="Submit" />
    <AuthenticatedLayout>
        <div class="submit">
            <div class="post-type">
                <button class="active">Note</button>
                <button>Summary</button>
            </div>
            <div class="submit__box">
                <Input class="mb-1" modelPlaceholder="Book"></Input>
                <div class="editor-container mb-1" v-show="editorInitialized">
                    <editor
                        apiKey="is6rpblo337k1uxj8x1yvvf8qd5oj4scymd865g6ti1z156p"
                        @init="editorInitialized = true"
                        :init="{
                            placeholder: 'Let those words out...',
                            menubar: false,
                            statusbar: false,
                            min_height: 250,
                            plugins: [
                                'advlist autolink lists link image fullscreen media paste wordcount',
                            ],
                            toolbar:
                                'bold italic link | h2 h3 bullist numlist | image media fullscreen ',
                        }"
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
import { Head } from "@inertiajs/inertia-vue3";
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
        //     const form = useForm({
        //         content: null,
        //         book: null,
        //         type: "note",
        //     });
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
        const test = () => {
            console.log("test");
        };
        return { editorInitialized, test };
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
.submit {
    // border: 1px solid $gray-2;
    border-radius: 4px;
    background: $light;
    &__box {
        display: flex;
        flex-direction: column;
        padding: pxToRem(16);
    }
}
.post-type {
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
    overflow: hidden;
    display: flex;
    align-items: center;
    button {
        color: $gray-4;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1;
        padding: pxToRem(10) pxToRem(18);
        background: $gray-1;
        border: 0 0 2px;
        border-color: transparent;
        &:not(:last-of-type) {
            border-right: 1px solid $gray-2;
        }
        &.active {
            color: $primary;
            border-bottom: 2px solid $primary;
        }

        &:hover,
        &:focus {
            background: rgba($gray-2, 0.6);
        }
    }
}
</style>
