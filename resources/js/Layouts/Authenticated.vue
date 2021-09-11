<template>
    <nav class="nav">
        <div class="nav__container">
            <Link
                class="nav__brand"
                href="/"
                active="/"
                >Wordsery</Link
            >
            <input type="text" class="nav__search" placeholder="Search" />
            <ul class="nav__list">
                <li class="nav__list-item">
                    <Link
                        class="nav__link"
                        :href="route('home')"
                        :active="route().current('home')"
                        >Home</Link
                    >
                </li>
                <li class="nav__list-item">
                    <Link
                        class="nav__link"
                        :href="route('logout')"
                        :active="route().current('logout')"
                        method="post"
                        as="button"
                        >Log out</Link
                    >
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Heading -->
    <header class="mt-5 text-center" v-if="$slots.header">
        <slot class="" name="header" />
    </header>

    <!-- Page Content -->
    <main>
        <div class="feed">
            <slot />
        </div>
    </main>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
.nav {
    position: fixed;
    z-index: 109;
    width: 100%;
    background: $light;
    padding: 0px pxToRem(20);
    box-shadow: 0 3px 10px 0 rgba($gray-3, 0.3);

    &__container {
        height: $nav-height;
        margin: auto;
        display: flex;
        align-items: center;
        max-width: pxToRem(1200);
    }
    &__brand {
        font-family: inherit;
        text-transform: uppercase;
        font-size: pxToRem(18);
        color: $primary;
        font-weight: 700;
        margin-right: pxToRem(20);
    }
    &__search {
        background: $gray-1;
        margin-right: pxToRem(20);
        height: pxToRem(34);
        border: 1px solid $gray-2;
        border-radius: 2px;
        width: pxToRem(400);
        padding: 0 pxToRem(10);
        color: $dark;
        &::placeholder {
            font-size: pxToRem(15);
            color: $gray-5;
        }
        &:hover,
        &:focus {
            outline: none;
            background: $light;
            @include primary-border;
        }
    }
    &__list {
        display: flex;
        align-items: center;
        margin-left: auto;
    }
    &__list-item {
        display: inline-flex;
        &:not(:last-of-type) {
            margin-right: pxToRem(16);
        }
    }
    &__link {
        font-size: pxToRem(16);
        color: $gray-5;
        font-weight: 400;
        padding: pxToRem(10) 0;
        transition: all 0.3s ease;
        &:hover,
        &:focus,
        &:active {
            color: $gray-7;
        }
    }
}

main {
    min-height: 100%;
    padding: $nav-height pxToRem(16) 0;
}
.feed {
    margin: pxToRem(20) auto;
    max-width: pxToRem(748);
}
</style>
