<template>
    <navbar />
    <h1>Dashboard Fábrica de Perfume</h1>
    <div class="container mx-auto">
        <div class="row">
            <div class="col">
                <add-perfume :data="stock" />
            </div>
            <div class="col">
                <table class="table table-sm table-bordered border-dark text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Perfume</th>
                            <th>ML</th>
                            <th>Criado</th>
                            <th>Fragrência</th>
                        </tr>
                    </thead>
                    <tbody v-for="p in perfumes.data" :key="p.id">
                        <tr>
                            <td>{{ p.name }}</td>
                            <td>{{ p.ml_perfume }}</td>
                            <td>{{ p.amount_created }}</td>
                            <td>{{ p.name_fragrance }}</td>
                        </tr>
                    </tbody>
                </table>
                <pagination :data="perfumes" />
            </div>
        </div>
    </div>    
    
</template>

<script>
import Navbar from '../components/Navbar.vue'
import Pagination from '../components/Pagination.vue'
import AddPerfume from '../components/AddPerfume.vue'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'


export default {
    components: { Pagination, Navbar, AddPerfume },
    props: {
        perfumes: Object,
        stock: Object
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