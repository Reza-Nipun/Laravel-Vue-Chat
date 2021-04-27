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
                                <input type="text" class="form-control" v-model="user_name" required autocomplete="off" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Gender</label>

                            <div class="col-md-6">
                                <select class="form-control" name="gender" v-model="gender">
                                    <option value="">Select Gender</option>
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                    <option value="2">Common</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Age</label>

                            <div class="col-md-6">
                                <select class="form-control" name="age" v-model="age">
                                    <option value="">Your Age</option>
                                    <option :value="age"  v-for="age in 100" >

                                        {{age}}

                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Country</label>

                            <div class="col-md-6">
                                
                                <div class="row">
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" readonly="readonly" name="country" v-model="country">
                                    </div>
                                    <div class="col-md-3">
                                        <img v-bind:src="flag_url" v-model="flag_url" width="50" height="40" alt="FLG" />
                                    </div>
                                </div>
                                <input type="text" class="form-control" readonly="readonly" v-model="user_code" />
                                
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" readonly="readonly" name="state" v-model="state">
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
    export default {
        data() {
            return {
                loc_info: {
                    type:Object
                },
                country_info: {
                    type:Object
                },
                fullPage: true,
                user_name: '',
                user_code: '',
                country: '',
                state: '',
                flag_url: '',
                age: '',
                gender: '',
            }
        },
        methods: {
            userLogin(){
                console.log(this.user_name);
                console.log(this.user_code);
                console.log(this.country);
                console.log(this.state);
                console.log(this.age);
                console.log(this.gender);
                console.log(this.flag_url);
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
                    this.loc_info = response.data;
                    this.user_code = response.data.query +'.'+ Date.now();
                    this.country = response.data.country;
                    this.state = response.data.regionName;

                    this.getCountryFlag();

                    loader.hide();
                })
                .catch(error => {
                    console.log(error);
                });

                
            },
            getCountryFlag(){

                axios.get('https://restcountries.eu/rest/v2/name/'+this.country)
                .then(response => {
                    this.country_info = response.data;
                    this.flag_url = response.data[0].flag;
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
