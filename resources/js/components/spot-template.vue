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
                    <content-title v-if="(type===1 || type===2) && !smsInputShow" title='Для продолжения введите свой номер телефона'/>
                    <content-title v-else-if="type===3 && !smsInputShow" title='Для продолжения введите код с ваучера'/>
                    <content-title v-else title=' Для продолжения введите SMS'/>
                    <div class="mt-3">
                        <div class="input-group input-group-sm flex-nowrap" v-if="(type===1 || type===2) && !smsInputShow">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img :src="phoneSvg" class="img-fluid"/></span>
                            </div>
                            <input
                                type="tel"
                                class="form-control form-control"
                                placeholder="Номер телефона"
                                v-model="phone"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-success" @click="login">ОК</button>
                            </div>
                        </div>
                        <div class="input-group input-group-sm flex-nowrap" v-else-if="type===3 && !smsInputShow">
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
                        <div class="input-group input-group-sm flex-nowrap" v-if="smsInputShow">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img :src="smsSvg" class="img-fluid"/></span>
                            </div>
                            <input
                                type="text"
                                class="form-control form-control"
                                placeholder="SMS"
                                v-model="sms"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-success">ОК</button>
                            </div>
                        </div>

                    </div>
                    <div class="mt-3 text-center" v-if="type===1 || type===2" :style="{ fontSize: '10px' }">
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
    import smsSvg from "../assets/message-processing.svg"
    import axios from "axios"
    import ContentTitle from "./content-title";

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
            this.enter()
        },
        mixins: [propsMixin],
        data: () => ({
            wifi_image: wifi_image,
            oyLogo: oyLogo,
            arrow: arrow,
            banner_image: banner,
            phoneSvg: phone,
            key: key,
            smsSvg: smsSvg,
            showAgreement: false,
            error: null,
            loading: null,
            phone: null,
            smsInputShow:null,
            sms: ''

        }),
        methods: {
            async enter() {
                try {
                    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTBlNDk4NDYxODE1NTMzMzgzZmNlZjA0N2NhMThkZTQyYjQ0YzEwNzBlZDQwYThkYTY5MTEzYWQ3ZThiOTNlOTllOGRiYTBmYjg2NWZkZjciLCJpYXQiOjE1ODQ3MDY1NDcsIm5iZiI6MTU4NDcwNjU0NywiZXhwIjoxNjE2MjQyNTQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JCFMCOdFnbSnd4wTNRvS6Rn78jp9kmJzsi-YjOxuMlnyQHppPFlyKTQMsSVBSamQXU5_UXF_SMz3jsZfvgcICFg876kP72mcYgFn_7Z7GfiP50H0ix-gaNnLGItv_7PylCwcXrSkNt9DnQu_1453Wni_bz_GGZiHl6MLdJAUKsrzkki_ieMbIaFITZMNFZcp9VVxh_PeIbsOIMb4LGK87Op9cURPnXe6bnCYLjnDQ2gqm-WBVmdT-6fqUaAJFKH7W7mzjgK1-e2PaJTxRU5miI2O4WfsJguaaQDtib46m3cciyriWSuWQs6WrOG8KC41pZQfa-umYy6Jxl8QYTOZApKq3QEaey0qPAfeXUkTw5sbNX7HYAwH-LeVCPJn-JroN9xRS8HvwQ45KrcsvkeWyJerMQmhCbdpz_XGOX1G7QRy7Rf8CPqrjzWlBtUIlz2yXOID46qyEC0RmkNQRh3uOqzJjvALi7Vd4KJnmw06O-brQzjpp-QiWjf0vmukNLGQSDO0-IPAh3EF9AxJdCc6eLB6bZuH5_a9WqDAhsonrlSg85a8UMOGToYgX26JgJy8rDPTpLPd0wR0qwzCgJxJTXXN8te8z_dQP4TkdZA64vt3DAAUng7oVyM_pGRv6Hv_EO-H1Hdqf1XtMv5yUz41N-aWh8ItAxlxL8YBuegErZM'

                    const config = {
                        headers: { Authorization: `Bearer ${token}` }
                    };
                    await axios.post(`https://api.oyspot.loc/enter`, {
                        v1: 'ersova.com',
                        v2: 3,
                        v3: 1,
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
            },
            async login(){
                try {
                    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTBlNDk4NDYxODE1NTMzMzgzZmNlZjA0N2NhMThkZTQyYjQ0YzEwNzBlZDQwYThkYTY5MTEzYWQ3ZThiOTNlOTllOGRiYTBmYjg2NWZkZjciLCJpYXQiOjE1ODQ3MDY1NDcsIm5iZiI6MTU4NDcwNjU0NywiZXhwIjoxNjE2MjQyNTQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JCFMCOdFnbSnd4wTNRvS6Rn78jp9kmJzsi-YjOxuMlnyQHppPFlyKTQMsSVBSamQXU5_UXF_SMz3jsZfvgcICFg876kP72mcYgFn_7Z7GfiP50H0ix-gaNnLGItv_7PylCwcXrSkNt9DnQu_1453Wni_bz_GGZiHl6MLdJAUKsrzkki_ieMbIaFITZMNFZcp9VVxh_PeIbsOIMb4LGK87Op9cURPnXe6bnCYLjnDQ2gqm-WBVmdT-6fqUaAJFKH7W7mzjgK1-e2PaJTxRU5miI2O4WfsJguaaQDtib46m3cciyriWSuWQs6WrOG8KC41pZQfa-umYy6Jxl8QYTOZApKq3QEaey0qPAfeXUkTw5sbNX7HYAwH-LeVCPJn-JroN9xRS8HvwQ45KrcsvkeWyJerMQmhCbdpz_XGOX1G7QRy7Rf8CPqrjzWlBtUIlz2yXOID46qyEC0RmkNQRh3uOqzJjvALi7Vd4KJnmw06O-brQzjpp-QiWjf0vmukNLGQSDO0-IPAh3EF9AxJdCc6eLB6bZuH5_a9WqDAhsonrlSg85a8UMOGToYgX26JgJy8rDPTpLPd0wR0qwzCgJxJTXXN8te8z_dQP4TkdZA64vt3DAAUng7oVyM_pGRv6Hv_EO-H1Hdqf1XtMv5yUz41N-aWh8ItAxlxL8YBuegErZM'

                    const config = {
                        headers: { Authorization: `Bearer ${token}` }
                    };
                    const response = await axios.post(`https://api.oyspot.loc/enter/${this.data.v1}`, {
                        v1: 'ersova.com',
                        v2: 3,
                        v3: 1,
                        v4: 3,
                        v5: this.v5,
                        v6: this.v6,
                        v7: this.v7,
                        v8: this.v8,
                        phone: this.phone,
                    }, config)
                    this.phone=null;
                    if(response.data==='otpravil sms'){
                        this.smsInputShow=response.data
                    }
                    // alert(response.data? response.data : 'success')
                } catch (e) {
                    console.log(e.response.status)
                    this.error=e.response.status
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
            type:function () {
                return this.data.type
            }
        },
        components: {
            ContentTitle,
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
