<template>
    <navbar />
    <h1>Dashboard Fábrica de Perfume</h1>
    <div class="container mx-auto">
        <div class="row">
            <div class="col-4">
                <add-perfume :perfumes="perfumes" :stock="stock"/>
            </div>
            <div class="col-8">
                <table class="table table-sm table-bordered border-dark text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Perfume</th>
                            <th>Total/ml</th>
                            <th>Água/ml</th>
                            <th>Alcool/ml</th>
                            <th>Fragrância/ml</th>
                            <th>Criado</th>
                            <th>Fragrância</th>
                        </tr>
                    </thead>
                    <tbody v-for="p in perfumes.data" :key="p.id">
                        <tr>
                            <td>{{ p.name }}</td>
                            <td>{{ p.ml_water + p.ml_alcohol + p.ml_fragrance }}</td>
                            <td>{{ p.ml_water }}</td>
                            <td>{{ p.ml_alcohol }}</td>
                            <td>{{ p.ml_fragrance }}</td>
                            <td>{{ p.amount_created }}</td>
                            <td>{{ p.name_fragrance }}</td>
                        </tr>
                    </tbody>
                </table>
                <pagination :data="perfumes" />
            </div>
        </div>
        <div class="row">
            <div class="col mt-3">            
                <add-qtd-perfume 
                    :perfume="perfumes" 
                    :stock="stock" 
                    :ml_water="stock_water" 
                    :ml_alcohol="ml_alcohol" 
                />
            </div>
            <div class="col">
                    
            </div>
        </div>        
    </div>    
    
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Pagination from '../components/Pagination.vue'
import AddPerfume from '../components/AddPerfume.vue'
import AddQtdPerfume from '../components/AddQtdPerfume.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'


export default {
    components: { Pagination, Navbar, AddPerfume, AddQtdPerfume },
    props: {
        perfumes: Object,
        stock: Object,
        stock_water: Number,
        stock_alcohol: Number,
        maisFabricados: Object
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
        }

        return { form, submit }
    },
}
</script>

<style>

</style>