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
    import axios from "axios";
    import VueScreenSize from 'vue-screen-size';
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
            this.enter()
        },
        mixins: [propsMixin, VueScreenSize.VueScreenSizeMixin],
        data: () => ({
            showAgreement: false,
            error: null,
            loading: null,
            phone: null,
            smsInputShow:null,
            sms: '',
            code: '',
            user: '',
            password:''

        }),
        methods: {
            async enter() {
                try {
                    await axios.post(``, {
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
                        screen_w: this.$vssWidth,
                        screen_h: this.$vssHeight
                    })
                    this.loading=false
                    console.log(this.data)

                } catch (e) {
                    this.error=e.response.data
                    this.loading=false
                }
            },
            async login(){
                try {
                    const response = await axios.post(`enter/${this.data.v1}`, {
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
                        phone: this.phone,
                    })
                    this.phone=null;
                    if(this.data.type===1){
                        this.smsInputShow=response.data
                    }
                } catch (e) {
                    this.error=e.response.data
                }
            },
           async sendCode(){
                try {
                    const response = await axios.post(`enter/${this.data.v1}`, {
                        v1: this.data.v1,
                        v2: this.data.v2,
                        v3: this.data.v3,
                        v4: this.data.v4,
                        v5: this.data.v5,
                        v6: this.data.v6,
                        v7: this.data.v7,
                        v8: this.data.v8,
                        code: this.code,
                    })
                    this.code=null;
                     this.user=response.data.user;
                     this.password=response.data.password;
                     this.auth()
                    alert(this.user)
                } catch (e) {
                    this.error=e.response.data
                }
            },
            async auth(){
                try {
                    alert('отправлено:'+this.data.v6);
                     await axios.post(`${this.data.v6}`,{
                        username: this.user,
                        password: this.password
                    })
                    alert('отправлено:'+this.data.v6);
                }catch(e){
                    alert('error:'+ e.response.data);
                    this.error=e.response.data
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
