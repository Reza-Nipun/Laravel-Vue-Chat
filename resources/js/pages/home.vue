<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
               
                    <div class="col-3 table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>29, Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>NIPUN-1</b>
                                    <p>Female, Bangladesh <img src="https://restcountries.eu/data/bgd.svg" width="30" height="20" alt="FLG" /></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-9">
                        
                    </div>
                
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
            this.user_id = this.$route.params.data;
            this.checkAlreadyRegisteredOrNot();
        },
        methods: {
            checkAlreadyRegisteredOrNot(){
                axios.get(`/api/user/`).then(response => {
                    console.log(response.data.name);
                    if(response.data.name == undefined){
                        this.$router.push({path: '/'})
                    }
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
</style>
