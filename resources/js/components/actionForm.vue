<template>
    <form @submit.prevent="login" name="login">
        <input type="hidden" name="v1" :value="interface_name">
        <input type="hidden" name="v2" :value="hostname">
        <input type="hidden" name="v3" :value="mac">
        <input type="hidden" name="v4" :value="ip">
        <input type="hidden" name="v5" :value="username">
        <input type="hidden" name="v6" :value="link_login_only">
        <input type="hidden" name="v7" :value="link_orig">
        <input type="hidden" name="v8" :value="error">
    </form>
</template>

<script>
    import axios from "axios"
    export default {
        props: ['interface_name', 'hostname', 'mac','ip','username', 'link_login_only', 'link_orig', 'error'],
        name: "actionForm",
        methods:{
           async login(){
               try{
                  const response = await axios.post(`https://api.oyspot.loc/enter`,{
                        v1: 'kononova.ru',
                        v2: this.hostname,
                        v3: 'this.mac',
                        v4: this.ip,
                       v5: this.username,
                       v6: this.link_login_only,
                       v7: this.link_orig,
                       v8: this.error,
                   })
                   console.log(response.data)
               }catch(e){

               }

            }
        },
        mounted() {
            this.login()
        }
    }
</script>

<style scoped>

</style>
