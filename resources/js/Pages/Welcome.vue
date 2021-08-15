<template>
    <Head title="Welcome" />

    <div class="">
        <div v-if="canLogin" class="">
            <Link v-if="$page.props.auth.user" href="/dashboard" class="">
                Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="">
                    Log in
                </Link>

                <Link v-if="canRegister" :href="route('register')" class="">
                    Register
                </Link>
            </template>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
      Head,
      Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>
