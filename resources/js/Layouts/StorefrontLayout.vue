<template>
  <div>
    <!--Main navigation bar-->
    <Nav />

    <main>
      <slot></slot>
    </main>
  </div>
</template>

<script>
import Nav from "@/StorefrontComponents/Nav/Navigation";
export default {
  components: {
    Nav
  }
};
</script>

<style>
</style>