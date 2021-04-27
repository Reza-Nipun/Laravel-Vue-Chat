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
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'category-list'}">Product Category</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link">Logout</router-link>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {

        computed: {
            currentRouteName() {
                return this.$route.name;
            }
        }

}
</script>

<style>

</style>