<template>
        <div class="input-group input-group-sm flex-nowrap">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <img v-if="src==='phone'" :src="phoneSvg" class="img-fluid"/>
                    <img v-else-if="src==='key'" :src="key" class="img-fluid"/>
                    <img v-else :src="smsSvg" class="img-fluid"/>
                </span>
            </div>
            <input
                :type="type"
                class="form-control form-control"
                :value="value"
                :placeholder="placeholder"
                @input="$emit('input', $event.target.value)"
                @keyup.enter="$emit('sendEnter')"
            />
            <div class="input-group-append">
                <button class="btn btn-success" @click="$emit('click')">ОК</button>
            </div>
        </div>
</template>

<script>
    import phone from "../assets/phone.svg"
    import key from "../assets/key.svg"
    import smsSvg from "../assets/message-processing.svg"
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
            },
            value: {
                type: [String, Number],
                required: false
            },
            type: {
                type: String,
                required: false,
                default: "text"
            },
        },
        data(){
            return {
                phoneSvg: phone,
                key: key,
                smsSvg: smsSvg
            }
        }
    }
</script>

<style scoped>
    .form-control:focus {
        box-shadow: none;
    }
    .btn-success:focus{
        box-shadow: none;
    }
</style>
