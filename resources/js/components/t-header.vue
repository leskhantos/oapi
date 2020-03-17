<template>
  <div class="header">
    <div class="header__logo-wrapper">
      <img class="header__logo" :src="wifi_image" />
    </div>
  </div>
</template>

<script>
import wifi_image from '../assets/wifi.png' 
export default {
  data: () => ({
    wifi_image: wifi_image
  })
}
</script>

<style lang="scss" scoped>
.header {
  display: flex;
  justify-content: center;

  &__logo-wrapper {
    width: 300px;
    height: 200px;
  }

  &__logo {
    width: 100%;
    height: auto;
  }
}
</style>