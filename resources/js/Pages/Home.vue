<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <transition name="fade">
            <toast @close="removeMessage" v-if="message">{{ message }}</toast>
        </transition>

        <CreatePostButton class="mb-1"></CreatePostButton>
        <div class="feed__box"></div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import CreatePostButton from "@/Components/CreatePostButton.vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref } from "@vue/reactivity";
import Toast from "@/Components/Toast.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        CreatePostButton,
        Toast,
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
        const message = computed(() => usePage().props.value.message);
        const visible = ref(true);
        const removeMessage = () => {
            visible.value = false;
            usePage().props.value.message = null;
        };
        return { formVisible, form, submit, message, removeMessage, visible };
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
.feed__box {
    @include gray-border;
    border-radius: 4px;
    padding: pxToRem(16);
    background: $light;
    height: 350px;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 150ms ease-out;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
