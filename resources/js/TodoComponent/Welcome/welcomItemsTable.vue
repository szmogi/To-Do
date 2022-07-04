<script setup>
import NavLinkMe from '@/Components/NavLinkMe.vue';
</script>



<template>  
  <div class="flex flex-col p-4">
    <table class="table-auto text-gray-600">
            <thead class="text-xl h-12 border-b bg-gray-700 text-gray-100">
                <tr>
                <th>Sr No.</th>
                <th>Category</th>
                <th>Task</th>
                <th>Date time</th>
                <th>Done</th>
                <th>User</th>
                </tr>
            </thead>
            <tbody class="text-sm">
            <transition-group>                       
                    <tr v-for="item in this.itemsGroups.data" :key="item.id" class="cursor-pointer hover:bg-blue-200" :class="item.done === 1 ? 'border-b bg-green-200/75 border-green-300': 'border-b bg-blue-200/70 border-blue-300'">
                 
                    <td>{{item.id}}.
                        <span v-if="item.public === 1" class="text-xs text-green-600/100">public</span>
                            <nav-link-me :href="'/item-show/'+item.id" >
                                <button   type="button" class="inline-block px-2 ml-2 py-1.5 bg-green-600 text-white font-medium text-[.6rem] leading-tight rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Show</button>
                            </nav-link-me>
                    </td>

                     <td class="font-bold text-[.9rem]">{{item.category_name}}</td>

                     <td class="font-bold text-[.9rem]">                   
                         <p class="w-36 break-words">{{item.task}}</p>                
                     </td>

                      <td class="font-bold text-[.9rem]">{{this.formatDate(item.dateTime)}}</td>

                      <td class="font-bold text-[.9rem]">
                           <span v-if="item.done === 1" class="text-md text-green-600">&#10004;</span>
                           <span v-else class="text-md text-red-800">&#10006;</span>
                      </td> 

                      <th>{{item.name}}</th>
                   
                    </tr>    
             </transition-group>           
            </tbody>         
         </table>
         <div v-if="this.itemsGroups.data.length > 0" class="flex justify-center py-2">
            <nav aria-label="Page navigation example">
                <ul class="flex list-style-none">
                    <li v-for="link in this.itemsGroups.links" :key="link.id" class="page-item"><a
                        class="page-link relative block py-1.5 px-3  border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 focus:shadow-none"
                          :href="link.url" aria-label="Previous" v-html="link.label">                         
                       </a>
                    </li>                    
                 </ul>
             </nav>
          </div>
     </div>
</template>

<script>
import dayjs from 'dayjs';
export default {
    props:{
        itemsGroups: {
            type:Object,
            default:{id:0,task:'nop Item'}
        }
    },
    data () {       

        return {   
          

        }
    },mounted (){


     },methods:{
        formatDate(dateString) {
                    const data = dayjs(dateString);                        
                    return data.format('HH:mm DD.MM.YYYY');                    
      }
    } 
}
</script>

<style scoped>

tr{
    border-bottom: 0.1px solid #a2a2a393;    
}

td{
    padding: 0.5rem;
    text-align: center;
    max-width: 6rem;
}



</style>