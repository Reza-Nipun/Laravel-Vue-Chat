<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-3 table-wrapper-scroll-y my-custom-scrollbar">
                    <table class="table table-bordered table-hover">
                        <tr v-for="(user, index) in active_users" :key="index" @click="getSelectedUser(user.id)">
                            <td>
                                <p><b>{{ user.name }}</b> ({{ user.age }}, {{ user.gender == 0 ? 'Male' : (user.gender == 1 ? 'Female' : (user.gender == 2 ? 'Common' : '')) }})</p>
                                <p>{{ user.state }}, {{ user.country }} <img v-bind:src="user.country_flag" width="30" height="20" alt="FLG" /></p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-9" v-if="selected_user_id != ''">
                    <div class="row">
                        <div class="col-11">
                            <div class="page-header bg-danger text-white rounded">
                                <h3 v-html="user_name"></h3>
                                <p><span v-html="user_age"></span> <span v-html="user_gender"></span> <span v-html="user_city"></span> <span v-html="user_country"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11 chat_content_container">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr v-for="(conv, index) in conversations" :key="index">
                                        <td align="left">
                                            {{ conv.name}}: {{ conv.message}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-9">
                            <input type="hidden" v-model="selected_user_id" readonly="readonly" />
                            <input type="text" class="form-control" v-model="text_msg" autocomplete="off" 
                                @keyup.enter="sendMessage" />
                        </div>
                        <div class="col-2">
                            <button class="btn btn-danger" @click="sendMessage">
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
                conversations: [],
                
                selected_user_id: '',
                user_name: '',
                user_age: '',
                user_gender: '',
                user_city: '',
                user_country: '',
                text_msg: '',
            }
        },
        created(){
            this.user_id = this.$route.params.data;
            this.checkAlreadyRegisteredOrNot();
            this.getRegisteredActiveUsers();
            this.getConversation();
            this.timer = setInterval(this.getRegisteredActiveUsers, 60000);
            this.timer = setInterval(this.getConversation, 10000);
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
            },
            getSelectedUser(id){
                this.selected_user_id = id;

                axios.get(`/api/user/${id}/edit`).then(response => {
                    this.user_name = response.data.name
                    this.user_age = response.data.age+', '
                    this.user_gender = (response.data.gender == 0 ? 'Male' : (response.data.gender == 1 ? 'Female' : (response.data.gender == 2 ? 'Common' : '')))+', '
                    this.user_city = response.data.state+', '
                    this.user_country = response.data.country
                })

                this.getConversation();
            },
            getConversation(){
                let to_id = this.selected_user_id;

                if(to_id != ''){
                    axios.get(`/api/conversations/${to_id}`).then(response => {
                        this.conversations = response.data
                    })
                    if(this.conversations.length > 0){
                        // $('.chat_content_container').stop().animate({scrollTop: $('.chat_content_container').get(0).scrollHeight}, 100);
                        
                        $( ".chat_content_container" ).scrollTop( 2000 );
                    }
                }

                
            },
            sendMessage(){
                if(this.text_msg != ''){
                    const conversation_data = {  to_id: this.selected_user_id, message: this.text_msg };

                    axios.post('/api/conversation', conversation_data).then(response => {
                        if(response.data == 'success'){
                            this.text_msg = '';
                        }
                    })
                }     
                this.getConversation()           
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
    height: calc( 100vh - 240px );
    overflow: auto;
}
</style>
