<template>
    <nav class="nav">
        <div class="nav__container">
            <a class="nav__brand" href="#">Wordsery</a>
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
        <slot />
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
    z-index: 1030;
    width: 100%;
    background: $light;
    font-family: "Source Sans Pro", sans-serif;
    padding: 0px pxToRem(20);
    border-bottom: 1px solid $gray-1;
    box-shadow: 0 3px 10px 0 rgba($gray-2, 0.7);

    &__container {
        height: pxToRem(48);
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
        margin-right: pxToRem(20);
        height: pxToRem(30);
        background: $light;
        border: 1px solid $gray-1;
        border-radius: 2px;
        width: pxToRem(400);
        padding: 0 pxToRem(10);
        transition: all 0.3s ease;
        &::placeholder {
            font-size: pxToRem(15);
            color: $gray-3;
        }
        &:focus {
            outline: none;
            border: 1px solid $gray-2;
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
        color: $gray-3;
        font-weight: 600;
        padding: pxToRem(10) 0;
        transition: all 0.3s ease;
        &:hover,
        &:focus,
        &:active {
            color: $gray-6;
        }
    }
}
</style>
