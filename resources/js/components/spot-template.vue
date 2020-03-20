<template>
    <div>
        <div v-if="showAgreement===false"
             class="main d-flex flex-column justify-content-between"
             :style="mainStyle"
        >
            <loader v-if="loading"/>
            <div class="container text-center header">
                <img :src="wifi_image" class="img-fluid"/>
            </div>
                <div class="container content" v-if="!loading && !error" >
                    <div class="text-center" v-if="data.type===1 || data.type===2">
                        Для продолжения введите свой номер телефона
                    </div>
                    <div class="text-center" v-else>
                        Для продолжения введите код с ваучера
                    </div>
                    <div class="mt-3">
                        <div class="input-group input-group-sm flex-nowrap" v-if="data.type===1 || data.type===2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img :src="phone" class="img-fluid"/></span>
                            </div>
                            <input
                                type="text"
                                class="form-control form-control"
                                placeholder="Номер телефона"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-success">ОК</button>
                            </div>
                        </div>
                        <div class="input-group input-group-sm flex-nowrap" v-else>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img :src="key" class="img-fluid"/></span>
                            </div>
                            <input
                                type="text"
                                class="form-control form-control"
                                placeholder="Код"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-success">ОК</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center" v-if="data.type===1 || data.type===2" :style="{ fontSize: '10px' }">
                        Примеры ввода номера:<br/>
                        Россия: 79213334455<br/>
                        США: 19876543210
                    </div>
<!--                    <div class="mt-3">-->
<!--                        <img :src="banner_image" class="img-fluid"/>-->
<!--                    </div>-->
                </div>
                <div class="container content text-center" v-if="error">
                    <h1>Ошибка: {{error}}</h1>
                </div>
            <div class="container footer" @click="showAgreement=true">
                <div class="d-flex justify-content-center">
                    <div :style="{ width: '100px' }">
                        <img :src="oyLogo" class="img-fluid"/>
                    </div>
                </div>
                <div class="text-center" :style="{ fontSize: '.8rem' }">Пользовательское соглашение</div>
                <div class="d-flex justify-content-center">
                    <div :style="{ width: '30px' }">
                        <img :src="arrow" class="img-fluid"/>
                    </div>
                </div>
            </div>
        </div>
        <agreement v-else @close="showAgreement=false"/>
    </div>
</template>

<script>
    import agreement from "./agreement";
    import loader from "./loader";
    import propsMixin from "../mixins/template-props";

    import wifi_image from "../assets/wifi.png";
    import oyLogo from "../assets/logo.svg";
    import arrow from "../assets/arrow.svg";
    import banner from "../assets/banner.jpg";
    import phone from "../assets/phone.svg"
    import key from "../assets/key.svg"
    import axios from "axios"

    export default {
        props: {
            data: {
                type: Object,
                required: false
            },
        },
        mounted() {
            this.loading=true
            // setTimeout(()=> this.login(), 1000);
            this.login()
        },
        mixins: [propsMixin],
        data: () => ({
            wifi_image: wifi_image,
            oyLogo: oyLogo,
            arrow: arrow,
            banner_image: banner,
            phone: phone,
            key: key,
            showAgreement: false,
            error: null,
            loading: null
        }),
        methods: {
            async login() {
                try {
                    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiM2Q1ZDhhNTdjNGRiZWI2M2QyNWY3MjE2M2Q3OTc3NWM2ODVjY2UwYzI3MzhhYmI3MGE3MjM5MGZkYmE3YzM2YzgxYWQzNWY4NjEzNjhkYzIiLCJpYXQiOjE1ODQ2OTQxNjIsIm5iZiI6MTU4NDY5NDE2MiwiZXhwIjoxNjE2MjMwMTYyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.L7c4SS1m0IDRWlXQYL2t8XmMKSTpqEF0wxCo2D4ShwlYc_n2BowzJW83Bw6i6yQfRNNvnTsctLwt_8Lpfc8ijhyc8dHDjA24Ej1Q2P725Lzl0B1G33mrMrW2L--DCBtRmHNnTMaN3v5jcCkMtrerExqc0RFP60_XRYpfzhs0WV81yAoGmRLHzw9u036Fc7XbnUgVoshfKM7s7xVMKW1J8WNfvIbjf2awwYG-C0O9ukCawRA1J2PaqrMtijteYp5pZqvnA9fvLHRgsDTFf2-9Fog36Yfx8wf-6MO0e88S17Q8NIXCFPUtiePs_dTilWWWZ04mZFt_D4mMVYpUkZp2f53sBZ--YTy27D_xqL7ihcz2RKKRyS47zm4ewWb0-XhXr2y_WUX0Tv6qjByhtRryCNzN5h1xh9Ulb5e-LiEBZNWb0Hp2qpjI2lVCSfReF0thae5Ox6__Qny4V7iu-LoTN8MjavB8zjaVzDhdt2BcthNWyIERbr86gfy6sLPHq3zlMdT5N3U3pWS6N19v-Lbm_0wWcpruZCQxnrnBUu5DkTgLPS2DgIskthURkK7A78TawXqcAYIUqC_fw9qQUf6lXWWZOV_JSCO74963_296SyhIOEW8HWyWMLUxGUh02bv8AAZjxcND1eb1jIbbM6Qy8xWvTKcKuaezm02Q3lvF23Y'
                    const config = {
                        headers: { Authorization: `Bearer ${token}` }
                    };
                    await axios.post(`https://api.oyspot.loc/enter`, {
                        v1: 'sidorova.ru',
                        v2: 3,
                        v3: 12,
                        v4: 3,
                        v5: this.v5,
                        v6: this.v6,
                        v7: this.v7,
                        v8: this.v8,
                    }, config)
                    this.loading=false
                    console.log(this.data)


                } catch (e) {
                    console.log(e.response.status)
                    this.error=e.response.status
                    this.loading=false
                    console.log(this.data)
                }
            }
        },
        computed: {
            mainStyle: function () {
                return {
                    backgroundColor: this.backgroundColor,
                    color: this.textColor
                };
            },
        },
        components: {
            agreement,
            loader
        }
    };
</script>

<style lang="scss" scoped>
    .main {
        min-height: 100vh;
        padding-top: 1rem; // without banner 4rem

        .header,
        .content,
        .footer {
            width: 300px;
        }

        .content {
            flex: 1;
        }
    }
</style>
