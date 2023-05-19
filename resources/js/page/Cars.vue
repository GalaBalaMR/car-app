<template>
    <div class="">
        <h1 class="text-center" v-if="isLogged">Cars</h1>
        <p class="text-center" v-if="user">{{ user.name }}</p>
        <div class="d-flex justify-content-around">
            <button class="btn btn-warning" @click="isHiddenCar = !isHiddenCar">
                Add car
            </button>
            <button
                class="btn btn-warning"
                @click="isHiddenPart = !isHiddenPart"
            >
                Add part
            </button>
        </div>

        <!-- Notification -->
        <p class="text-center text-danger">{{ notification }}</p>

        <div>
            <form
                @submit.prevent="onSubmitAddCar"
                v-if="!isHiddenCar"
                class="col-10 offset-1 my-2 p-3 border rounded"
            >
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="nameCar"
                    />
                </div>
                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        name="is_registered"
                        v-model="is_registered"
                        @click="isHiddenInput = !isHiddenInput"
                    />
                    <label class="form-check-label">Is registered?</label>
                </div>
                <div v-if="!isHiddenInput || is_registered" class="mb-3">
                    <label for="email-reg" class="form-label"
                        >Registration number</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        name="registration_number"
                        id="email-reg"
                        v-model="registration_number"
                    />
                </div>
                <button class="btn btn-success d-block m-auto" type="submit">
                    Save
                </button>
            </form>
            <!-- Part Form -->
            <form
                @submit.prevent="onSubmitAddItem"
                v-if="!isHiddenPart"
                class="col-10 offset-1 my-2 p-3 border rounded"
            >
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        v-model="namePart"
                    />
                </div>
                <div class="mb-3">
                    <label class="form-label">For which car(id)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="car_id"
                        v-model="car_id"
                    />
                </div>
                <div class="mb-3">
                    <label for="item-reg" class="form-label"
                        >Serial number{{ car_id }}</label
                    >
                    <input
                        type="text"
                        class="form-control"
                        name="serial_number"
                        id="item-reg"
                        v-model="serial_number"
                    />
                </div>
                <button class="btn btn-success d-block m-auto" type="submit">
                    Save
                </button>
            </form>
        </div>
        <div v-if="isLogged" class="d-flex flex-column">
            <CarItem
                v-for="car in cars"
                :key="car.id"
                :id="car.id"
                :name="car.name"
                :is_registered="car.is_registered"
                :registration_number="car.registration_number"
                :parts="car.parts"
            />
        </div>
    </div>
</template>
<script>
import CarItem from "../components/CarItem.vue";
export default {
    name: "Cars",
    data() {
        return {
            isHiddenInput: true,
            isHiddenCar: true,
            isHiddenPart: true,
            nameCar: "",
            registration_number: "",
            is_registered: "",
            namePart: "",
            serial_number: "",
            car_id: "",
            notification: "",
        };
    },
    computed: {
        isLogged: function () {
            return this.$store.state.isAuth;
        },
        user: function () {
            return this.$store.state.user;
        },
        cars: function () {
            return this.$store.state.cars;
        },
    },
    methods: {
        onSubmitAddCar() {
            const data = {
                name: this.nameCar,
                is_registered: this.is_registered,
                registration_number: this.registration_number,
            };
            if (this.is_registered == true && this.registration_number == "") {
                this.notification =
                    "If is registered, You have to add registration number";
                setTimeout(() => (this.notification = ""), 3000);
                return;
            }
            axios
                .post("/api/cars", data)
                .then((response) => {
                    this.nameCar = "";
                    this.registration_number = "";
                    this.is_registered = "";
                    this.isHiddenCar = true;

                    this.$store.dispatch("fetchCars");
                })
                .catch((error) => {
                    if (error.response.data.message) {
                        this.notification = error.response.data.message;
                    } else {
                        this.notification = error.response.data;
                    }
                });
        },

        onSubmitAddItem() {
            const data = {
                name: this.namePart,
                car_id: this.car_id,
                serial_number: this.serial_number,
            };
            axios
                .post("/api/parts", data)
                .then((response) => {
                    this.namePart = "";
                    this.serial_number = "";
                    this.car_id = "";
                    this.isHiddenPart = true;

                    this.$store.dispatch("fetchCars");
                })
                .catch((error) => {
                    // if (error.response.data.message) {
                    //     this.notification = error.response.data.message;
                    // } else {
                    //     this.notification = error.response.data;
                    // }
                });
        },
    },
    components: {
        CarItem,
    },
    setup() {},
};
</script>
