<template>
    <div class="row">
        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <label for="name-reg" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name-reg"
                    v-model="name"
                />
            </div>
            <div class="mb-3">
                <label for="email-reg" class="form-label">Email address</label>
                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email-reg"
                    v-model="email"
                />
            </div>
            <div class="mb-3">
                <label for="password-reg" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password-reg"
                    v-model="password"
                />
            </div>
            <div class="mb-3">
                <label for="password-confirm-reg" class="form-label"
                    >Password Confirmation</label
                >
                <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    id="password-confirm-reg"
                    v-model="password_confirmation"
                />
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p>{{ notification }}</p>
    </div>
</template>
<script>
export default {
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            notification: ""
        };
    },
    methods: {
        handleSubmit() {
            const data = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
                
            };

            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("/api/register", data)
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
            console.log(data);
        },
    },

    setup() {},
};
</script>
