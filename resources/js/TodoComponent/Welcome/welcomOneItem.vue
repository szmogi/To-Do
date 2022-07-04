<script setup>
 import NavLinkMe from '@/Components/NavLinkMe.vue';
</script>

<template>
        <div class="grid grid-cols-2 gap-4 text-center">
            <div class="col-span-1  m-10 ">
                <label for="category">Category</label>
                <h1 class="p-4 text-xl font-bold shadow-md text-gray-700 rounded-lg  bg-blue-200">
                    {{this.oneItem.category_name}}
                </h1>
            </div>
            <div class=" m-10">
                <label for="dateTime">Date time</label>
                <h2 class="p-4 text-xl font-bold shadow-md text-gray-700 rounded-lg bg-blue-200 ">
                   {{this.formatDate(this.oneItem.updated_at)}}
                </h2>
            </div>
            <div class="col-span-2 m-10">
                <label for="task">Task</label>
                <p class="p-4 text-xl font-bold shadow-md text-gray-700 rounded-lg bg-blue-200">
                   {{this.oneItem.task}}
                </p>
            </div>
            <div class="col-span-1 rounded-lg bg-blue-200 m-10 text-xl font-bold shadow-md text-gray-700 ">
                <h1 >Public</h1>
                <span v-if="this.oneItem.public === 1" class="text-md text-green-600">&#10004;</span>
                <span v-else class="text-md text-red-800">&#10006;</span>
            </div>
            <div class="col-span-1 rounded-lg bg-blue-200 m-10 text-xl font-bold shadow-md text-gray-700">
                <h1>Done</h1>
                <span v-if="this.oneItem.done === 1" class="text-md text-green-600">&#10004;</span>
                <span v-else class="text-md text-red-800">&#10006;</span>
            </div>
        </div>
        <div class="text-center">
            <div  class="text-2xl text-center m-2 text-zinc-800/80 font-bold inline-flex items-center " >
                 <h3 class="cursor-pointer" onclick="history.back()">Go Back</h3>
            </div>


        </div>      
</template>

<script>
import dayjs from 'dayjs';
export default {
    props: {
        oneItem:{
            type:Object,Array
        },
       
    },
    data () {        

        return {

        }
    },methods: {
         formatDate(dateString) {
                    const data = dayjs(dateString);                        
                    return data.format('HH:mm  DD.MM.YYYY');
                    
      }
    }
}
</script>

<style scoped>


</style>