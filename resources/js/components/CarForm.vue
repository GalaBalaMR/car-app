<template>
    <div class="d-flex justify-content-between my-2">
        <button class="btn btn-success" @click="isHidden = !isHidden">
            Update
        </button>
        <a
            @click="onClickDelCar"
            href="#"
            class="link link-danger text-decoration-none p-2 fw-bold"
            >X</a
        >
    </div>
    <form
        @submit.prevent="onSubmitUpCar"
        v-if="!isHidden"
        class="col-10 offset-1 my-2 p-3 border rounded bg-white "
    >
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                name="name"
                v-model="name"
            />
        </div>
        <div class="mb-3 form-check">
            <input
                type="checkbox"
                class="form-check-input"
                name="is_registered"
                :checked="is_registered"
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

        <!-- Notification -->
        <p class="text-center text-danger">{{ notification }}</p>

        <button class="btn btn-warning" type="submit">Save</button>
    </form>
</template>

<script>
export default {
    props: ["name", "is_registered", "registration_number", "id"],
    data() {
        return {
            isHidden: true,
            isHiddenInput: true,
            notification: "",
        };
    },
    methods: {
        onClickHide() {
            this.isHidden = !isHidden;
        },
        onSubmitUpCar() {
            const data = {
                name: this.name,
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
                .put("/api/cars/" + this.id, data)
                .then((response) => {
                    this.$store.dispatch("fetchCars");
                })
                .catch((error) => {
                    console.log(error);
                    if (error.response.data.message) {
                        this.notification = error.response.data.message;
                    } else {
                        this.notification = error.response.data;
                    }
                }); // credentials didn't match
        },
        onClickDelCar() {
            axios
                .delete("/api/cars/" + this.id)
                .then((response) => {
                    this.$store.dispatch("fetchCars");
                })
                .catch((error) => {
                    console.log(error);
                    if (error.response.data.message) {
                        this.notification = error.response.data.message;
                    } else {
                        this.notification = error.response.data;
                    }
                }); // credentials didn't match
        },
    },
    setup() {},
};
</script>
