<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="">
                Dashboard
            </h2>
        </template>

        <div class="">

                    <div class="">
                        You're logged in! test xdssasdf
                    </div>
                    <div v-if="post">{{post.data}}</div>

                    <form @submit.prevent="submit">
                        <input type="text" v-model="form.data" />
                        <button type="submit">submit</button>
                    </form>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: {
        AuthenticatedLayout,
        Head,
    },
    props: {
        post: {type: Object, required: false},
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
