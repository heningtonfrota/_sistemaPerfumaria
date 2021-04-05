<template>
    <form @submit.prevent="submit" class="border rounded p-3">
        <div class="">
                <!-- <input class="form-control mb-2" v-model="form.name" placeholder="Nome do Perfume" /> -->
                <div id="v-model-select-dynamic"  class="col">
                    <span>Adicione Novo</span>
                    <input class="form-control mb-3" v-model="form.name" placeholder="Nome do Perfume" />
                    <span>Selecione P/Atualizar</span>
                    <select v-model="form.name" class="form-control mb-3">
                        <option selected disabled>Open this select menu</option>                        
                        <option v-for="option in perfumes.data" :key="option.id" :value="option.name">
                            {{ option.name }}
                        </option>
                    </select>
                </div>
                <input class="form-control mb-2" v-model="form.ml_water" placeholder="Água/ml" />
                <input class="form-control mb-2" v-model="form.ml_alcohol" placeholder="Alcool/ml" />
                <input class="form-control mb-2" v-model="form.ml_fragrance" placeholder="Fragrância/ml" />
                <!-- <input class="form-control mb-2" v-model="form.name_fragrance" placeholder="Nome da Fragrância" /> -->
                <select v-model="form.name_fragrance" class="form-control mb-3">
                    <option disabled>Open this select menu</option>                        
                    <option v-for="option in stock" :key="option.id" :value="option.name_fragrance">
                        {{ option.name_fragrance }}
                    </option>
                </select>
            
                <button type="submit" class="btn btn-success mx-auto">Cadastrar</button>
        </div>
    </form>
</template>

<script>

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    name: "AddPerfume",
    props: {
        perfumes: Object,
        stock: Object,
    },
    setup () {
        const form = reactive({
            name: null,
            ml_water: null,
            ml_alcohol: null,
            ml_fragrance: null,
            name_fragrance: null,
        })
        function submit() {
            Inertia.post('/add-perfume', form)
            // form.name =  null
            // form.ml_water =  null
            // form.ml_alcohol =  null
            // form.ml_fragrance =  null
            // form.name_fragrance =  null
        }
        return { form, submit }
    },
}
</script>

<style>

</style>