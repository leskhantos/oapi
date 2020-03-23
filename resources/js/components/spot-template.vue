<template>
    <div>
        <div v-if="showAgreement===false"
             class="main d-flex flex-column justify-content-between"
             :style="mainStyle"
        >
            <loader v-if="loading"/>
            <logo/>
                <div class="container content" v-if="!loading && !error" >
                    <content-title v-if="(type===1 || type===2) && !smsInputShow" v-model="phone" title='Для продолжения введите свой номер телефона'/>
                    <content-title v-else-if="type===3 && !smsInputShow" title='Для продолжения введите код с ваучера'/>
                    <content-title v-else-if="smsInputShow" title=' Для продолжения введите SMS'/>
                    <div class="mt-3">
                        <content-body src="phone" placeholder="Номер телефона" v-model="phone"
                                      v-if="(type===1 || type===2) && !smsInputShow"
                                      @click="login" @sendEnter="login"
                                      type="text"/>
                        <content-body src="key" placeholder="Код" v-model="code" type="text" v-else-if="type===3 && !smsInputShow" @click="sendCode" @sendEnter="sendCode"/>
                        <transition name="slide-fade">
                            <content-body src="smsSvg" placeholder="SMS" v-model="sms" type="text"  v-if="smsInputShow"/>
                        </transition>
                    </div>
                    <content-hints v-if="type===1 || type===2"/>
                    <content-banner v-show="false" />
                </div>
                <error :error="error"/>
            <pageFooter @click="showAgreement=true"/>
        </div>
            <agreement v-else @close="showAgreement=false"/>
    </div>
</template>

<script>
    import axios from "axios"
    import propsMixin from "../mixins/template-props";

    import agreement from "./agreement";
    import loader from "./loader";
    import ContentTitle from "./content-title";
    import ContentBody from "./content-body";
    import ContentHints from "./content-hints";
    import Logo from "./header-logo";
    import ContentBanner from "./content-banner";
    import error from "./error"
    import pageFooter from "./page-footer"

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
            showAgreement: false,
            error: null,
            loading: null,
            phone: null,
            smsInputShow:null,
            sms: '',
            code: ''

        }),
        methods: {
            async enter() {
                try {
                    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTBlNDk4NDYxODE1NTMzMzgzZmNlZjA0N2NhMThkZTQyYjQ0YzEwNzBlZDQwYThkYTY5MTEzYWQ3ZThiOTNlOTllOGRiYTBmYjg2NWZkZjciLCJpYXQiOjE1ODQ3MDY1NDcsIm5iZiI6MTU4NDcwNjU0NywiZXhwIjoxNjE2MjQyNTQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JCFMCOdFnbSnd4wTNRvS6Rn78jp9kmJzsi-YjOxuMlnyQHppPFlyKTQMsSVBSamQXU5_UXF_SMz3jsZfvgcICFg876kP72mcYgFn_7Z7GfiP50H0ix-gaNnLGItv_7PylCwcXrSkNt9DnQu_1453Wni_bz_GGZiHl6MLdJAUKsrzkki_ieMbIaFITZMNFZcp9VVxh_PeIbsOIMb4LGK87Op9cURPnXe6bnCYLjnDQ2gqm-WBVmdT-6fqUaAJFKH7W7mzjgK1-e2PaJTxRU5miI2O4WfsJguaaQDtib46m3cciyriWSuWQs6WrOG8KC41pZQfa-umYy6Jxl8QYTOZApKq3QEaey0qPAfeXUkTw5sbNX7HYAwH-LeVCPJn-JroN9xRS8HvwQ45KrcsvkeWyJerMQmhCbdpz_XGOX1G7QRy7Rf8CPqrjzWlBtUIlz2yXOID46qyEC0RmkNQRh3uOqzJjvALi7Vd4KJnmw06O-brQzjpp-QiWjf0vmukNLGQSDO0-IPAh3EF9AxJdCc6eLB6bZuH5_a9WqDAhsonrlSg85a8UMOGToYgX26JgJy8rDPTpLPd0wR0qwzCgJxJTXXN8te8z_dQP4TkdZA64vt3DAAUng7oVyM_pGRv6Hv_EO-H1Hdqf1XtMv5yUz41N-aWh8ItAxlxL8YBuegErZM'

                    const config = {
                        headers: { Authorization: `Bearer ${token}` }
                    };
                    console.log(this.data)

                    await axios.post(`https://api.oyspot.loc/enter`, {
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
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
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
                        phone: this.phone,
                    }, config)
                    this.phone=null;
                    if(this.data.type===1){
                        this.smsInputShow=response.data
                    }

                    console.log(response.data)
                    // alert(response.data? response.data : 'success')
                } catch (e) {
                    console.log(e.response.status)
                    this.error=e.response.status
                }
            },
           async sendCode(){
                try {
                    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTBlNDk4NDYxODE1NTMzMzgzZmNlZjA0N2NhMThkZTQyYjQ0YzEwNzBlZDQwYThkYTY5MTEzYWQ3ZThiOTNlOTllOGRiYTBmYjg2NWZkZjciLCJpYXQiOjE1ODQ3MDY1NDcsIm5iZiI6MTU4NDcwNjU0NywiZXhwIjoxNjE2MjQyNTQ3LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.JCFMCOdFnbSnd4wTNRvS6Rn78jp9kmJzsi-YjOxuMlnyQHppPFlyKTQMsSVBSamQXU5_UXF_SMz3jsZfvgcICFg876kP72mcYgFn_7Z7GfiP50H0ix-gaNnLGItv_7PylCwcXrSkNt9DnQu_1453Wni_bz_GGZiHl6MLdJAUKsrzkki_ieMbIaFITZMNFZcp9VVxh_PeIbsOIMb4LGK87Op9cURPnXe6bnCYLjnDQ2gqm-WBVmdT-6fqUaAJFKH7W7mzjgK1-e2PaJTxRU5miI2O4WfsJguaaQDtib46m3cciyriWSuWQs6WrOG8KC41pZQfa-umYy6Jxl8QYTOZApKq3QEaey0qPAfeXUkTw5sbNX7HYAwH-LeVCPJn-JroN9xRS8HvwQ45KrcsvkeWyJerMQmhCbdpz_XGOX1G7QRy7Rf8CPqrjzWlBtUIlz2yXOID46qyEC0RmkNQRh3uOqzJjvALi7Vd4KJnmw06O-brQzjpp-QiWjf0vmukNLGQSDO0-IPAh3EF9AxJdCc6eLB6bZuH5_a9WqDAhsonrlSg85a8UMOGToYgX26JgJy8rDPTpLPd0wR0qwzCgJxJTXXN8te8z_dQP4TkdZA64vt3DAAUng7oVyM_pGRv6Hv_EO-H1Hdqf1XtMv5yUz41N-aWh8ItAxlxL8YBuegErZM'

                    const config = {
                        headers: { Authorization: `Bearer ${token}` }
                    };
                    const response = await axios.post(`https://api.oyspot.loc/enter/${this.data.v1}`, {
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
                        code: this.code,
                    }, config)
                    this.code=null;
                     console.log(response.data)
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
            ContentBanner,
            Logo,
            ContentHints,
            ContentBody,
            ContentTitle,
            agreement,
            loader,
            error,
            pageFooter
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
        .slide-fade-enter-active {
            transition: all .3s ease;
        }
        .slide-fade-leave-active {
            transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
        }
        .slide-fade-enter, .slide-fade-leave-to {
            transform: translateX(30px);
            opacity: 0;
        }
    }
</style>
