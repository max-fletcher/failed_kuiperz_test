<template>
   <div>
      <header class="shadow-sm bg-white">
         <nav class="container mx-auto p-4 flex justify-between">
            <nuxt-link to="/" class="font-bold">NuxtMain</nuxt-link>
            <ul class="flex gap-4">
               <li><NuxtLink to="/">Home</NuxtLink></li>
               <li><NuxtLink to="/accounts">Accounts</NuxtLink></li>
               <li><NuxtLink to="/account_types">Account Types</NuxtLink></li>
               <li><NuxtLink to="/branches">Branches</NuxtLink></li>
            </ul>
         </nav>
      </header>

      <div class="container mx-auto p-4">
         <slot />
      </div>
      
   </div>
</template>

<style scoped>
   .router-link-exact-active{
      color: #12b488;
   }
</style>