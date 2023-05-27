<template>
   <div>
     <div class="space-y-12">
       <div class="border-b border-gray-900/10 pb-12">
         <h2 class="text-base font-semibold leading-7 text-gray-900">Create Account</h2>
         <p class="mt-1 text-sm leading-6 text-gray-600">Create new bank account</p>
 
         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
           <div class="sm:col-span-12 sm:col-start-1">
             <label for="balance" class="block text-sm font-medium leading-6 text-gray-900">Account balance</label>
             <div class="mt-2">
               <input v-model="balance" type="text" name="balance" id="balance" autocomplete="off" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
             </div>
           </div>
         </div>

         <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-2">
               <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Account Status</label>
               <div class="mt-2">
                  <select v-model="status" id="status" name="status" autocomplete="off" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                     <option v-for="(status, index) in statuses" :key="index" :selected="index == 0" :value="status">
                        {{ status[0].toUpperCase() + status.slice(1).toLowerCase() }}
                     </option>
                  </select>
               </div>
            </div>

            <div class="sm:col-span-2">
               <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Account Type</label>
               <div class="mt-2">
                  <select v-model="account_type_id" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                     <option v-for="(account_type, index) in account_types" :key="account_type.id" :value="account_type.id">
                        {{ account_type.name }}
                     </option>
                  </select>
               </div>
            </div>

            <div class="sm:col-span-2">
               <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Branch Name</label>
               <div class="mt-2">
                  <select v-model="branch_id" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                     <option v-for="(branch, index) in branches" :key="branch.id" :value="branch.id">
                        {{ branch.name }}
                     </option>
                  </select>
               </div>
            </div>
         </div>
       </div>
     </div>
 
     <div class="mt-6 flex items-center justify-end gap-x-6">
       <button @click="create_account()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
         Save
      </button>
     </div>
   </div>
</template>

<script setup>
   const config = useRuntimeConfig()
   // INITIAL CALL TO FETCH DATA(SSR)
   const { data: account_types, pending : account_type_pending, refresh: account_type_refresh, error: account_type_error } =
      useCustomFetch('/api/account_types/index' ,{
            'method': 'GET',
            // body: formData
         }
      )

   const { data : branches, pending : branches_pending, refresh: branches_refresh, error: branches_error } =
      useCustomFetch('/api/branches/index' ,{
            'method': 'GET',
            // body: formData
         }
      )

   const statuses = ['pending', 'deposit', 'withdrawal', 'restricted', 'frozen', 'inactive', 'active']

   console.log(toRaw(account_types.value), toRaw(branches.value));

   const balance = ref('')
   const status = ref('')
   const branch_id = ref('')
   const account_type_id = ref('')

   const create_account = () => {
      // const url = config.public.baseURL + '/icbs_primax_test'
      // window.location.href = url;

      let formData = new FormData();
      formData.append('balance', balance._rawValue)
      formData.append('status', status._rawValue)
      formData.append('branch_id', branch_id._rawValue)
      formData.append('account_type_id', account_type_id._rawValue)

      console.log(balance._rawValue, status._rawValue, branch_id._rawValue, account_type_id._rawValue);

      for (var pair of formData.entries()) {
         console.log(pair[0]+ ', ' + pair[1]); 
      }

      $fetch(`/api/accounts/store`, {
         baseURL: config.public.baseURL,
         method: 'POST',
         body: formData,
      }).then(response => {
         console.log(response)

         if(response.status === 'success'){

         }
      })
   }
</script>

<style scoped>

</style>