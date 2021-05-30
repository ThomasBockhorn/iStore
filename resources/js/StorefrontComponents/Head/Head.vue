<template>
  <header>
    <video controls autoplay muted loop>
      <source src="/mov/Bookcase.mp4" type="video/mp4" />
    </video>
    <div class="title">
      <h1>Shakespeare's Bookstore</h1>
    </div>
  </header>
</template>

<script>
export default {};
</script>

<style scoped>
video {
  position: fixed;
  left: 0;
  bottom: 0;
  min-width: 100%;
  min-height: 100%;
  z-index: -10;
}
.title {
  position: fixed;
  left: 50%;
  top: 50%;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
}
</style>