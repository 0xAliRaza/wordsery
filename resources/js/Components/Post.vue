<template>
    <div class="post">
        <div>{{post.content}}</div>
    </div>
</template>

<script>
export default {
    props: {post: Object},
    setup() {},
};
</script>

<style lang="scss" scoped>
@import "@scss/abstracts";
.post {
    @include gray-border;
    border-radius: 4px;
    padding: pxToRem(16);
    background: $light;
}
</style>
