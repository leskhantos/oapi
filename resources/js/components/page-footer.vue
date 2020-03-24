<template>
    <div class="container footer" @click="$emit('click')">
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
</template>

<script>
    import oyLogo from "../assets/logo.svg";
    import arrow from "../assets/arrow.svg";
    export default {
        name: "page-footer",
        data(){
            return {
                oyLogo: oyLogo,
                arrow: arrow,
            }
        }
    }
</script>

<style scoped>

</style>
