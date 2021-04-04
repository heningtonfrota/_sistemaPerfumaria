<template>
    <navbar />

    <h1>Estoque Fábrica de Perfume</h1>
    <div class="container mx-auto">
        <div class="row">
            <div class="col-3">
                <form @submit.prevent="submit" class="border rounded p-3">
                    <div id="v-model-select-dynamic"  class="col">
                        <span>Adicione Novo</span>
                        <input class="form-control mb-3" v-model="form.name_fragrance" placeholder="Nome da Fragrância" />
                        <span>Selecione P/Atualizar</span>
                        <select v-model="form.name_fragrance" class="form-control mb-3">
                            <option selected disabled>Open this select menu</option>                        
                            <option v-for="option in stock" :key="option.id" :value="option.name_fragrance">
                                {{ option.name_fragrance }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" min="0" class="form-control" v-model="form.ml_water" placeholder="Água/ml" />
                    </div>
                    <div class="col">
                        <input type="number" min="0" class="form-control" v-model="form.ml_alcohol" placeholder="Alcool/ml" />
                    </div>
                    <div class="col">
                        <input type="number" min="0" class="form-control" v-model="form.ml_fragrance" placeholder="Fragrância/ml" />
                    </div>
                    <div class="col">
                        
                    </div>
                    <div class="my-2">
                        <button type="submit" class="btn btn-success mx-auto">Cadastrar</button>
                    </div>
                </form>
            </div>
            <div class="col-8 text-center">
                <table class="table table-sm table-bordered border-dark ">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fragrância</th>
                            <th>Água/ml</th>
                            <th>Álcool/ml</th>
                            <th>Fragrância/ml</th>
                        </tr>
                    </thead>
                    <tbody v-for="p in stock" :key="p.id">
                        <tr>
                            <td>{{ p.id }}</td>
                            <td>{{ p.name_fragrance }}</td>
                            <td>{{ p.ml_water }}</td>
                            <td>{{ p.ml_alcohol }}</td>
                            <td>{{ p.ml_fragrance }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    
</template>

<script>
import Navbar from '../../components/Navbar.vue'

import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
    components: { Navbar  },
    props: {
        stock: Object
    },   
    setup () {
        const form = reactive({
            ml_water: null,
            ml_alcohol: null,
            ml_fragrance: null,
            name_fragrance: null,
        })

        function submit() {
            Inertia.post('/stock/add', form)
            form.ml_water = null
            form.ml_alcohol = null
            form.ml_fragrance = null
            // fom.name_fragrance = null
        }

        return { form, submit }
    }, 
}
</script>

<style>

</style>