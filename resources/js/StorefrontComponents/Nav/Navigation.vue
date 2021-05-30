<template>
  <nav class="mt-8">
    <div class="grid sm:grid-cols-3 place-items-center grid-row-auto" id="top-navigation">
      <form class id="search" action>
        <input class="focus:border-blue-500" type="text" name="search" id="search" />
        <button
          class="border border-blue-500 rounded-md ml-2 p-2 font-bold hover:bg-blue-500 hover:text-white"
          type="submit"
        >Submit</button>
      </form>
      <div id="title">Title</div>
      <div id="navigation">
        <ul class="grid sm:grid-cols-3 place-items-center">
          <li>About Us</li>
          <li>News</li>
          <li>Wishlist</li>
          <li>Shop</li>
        </ul>
      </div>
    </div>

    <div class="grid sm:grid-cols-2 place-items-center" id="categories">
      <ul>
        <li>Categories</li>
      </ul>
      <div id="cart">Shopping cart image</div>
    </div>
  </nav>
</template>

<script>
export default {};
</script>

<style scoped>
nav {
  z-index: 10;
}
</style>