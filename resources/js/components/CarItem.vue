<template>
    <div class="card my-2 col-12 bg-light">
        <div class="card-body">
            <h5 class="card-title">Name: {{ name }}</h5>
            <h6
                v-if="is_registered"
                class="card-subtitle mb-2 text-body-secondary"
            >
                Registration number: {{ registration_number }}
            </h6>
            <CarForm
                :key="id"
                :id="id"
                :name="name"
                :is_registered="is_registered"
                :registration_number="registration_number"
            />
            <div class="card-text">
                <ul class="list-group" v-for="part in parts">
                    <li class="list-group-item my-1">
                        <ItemForm
                            :key="part.id"
                            :id="part.id"
                            :car_id="id"
                            :name="part.name"
                            :serial_number="part.serial_number"
                        />
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</template>

<script>
import CarForm from "./CarForm.vue";
import ItemForm from "./ItemForm.vue";
export default {
    props: ["name", "is_registered", "registration_number", "parts", "id"],
    components: {
        CarForm,
        ItemForm,
    },
};
</script>
