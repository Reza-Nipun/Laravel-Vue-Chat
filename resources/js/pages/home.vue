<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
               
            Home Page
                
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user_id: ''
            }
        },
        created(){
            this.user_id = this.$route.params.data
        },
        methods: {
            
            

        },
        mounted() {
            console.log('Component mounted.')
            
        }
    }
</script>
