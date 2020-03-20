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
                <div class="container content" v-if="!loading">
                    <div class="text-center">
                        Для продолжения введите свой номер телефона
                    </div>
                    <div class="mt-3">
                        <div class="input-group input-group-sm flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
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
                    </div>
                    <div class="mt-3 text-center" :style="{ fontSize: '10px' }">
                        Примеры ввода номера:<br/>
                        Россия: 79213334455<br/>
                        США: 19876543210
                    </div>
                    <div class="mt-3">
                        <img :src="banner_image" class="img-fluid"/>
                    </div>
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
    import axios from "axios"

    export default {
        props: {
            data: {
                type: Object,
                required: false
            },
        },
        mounted() {
            this.$wait.start('my');
            this.loading=true
            setTimeout(() => this.login(), 3000);
            this.$wait.end('my');
        },
        mixins: [propsMixin],
        data: () => ({
            wifi_image: wifi_image,
            oyLogo: oyLogo,
            arrow: arrow,
            banner_image: banner,
            showAgreement: false,
            loading: null
        }),
        methods: {
            async login() {
                try {
                    this.loading=false
                    const response = await axios.post(`https://api.oyspot.loc/enter`, {
                        v1: this.v1,
                        v2: this.v2,
                        v3: this.v3,
                        v4: this.v4,
                        v5: this.v5,
                        v6: this.v6,
                        v7: this.v7,
                        v8: this.v8,
                    })
                    console.log(response.data)
                } catch (e) {

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
