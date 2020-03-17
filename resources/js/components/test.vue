<template>
  <div class="test">
    This is Vue component
    <button @click="clicked">Click me</button>
  </div>
</template>

<script>
export default {
  methods: {
    clicked () {
      alert(123);
    }
  }
}
</script>

<style lang="scss" scoped>
.test {
  color: blue;
}
</style>