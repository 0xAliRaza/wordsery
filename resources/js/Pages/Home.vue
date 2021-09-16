<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <transition name="fade">
            <toast @close="removeMessage" v-if="message">{{ message }}</toast>
        </transition>

        <CreatePostButton class="mb-1"></CreatePostButton>
        <div class="feed__box">
            <Post
                v-for="post in loadedPosts.models"
                :key="post.id"
                :post="post"
            ></Post>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import CreatePostButton from "@/Components/CreatePostButton.vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, reactive, ref } from "@vue/reactivity";
import Toast from "@/Components/Toast.vue";
import Post from "@/Components/Post.vue";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, watchEffect } from "@vue/runtime-core";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        CreatePostButton,
        Toast,
        Post,
    },
    props: { posts: Object },
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
        const loadedPosts = reactive({
            models: [],
            nextCursor: "",
        });
        const loadPosts = () => {
            Inertia.visit("/home", {
                only: ["posts"],
                method: "POST",
                preserveState: true,
            });
        };
        onMounted(() => {
            loadPosts();
        });
        watchEffect(() => {
            if (props.posts && props.posts.data) {
                loadedPosts.models.push(...props.posts.data);
                if (props.posts.next_page_url) {
                    loadedPosts.nextCursor =
                        props.posts.next_page_url.match(/(?<=\?cursor=).*/g)[0];
                } else {
                    loadedPosts.nextCursor = "";
                }
            }
        });
        return {
            formVisible,
            form,
            submit,
            message,
            removeMessage,
            visible,
            loadedPosts,
        };
    },
};
</script>
<style lang="scss" scoped>
@import "@scss/abstracts";
.feed__box {
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
