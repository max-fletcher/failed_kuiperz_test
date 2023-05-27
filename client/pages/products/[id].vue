<template>
   <div>
      <ProductDetails :product="product" />
   </div>
</template>

<script setup>
   const { id } = useRoute().params

   const uri = 'https://fakestoreapi.com/products/' + id
   // As a 2nd argument, the options object '{ key: id }' is passed so that the route param changes properly.
   const { data: product } = await useFetch(uri, { key: id })

   // if no product exists, then go to error page with statusCode of 404 & statusMessage. "fatal" causes any Nuxtlink tags to
   // throw error page if it matches a route but doesn't have valid route params.
   if(!product.value){
      throw createError({ statusCode: 404, statusMessage: "Product Not Found", fatal: true })
   }

   definePageMeta({
      layout: 'products'
   })
</script>

<style scoped>

</style>