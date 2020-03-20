<template>
        <div class="text-center">
            {{ title }}
        </div>
</template>

<script>
    export default {
        props:{
            title:{
                type:String,
                required:false
            }
        }
    }
</script>

<style scoped>

</style>
