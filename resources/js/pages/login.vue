<template>
    <div class="container">

    <div class="row justify-content-center">
   
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">LOGIN</div>

                <div class="card-body">

                    <form @submit.prevent="userLogin">
                    
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="loginForm.name" autocomplete="off" autofocus :class="{ 'is-invalid': loginForm.errors.has('name') }" />
                                <has-error :form="loginForm" field="name"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender" v-model="loginForm.gender" :class="{ 'is-invalid': loginForm.errors.has('gender') }">
                                    <option value="">Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                    <option value="2">Common</option>
                                </select>
                                <has-error :form="loginForm" field="gender"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Age</label>

                            <div class="col-md-6">
                                <select class="form-control" name="age" v-model="loginForm.age" :class="{ 'is-invalid': loginForm.errors.has('age') }">
                                    <option value="">Your Age</option>
                                    <option :value="age"  v-for="age in 100" >

                                        {{age}}

                                    </option>
                                </select>
                                <has-error :form="loginForm" field="age"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Country</label>

                            <div class="col-md-6">
                                
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" readonly="readonly" name="country" v-model="loginForm.country" :class="{ 'is-invalid': loginForm.errors.has('country') }" />
                                        <has-error :form="loginForm" field="country"></has-error>
                                    </div>
                                    <div class="col-md-3" v-if="loginForm.flag_url != ''">
                                        <img v-bind:src="loginForm.flag_url" width="50" height="40" alt="FLG" />
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" readonly="readonly" v-model="loginForm.country_flag" :class="{ 'is-invalid': loginForm.errors.has('country_flag') }" />
                                <has-error :form="loginForm" field="country_flag"></has-error>
                                
                                <input type="hidden" class="form-control" readonly="readonly" v-model="loginForm.user_code" :class="{ 'is-invalid': loginForm.errors.has('user_code') }" />
                                <has-error :form="loginForm" field="user_code"></has-error>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly="readonly" name="state" v-model="loginForm.state" :class="{ 'is-invalid': loginForm.errors.has('state') }" />
                                <has-error :form="loginForm" field="state"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    LOGIN
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { Form } from 'vform'

export default {
    data() {
        return {
            loginForm: new Form({
                name: '',
                user_code: '',
                country: '',
                state: '',
                flag_url: '',
                age: '',
                gender: '',
                country_flag: '',
            })
        }
    },
    created() {
        this.checkAlreadyRegisteredOrNot()
    },
    methods: {
        checkAlreadyRegisteredOrNot(){
            axios.get(`/api/user/`).then(response => {
                console.log(response.data.name);
                if(response.data.name != undefined){
                    this.$router.push({path: '/home'})
                }
            })
        },
        userLogin(){
            this.loginForm.post('/api/user').then(({ data }) => { 
                this.loginForm.name = '';
                this.loginForm.user_code = '';
                this.loginForm.country = '';
                this.loginForm.state = '';
                this.loginForm.age = '';
                this.loginForm.gender = '';
                this.loginForm.flag_url = '';
                this.loginForm.country_flag = '';
                                                
                this.$router.push({path: '/home'})
                                
            })
        },

        getUserLocationInfo(){
            let loader = this.$loading.show({
            container: this.$refs.loadingContainer,
            canCancel: true, // default false
            onCancel: this.yourCallbackMethod,
            color: 'red',
            loader: 'dots',
            width: 64,
            height: 64,
            backgroundColor: '#ffffff',
            opacity: 0.5,
            zIndex: 999,
        });
        // setTimeout(() => loader.hide(), 3 * 1000)

            axios.get('http://ip-api.com/json')
            .then(response => {
                this.loginForm.user_code = response.data.query +'.'+ Date.now();
                this.loginForm.country = response.data.country;
                this.loginForm.state = response.data.regionName;

                this.getCountryFlag();

                loader.hide();
            })
            .catch(error => {
                console.log(error);
            });

            
        },
        getCountryFlag(){

            axios.get('https://restcountries.eu/rest/v2/name/'+this.loginForm.country)
            .then(response => {
                this.loginForm.flag_url = response.data[0].flag;
                this.loginForm.country_flag = response.data[0].flag;
            })
        },
    },
    mounted() {
        // $.get("http://ip-api.com/json", function (response) {
        //     $("#ip").val(response.query);
        //     $("#country").val(response.country + ", " + response.city);
        //     $("#address").val(response.regionName + ", " + response.city);
        //     $("#details").html(JSON.stringify(response, null, 4));
        // }, "jsonp");

        this.getUserLocationInfo();

    }
}
    
</script>
