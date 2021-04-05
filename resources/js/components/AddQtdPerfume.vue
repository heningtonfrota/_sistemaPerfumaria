<template>    
    <form @submit.prevent="submit" class="border rounded p-3 form-control">
        <h2>Adicionar Quantidade:</h2>
        <div id="v-model-select-dynamic" class="mb-2">
            <select v-model="form.perfume" class="form-control">
                <option v-for="option in perfume.data" :key="option.id" :value="option.id">
                    {{ option.name }}
                </option>
            </select>
        </div>
        <!-- <div id="v-model-select-dynamic" class="mb-2">
            <select v-model="form.stock" class="form-control">
                <option v-for="option in stock" :key="option.id" :value="option.id">
                    {{ option.name_fragrance }}
                </option>
            </select>
        </div> -->
        
        <input type="number" class="form-control mb-2" v-model="form.qtd" placeholder="Quantidade:" />
        <button type="submit" class="btn btn-success btn-sm btn-block">Submit</button>
    </form>
</template>

<script>

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: "Adição de Quantidade",
    props: {
        perfume: Object,
        stock: Object,
        ml_water: Object,
        ml_alcohol: Object,
    },
    setup () {
        const form = reactive({
            perfume: null,
            qtd: null,

        })
        function submit() {
            Inertia.post('/add-qtd-perfume/{id}', form)
        }
        return { form, submit }
    },
}
</script>

<style>

</style>