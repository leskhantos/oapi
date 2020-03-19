<template>
    <form id="login" name="login" action="http://login.site/login" method="post">
        <input type="hidden" name="v1" :value="interface_name">
        <input type="hidden" name="v2" :value="hostname">
        <input type="hidden" name="v3" :value="mac">
        <input type="hidden" name="v4" :value="ip">
        <input type="hidden" name="v5" :value="username">
        <input type="hidden" name="v6" :value="link_login_only">
        <input type="hidden" name="v7" :value="link_orig">
        <input type="hidden" name="v8" :value="error">
    </form>
</template>

<script>
    export default {
        props: ['interface_name', 'hostname', 'mac','ip','username', 'link_login_only', 'link_orig', 'error'],
        name: "actionForm"
    }
</script>

<style scoped>

</style>
