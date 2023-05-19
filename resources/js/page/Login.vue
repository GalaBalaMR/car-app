<!--Login.vue-->
<template>
    <div class="row">
        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"
                    >Email address</label
                >
                <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="email"
                />
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                    >Password</label
                >
                <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    v-model="password"
                />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p>{{ notification }}</p>
    </div>
</template>
<script>
export default {
    
    name: "Login",
    data() {
        return {
            email: "",
            password: "",
            notification: "",
        };
    },
    methods: {
        handleSubmit() {
            const data = {
                email: this.email,
                password: this.password,
            };

            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/login", data)
                    .then((response) => {
                        this.$router.push(this.$route.query.redirect || '/cars')
                        this.$store.commit('authentication', true)
                        this.$store.commit('setUser', response.data.user)
                        this.$store.dispatch("fetchCars");
                    })
                    .catch((error) => {
                        if(error.response.data.message)
                        {
                            this.notification = error.response.data.message
                        }else{
                            this.notification = error.response.data
                        }
                    }); // credentials didn't match
            });
        },
    },
    setup() {},
};
</script>
