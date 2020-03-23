<template>
    <div class="mt-3">
        <div class="input-group input-group-sm flex-nowrap">
            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img :src="src" class="img-fluid"/></span>
            </div>
            <input
                type="text"
                class="form-control form-control"
                :placeholder="placeholder"
                @input="$emit('input', $event.target.value)"
            />
            <div class="input-group-append">
                <button class="btn btn-success" @click="$emit('click')">ОК</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "content-body",
        props:{
            src:{
                type: String,
                required: false
            },
            placeholder:{
                type:String,
                required: false
            }
        },
        data(){
            return {
                src: this.props.src
            }
        }
    }
</script>

<style scoped>

</style>
