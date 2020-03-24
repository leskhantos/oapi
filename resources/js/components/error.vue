<template>
    <div class="container content text-center" v-if="error">
        <h1>Ошибка: {{error}}</h1>
    </div>
</template>

<script>
    export default {
        name: "error",
        props:{
            error:{
                type: [String, Number],
                required: false
            }
        }
    }
</script>

<style scoped>

</style>
