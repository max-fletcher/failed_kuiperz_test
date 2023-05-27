<template>
   <div>
      <h1>Home</h1>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus doloribus dignissimos ut commodi, voluptas asperiores aliquid
         nam amet pariatur ad magnam nisi illo laboriosam et, modi nobis necessitatibus quasi obcaecati!</p>
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur enim quae voluptate. Molestiae quibusdam qui 
         dolore maxime cupiditate enim repellat!</p>

      <!-- table component -->
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
                           Month
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Date
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Day
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Id
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Employee Name
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Department
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           First In Time
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Last Out Time
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                           Hours of Work
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <!-- :class="{ 'bg-green' :  generate, 'bg-red' : }" -->
                     <tr v-for="(data, index) in excel_data" :key="data.id" class="border-b" :class="{ 'bg-white' : data.bg_color == undefined, 'bg-red-400' : data.bg_color === 'red', 'bg-yellow-300' : data.bg_color === 'yellow' }">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ index }}</td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.month }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.date }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.day }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.id }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.employee_name }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.department }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.first_in_time }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.last_out_time }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                           {{ data.hours_of_work }}
                        </td>
                     </tr>
                  </tbody>
               </table>
               </div>
            </div>
         </div>
      </div>

      <div v-show="show_invalid_times" class="mt-5 mb-5 px-3 leading-normal text-red-600 bg-red-100 rounded-lg" role="alert">
         <p class="py-3"> {{ show_error_message }} </p>
      </div>

      <!-- <input type="file" @change="handleFileSelection($event)"/> -->
      <div class="flex justify-center">
         <button @click="generate_report" class="mt-3 mx-2 px-6 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-emerald-100 bg-emerald-500 hover:bg-emerald-600 shadow-emerald-400">Generate Report</button>

         <button @click="downloadPDF" v-if="showDownload" class="mt-3 mx-2 px-6 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-emerald-100 bg-emerald-500 hover:bg-emerald-600 shadow-emerald-400">Download PDF</button>

         <div class="mx-2">
            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">First In Time</label>
            <div class="relative mt-2 rounded-md shadow-sm">
               <input v-model="first_in_time" @keyup="new_func" type="text" name="price" id="price"
                     placeholder="00:00"
                     class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
         </div>

         <div class="mx-2">
            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Last Time Out</label>
            <div class="relative mt-2 rounded-md shadow-sm">
               <input v-model="last_out_time" @keyup="new_func" type="text" name="price" id="price"
                     placeholder="00:00"
                     class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
         </div>

         <div class="mx-2">
            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Employee ID</label>
            <div class="relative mt-2 rounded-md shadow-sm">
               <input v-model="employee_id" @keyup="new_func" type="text" name="price" id="price"
                     class="block w-full rounded-md border-0 py-1.5 pl-3 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
            </div>
         </div>
      </div>
   </div>

</template>

<script setup>
   const config = useRuntimeConfig()

   let formData = new FormData();

   const { data : excel_data, pending, refresh, error } = useCustomFetch('/api/generate_report'
                                             ,{
                                                'method': 'POST',
                                                body: formData
                                             }
                                           )
   console.log(toRaw(excel_data.value));

   const files = ref([]);
   const showDownload = ref(false)
   const handleFileSelection = ( event ) => {
      let uploadedFiles = event.target.files
      files.value.push(uploadedFiles[0])
      console.log(uploadedFiles, files)
   }

   // GENERATE REPORT

   // times
   const first_in_time = ref('')
   const last_out_time = ref('')
   //id
   const employee_id = ref('')

   // error bool and message
   const show_invalid_times = ref(false)
   const show_error_message = ref('')

   const new_func = () => {
      show_invalid_times.value = false
      show_error_message.value = ''
      console.log(first_in_time, last_out_time, employee_id);
   }

   const generate_report = () => {
      // console.log(first_in_time.value, last_out_time.value);
      const fit_times = first_in_time.value.split(":")
      const lot_times = last_out_time.value.split(":")

      // console.log(fit_times, fit_times.length, lot_times, lot_times.length);
      // console.log(fit_times.length !== 2, fit_times.length === 2);

      // if(first_in_time.length == 0 && last_out_time.lenght == 0){
      //    show_error_message.value = "All fields are missing. Please input some values and try again."
      //    show_invalid_times.value = true
      //    return
      // }

      // if(fit_times.length !== 2 || lot_times.length !== 2){
      //    show_error_message.value = "Invalid time format for First In Time or Last Out Time. It has to be in the format \"00:00\"."
      //    show_invalid_times.value = true
      //    return
      // }

      formData.append('fit_hh', fit_times[0])
      formData.append('fit_mm', fit_times[1])
      formData.append('lot_hh', lot_times[0])
      formData.append('lot_mm', lot_times[1])
      formData.append('employee_id', employee_id.value)

      refresh()

      // console.log(fit_hh.value, fit_mm.value, lot_hh.value, lot_mm.value);

      // let formData = new FormData();

      // formData.append('excel', files.value[0])

      // console.log(files);
      // // Display the key/value pairs
      // for (var pair of formData.entries()) {
      //    console.log(pair[0]+ ', ' + pair[1]); 
      // }

      showDownload.value = true
   }
   // END GENERATE REPORT

   // DOWNLOAD PDF

   const downloadPDF = () => {
      // const url = config.public.baseURL + '/icbs_primax_test'
      // window.location.href = url;

      $fetch(`/api/download_pdf`, {
         baseURL: config.public.baseURL,
         method: 'POST',
         body: formData,
         headers: {
            responseType: 'blob'
         }
      }).then(response => {
         const url = window.URL.createObjectURL(new Blob([response]));
         const link = document.createElement('a');
         link.href = url;
         link.setAttribute('download', 'icbs_primax_test.pdf');
         document.body.appendChild(link);
         link.click();

         // var file = window.URL.createObjectURL(response);
         // window.location.assign(file);
      })
   }

   // END DOWNLOAD PDF
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