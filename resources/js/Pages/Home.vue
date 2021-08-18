<template>
    <Head title="Home" />

    <AuthenticatedLayout>
            <CreatePostButton class="mb-1"></CreatePostButton>
        <div class="feed__box">
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import CreatePostButton from '@/Components/CreatePostButton.vue';
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        CreatePostButton,
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
@import '@scss/abstracts';
.feed__box {
    @include gray-border;
    border-radius: 4px;
    padding: pxToRem(16);
    background: $light;
    height: 350px;
}


</style>