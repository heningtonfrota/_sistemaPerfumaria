<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li :class="preview">
                <inertia-link 
                    
                    :href="data.prev_page_url" 
                    class="page-link" tabindex="-1" aria-disabled="true"
                >Anterior</inertia-link>
            </li>
            
                <inertia-link
                    v-for="link in cleanLinks"
                    :key="link.label"
                    :href="link.url"
                    class="page-link"
                    :class="{'active': link.active}"
                >
                    {{ link.label }}
                </inertia-link>
            
            <li :class="next">
                <inertia-link 
                    :href="data.next_page_url" 
                    class="page-link" tabindex="-1" aria-disabled="true"
                >Próximo</inertia-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Pagination",
    data() {
        return {
            isPreview: this.data.prev_page_url == null,
            isNext: this.data.next_page_url == null
        }
    },
    props: {
        data: Object,
    },
    computed: {
        cleanLinks() {
            const cleanLinks = [...this.data.links];
            cleanLinks.shift();
            cleanLinks.pop();
            return cleanLinks;
        },
        preview() {
            return {
                'page-item disabled': this.isPreview
            }
        },
        next() {
            return {
                'page-item disabled': this.isNext
            }
        },
    },
}
</script>

<style>

</style>