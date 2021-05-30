<template>
  <header>
    <video controls autoplay muted loop>
      <source src="/mov/Bookcase.mp4" type="video/mp4" />
    </video>
    <div class="title w-100">
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
  min-width: 100%;
  min-height: 100%;
  z-index: -10;
  object-fit: cover;
}
.title {
  position: fixed;
  left: 50%;
  top: 50%;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
}
header {
  width: 100%;
  height: 50%;
}
</style>