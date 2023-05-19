<template>
    <div class="">
        <p v-if="!isLogged">Home</p>
        <p v-if="isLogged">Hello</p>
        <p v-if="isLogged">{{ user.name }}</p>
    </div>
</template>
<script>
export default {
    name: "Home",
    data() {
        return {};
    },
    computed: {
        isLogged: function () {
            return this.$store.state.isAuth;
        },
        user: function () {
            return this.$store.state.user;
        },
    },
    methods: {
        handleSubmit() {},
    },
    setup() {},
};
</script>
