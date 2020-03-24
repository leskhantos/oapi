<template>
    <div
        class="loader"
    >
        <orbit-spinner
            :size="100"
            :color="'#ffffff'"
        />
    </div>
</template>
<script>
    import { OrbitSpinner } from 'epic-spinners';

    export default {
        name: "loader",
        components:{
            OrbitSpinner
        }
    };
</script>
<style lang="scss">
    .loader {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        transition: 0.15s ease-in opacity;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: all;
        opacity: 1;
    }
</style>
