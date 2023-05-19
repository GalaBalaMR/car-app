<template>
    <div class="d-flex justify-content-between align-items-center my-2">
        <p class="mb-0">{{ name }}</p>
        <div>
            <button class="btn btn-warning me-3" @click="isHidden = !isHidden">Update</button>
            <a
                @click="onClickDelItem"
                href="#"
                class="link link-danger text-decoration-none p-2 fw-bold"
                >X</a
            >
        </div>
    </div>
    <form
        @submit.prevent="onSubmitUpItem"
        v-if="!isHidden"
        class="col-10 offset-1 my-2 p-3 border rounded bg-light"
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
        <input
            type="hidden"
            class="form-check-input"
            name="car_id"
            v-model="car_id"
        />
        <div class="mb-3">
            <label for="item-reg" class="form-label">Serial number{{ car_id }}</label>
            <input
                type="text"
                class="form-control"
                name="serial_number"
                id="item-reg"
                v-model="serial_number"
            />
        </div>
        <button class="btn btn-success d-block m-auto" type="submit">Save</button>
    </form>
</template>

<script>
export default {
    props: ["name", "serial_number", "id", "car_id"],
    data() {
        return {
            isHidden: true,
        };
    },
    methods: {
        onClickHide() {
            this.isHidden = !isHidden;
        },
        onSubmitUpItem() {
            const data = {
                name: this.name,
                car_id: this.car_id,
                serial_number: this.serial_number,
            };
            axios
                .put("/api/parts/" + this.id, data)
                .then((response) => {
                    this.$store.dispatch("fetchCars");
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                    // if (error.response.data.message) {
                    //     this.notification = error.response.data.message;
                    // } else {
                    //     this.notification = error.response.data;
                    // }
                }); 
        },
        onClickDelItem() {
            axios
                .delete("/api/parts/" + this.id)
                .then((response) => {
                    this.$store.dispatch("fetchCars");
                })
                .catch((error) => {
                    console.log(error);
                    // if (error.response.data.message) {
                    //     this.notification = error.response.data.message;
                    // } else {
                    //     this.notification = error.response.data;
                    // }
                }); 
        },
    },
    setup() {},
};
</script>
