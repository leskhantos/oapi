<template>
    <div class="mt-3">
        <img :src="banner_image" class="img-fluid"/>
    </div>
</template>

<script>
    import banner from "../assets/banner.jpg";
    export default {
        name: "content-banner",
        data(){
            return {
                banner_image: banner,
            }
        }
    }
</script>

<style scoped>

</style>
