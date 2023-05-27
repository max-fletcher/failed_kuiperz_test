<template>
   <div class="mt-7 max-w-sm mx-auto text-center card">
      <p class="mt-7 text-7xl font-bold ">{{ error.statusCode }}</p>
      <p class="mt-7 text-6xl">Oops</p>
      <p class="mt-7">{{ error.message }}</p>
      <button class="btn my-7" @click="handleClearError">Go Home</button>
   </div>
</template>

<script setup>
   defineProps(['error'])

   // A function within a function. when the btn above is pressed, the "handleClearError" function is ran which in turn
   // runs the "clearError" function. The object inside "clearError" redirects the user to home(i.e '/').
   const handleClearError = () => clearError({ redirect: '/' })
</script>

<style lang="scss" scoped>

</style>