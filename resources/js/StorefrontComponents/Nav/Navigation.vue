<template>
  <div class="mt-8 p-5">
    <div class="grid sm:grid-cols-2 place-content-center" id="top-navigation">
      <form class="grid-col-2" id="search" action>
        <input class="focus:border-blue-500" type="text" name="search" id="search" />
        <button
          class="border border-blue-500 rounded-md ml-2 p-2 font-bold hover:bg-blue-500 hover:text-white text-white"
          type="submit"
        >Submit</button>
      </form>
      <div id="title-nav" class="grid sm:grid-cols-2">
        <div id="title" class="text-white mt-2 pt-2 text-2xl">Shakespeare's Bookstore</div>
        <button class="inline-block md:hidden w-8 h-8 bg-transparent text-white p-1">
          <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
        <nav class="absolute md:relative top-16 left-0 md:top-0 z-20">
          <ul
            class="flex flex-col md:flex-row md:space-x-6 md:text-white mt-2 pt-2 md:w-auto bg-gray-100 md:bg-transparent text-black md:p-0"
          >
            <li>About Us</li>
            <li>News</li>
            <li>Wishlist</li>
            <li>Shop</li>
          </ul>
        </nav>
      </div>
    </div>

    <div class="grid sm:grid-cols-2 place-items-center" id="categories">
      <ul>
        <li>Categories</li>
      </ul>
      <div id="cart">Shopping cart image</div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
nav {
  z-index: 10;
}
</style>