<template>
  <header class="flex">
    <video controls autoplay muted loop class="flex-auto">
      <source src="/mov/Bookcase.mp4" type="video/mp4" />
    </video>
    <div class="title flex-auto">
      <h1 class="text-center">Shakespeare's Bookstore</h1>
    </div>
  </header>
</template>

<script>
export default {};
</script>

<style scoped>
video {
  position: fixed;
  right: 0;
  bottom: 0;
  /**min-width: 100%;
  min-height: 100%;**/
  width: 100%;
  height: 100%;
  z-index: -10;
  object-fit: cover;
}
.title {
  position: fixed;
  top: 50%;
  left: 50%;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
}
header {
  top: 0;
  left: 0;
  width: 100vh;
  height: 100vh;
}
</style>