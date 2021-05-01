<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-3 table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-hover">
                        <tr v-for="(user, index) in active_users" :key="index">
                            <td>
                                <p><b>{{ user.name }}</b> ({{ user.age }}, {{ user.gender == 0 ? 'Male' : (user.gender == 1 ? 'Female' : (user.gender == 2 ? 'Common' : '')) }})</p>
                                <p>{{ user.state }}, {{ user.country }} <img v-bind:src="user.country_flag" width="30" height="20" alt="FLG" /></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-12 chat_content_container">
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                            <p>Hello There</p>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-8">
                            <input type="text" class="form-control" autocomplete="off" />
                        </div>
                        <div class="col-2">
                            <button class="btn btn-danger">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        data(){
            return {
                user_id: '',
                active_users: [],
            }
        },
        created(){
            this.user_id = this.$route.params.data;
            this.checkAlreadyRegisteredOrNot();
            this.getRegisteredActiveUsers();
            this.timer = setInterval(this.getRegisteredActiveUsers, 60000);
        },
        methods: {
            checkAlreadyRegisteredOrNot(){
                axios.get(`/api/user/`).then(response => {
                    if(response.data.name == undefined){
                        this.$router.push({path: '/'})
                    }
                })
            },
            getRegisteredActiveUsers(){
                axios.get(`/api/users/`).then(response => {
                    this.active_users = response.data;
                })
            }
        },
        mounted() {
            console.log('Home Component mounted.')
        }
    }
</script>
<style>
.table.table-hover tr:hover {
    background-color: #f2bab3 !important;
}
.my-custom-scrollbar {
    position: relative;
    height: calc( 100vh - 120px );
    overflow: auto;
}
.table-wrapper-scroll-y {
    display: block;
}

.chat_content_container {
    position: relative;
    height: calc( 100vh - 150px );
    overflow: auto;
}
</style>
