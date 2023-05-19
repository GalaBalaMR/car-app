import { createApp } from "vue";
import { createStore } from "vuex";

// Create a new store instance.
const store = createStore({
    state() {
        return {
            user: null,
            isAuth: false,
            cars: [],
        };
    },
    mutations: {
        authentication(state, n) {
            state.isAuth = n;
        },
        setUser(state, n) {
            state.user = n;
        },
        setCars(state, n) {
            state.cars = n;
        },
    },

    actions: {
        fetchCars() {
            axios
                .get("/api/cars")
                .then((response) => {
                    this.state.cars = response.data;
                })
                .catch((error) => {
                });
        },
        fetchUser() {
            axios
                .get("/api/user")
                .then((response) => {
                    this.state.user = response.data.user;
                    if (response.data.user) {
                        this.state.isAuth = true;
                    }
                })
                .catch((error) => {
                });
        },
    },
});

export default store;
