<template>
   <div>
      <h1>Accounts</h1>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus doloribus dignissimos ut commodi, voluptas asperiores aliquid
         nam amet pariatur ad magnam nisi illo laboriosam et, modi nobis necessitatibus quasi obcaecati!</p>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur enim quae voluptate. Molestiae quibusdam qui 
         dolore maxime cupiditate enim repellat!</p>

      <div class="flex flex-col">
         <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
               <div class="overflow-hidden">
               <table class="min-w-full">
                  <thead class="bg-white border-b">
                     <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           #
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Account Number
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Balance
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Status
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Branch
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Account Type
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Actions
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <!-- :class="{ 'bg-green' :  generate, 'bg-red' : }" -->
                     <tr v-for="(account, index) in accounts" :key="account.id" class="border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ account.account_number }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ account.balance }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ account.status[0].toUpperCase() + account.status.slice(1).toLowerCase() }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ account.branch.name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ account.account_type.name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           Buttons
                        </td>
                     </tr>
                  </tbody>
               </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script setup>
   // INITIAL CALL TO FETCH DATA(SSR)
   const { data : accounts, pending, refresh, error } =
      useCustomFetch('/api/accounts/index' ,{
            'method': 'GET',
            // body: formData
         }
      )

   console.log(toRaw(accounts.value));

   // 
         
</script>

<style scoped>
   h2{
      margin-bottom: 20px;
      font-size: 35px;
   }

   p{
      margin: 20px 0px;
   }
</style>