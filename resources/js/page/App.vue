<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-warning navbar-custom" data-bs-theme="dark">
            <div class="container-fluid">
                <a v-if="isUser" class="navbar-brand" >{{ isUser.name }}</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <router-link class="nav-link" to="/">Home</router-link>
                        <router-link
                            class="nav-link"
                            v-if="!isLogged"
                            to="/login"
                            >Login</router-link
                        >
                        <router-link
                            class="nav-link"
                            v-if="!isLogged"
                            to="/register"
                            >Registration</router-link
                        >
                        <router-link class="nav-link" v-if="isLogged" to="/cars"
                            >Cars</router-link
                        >
                        <a
                            v-if="isLogged"
                            href="#"
                            @click.prevent="onClickLogout"
                            class="nav-link"
                            >Logout</a
                        >
                    </div>
                </div>
            </div>
        </nav>
        <p>{{ notification }}</p>

        <router-view />
    </div>
</template>
<script>
export default {
    name: "Home",
    computed: {
        isLogged: function () {
            return this.$store.state.isAuth;
        },
        isUser: function () {
            return this.$store.state.user;
        },
    },
    data() {
        return {
            notification: "",
        };
    },
    methods: {
        onClickLogout() {
            axios
                .get("/api/logout")
                .then(() => {
                    this.notification = "Bye, Bye...";
                    this.$store.commit("authentication", false);
                    setTimeout(() => (this.notification = ""), 3000);
                    this.$router.push(this.$route.query.redirect || '/')
                })
                .catch((error) => {
                    if (error.response.data.message) {
                        this.notification = error.response.data.message;
                    } else {
                        this.notification = error.response.data;
                    }
                });
        },
    },
    mounted() {
        this.$store.dispatch("fetchUser");
        this.$store.dispatch("fetchCars");
    },

    setup() {},
};
</script>
