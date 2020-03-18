<template>
    <div>
    <div v-if="showAgreement===false"
        class="main d-flex flex-column justify-content-between"
        :style="mainStyle"
    >
        <div class="container text-center header">
            <img :src="wifi_image" class="img-fluid" />
        </div>
        <div class="container content">
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
              Примеры ввода номера:<br />
              Россия: 79213334455<br />
              США: 19876543210
            </div>
            <div class="mt-3">
              <img :src="banner_image" class="img-fluid" />
            </div>
        </div>
        <div class="container footer" @click="showAgreement=true">
            <div class="d-flex justify-content-center">
                <div :style="{ width: '100px' }">
                    <img :src="oyLogo" class="img-fluid" />
                </div>
            </div>
            <div class="text-center" :style="{ fontSize: '.8rem' }">Пользовательское соглашение</div>
            <div class="d-flex justify-content-center">
                <div :style="{ width: '30px' }">
                    <img :src="arrow" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
    <agreement v-else id="agreement" v-show="showAgreement" @close="showAgreement=false"/>
    </div>
</template>

<script>
import agreement from "./agreement";
import propsMixin from "../mixins/template-props";

import wifi_image from "../assets/wifi.png";
import oyLogo from "../assets/logo.svg";
import arrow from "../assets/arrow.svg";
import banner from "../assets/banner.jpg";

export default {
    mixins: [propsMixin],
    data: () => ({
        wifi_image: wifi_image,
        oyLogo: oyLogo,
        arrow: arrow,
        banner_image: banner,
        showAgreement:false
    }),
    computed: {
        mainStyle: function() {
            return {
                backgroundColor: this.backgroundColor,
                color: this.textColor
            };
        }
    },
    components: {
        agreement
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
