import { createRouter, createWebHistory } from "vue-router";
import Login from "../page/Login.vue";
import Register from "../page/Register.vue";
import Home from "../page/Home.vue";
import Cars from "../page/Cars.vue";
import store from "../store/Store";

const router = createRouter({
    linkActiveClass: "active",
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "Home",
            component: Home,
        },
        {
            path: "/login",
            name: "Login",
            component: Login,
        },
        {
            path: "/register",
            name: "Register",
            component: Register,
        },
        {
            path: "/cars",
            // beforeEnter(to, from, next) {
            //     if (store.state.isAuth == true) {
            //         next();
            //     } else {
            //         next("/login");
            //     }
            // },
            name: "Cars",

            component: Cars,
        },
    ],
});

export default router;
