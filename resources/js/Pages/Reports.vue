<template>
    <navbar />
    <div class="row p-5">
        <div class="col-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Perfume mais fabricado</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(item, index) in maisFabricado">{{index}} - {{item}}/und</li>
                </ul>
            </div>
        </div>
        <div class="col-6 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Fragrância mais Utilizada</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(item, index) in maisUtilizada">{{index}} - {{item}}/ml</li>
                </ul>
            </div>
        </div>
    </div>
    
</template>

<script>
import Navbar from '../components/Navbar.vue'
export default {
    name: "Reports",
    components: { Navbar },
    props: {
        perfumes: Object,
        maisFabricado: Array,
        maisUtilizada: Array,

    },
}
</script>

<style>

</style>