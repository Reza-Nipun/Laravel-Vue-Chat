<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <div class="container-fluid">
                <router-link class="navbar-brand" :to="{name: 'home'}">Site Logo</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0" v-if="currentRouteName != 'login'">

                    <li class="nav-item">
                        <router-link class="nav-link active" :to="{name: 'home'}">Home</router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <span class="dropdown-item" v-on:click="logoutFunction">Logout</span>
                        </div>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
        data(){
            return {
                name: ''
            }
        },
        computed: {
            currentRouteName() {
                return this.$route.name;
            }
        },
        created() {
            this.loadUserInfo();
        },methods: {
            
            loadUserInfo(){
                axios.get(`/api/user/`).then(response => {
                    console.log(response.data);

                    this.name = response.data.name;
                })
            },
            logoutFunction(){
                axios.get('/api/logout').then(response => {
                    this.$router.push("/login")

                    if(response.data == 'success'){
                        this.$router.push({ name: 'login' })
                    }
                });
            }

        },
        mounted() {
            console.log('Component mounted.')
        }

}
</script>

<style>

</style>