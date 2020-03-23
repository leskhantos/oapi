<template>
    <div class="container text-center header">
        <img :src="wifi_image" class="img-fluid"/>
    </div>
</template>

<script>
    import wifi_image from "../assets/wifi.png";
    export default {
        name: "logo",
        data(){
            return {
                wifi_image: wifi_image
            }
        }
    }
</script>

<style scoped>

</style>
