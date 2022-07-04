
<template>    
     <div class="flex flex-col">
        <div class="flex flex-row justify-center m-2">
            <table class="table-auto w-[60rem] text-gray-600">
                <thead class="text-xl h-12 border-b bg-gray-700 text-gray-100">
                    <tr>
                    <th>Deletion time</th>
                    <th>Category</th>
                    <th>Task</th>
                    <th>Date time</th>
                    <th>Options</th>
                    <th>Public</th>
                    <th>Done</th>
                    </tr>
                </thead>
                <tbody v-if="this.itemsGroup.data.length > 0" class="text-sm text-center ">
                <transition-group name="slide-opacity">          
                        <tr v-for="item in this.itemsGroup.data" :key="item.id" class="hover:bg-gray-200/100 cursor-pointer border-b  border-gray-500/50 ">
                        <td class="p-4 text-[.8rem]">{{this.formatDate(item.deleted_at)}}</td>
                        <td class="p-2">{{item.category_name}}</td>
                        <td>
                            <div class="w-48 break-words">{{item.task}}</div>                    
                                         
                        </td>                        
                        <td class="p-4 text-[.8rem]">{{this.formatDate(item.dateTime)}}</td>
                        <td class="p-2">                            
                           <button @click="this.restore(item.id)" @keydown.enter="this.restore(item.id)" type="button" class="inline-block px-4 py-1.5 m-0.5 bg-green-600 text-white text-[.8rem]  font-medium text-xs leading-tight  rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Restore</button>                                                                                                
                           <button @click="this.forceDelete(item.id)" @keydown.enter="this.forceDelete(item.id)" type="button" class="inline-block px-2 py-1 m-0.5 bg-red-600 text-white font-medium text-[.7rem] leading-tight  rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete</button>
                        </td>       
                        <td>
                            <span v-if="item.public === 1" class="text-md text-green-600">&#10004;</span>
                            <span v-else class="text-md text-red-800">&#10006;</span>      
                        </td>
                        <td>                            
                             <span v-if="item.done === 1" class="text-md text-green-600">&#10004;</span>
                            <span v-else class="text-md text-red-800">&#10006;</span>                  
                        </td>                         
                        
                        </tr>    
                </transition-group>           
               </tbody>         
            </table>
        </div>   
        
         <div class="flex justify-center py-2">
            <nav aria-label="Page navigation example">
                <ul class="flex list-style-none">
                    <li v-for="link in this.itemsGroup.links" :key="link.id" class="page-item"><a
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
import axios from 'axios';
export default {
    props: {
        itemsGroup:{
            type:Object,            
        },
        categoryGroup:{
            type:Array
        },
 
    },
    data () {       

        return {
          item:this.itemsGroup.data,           

        }

    },mounted(){            
    
    },methods:{
        formatDate(dateString) {
                    const data = dayjs(dateString);                        
                    return data.format('HH:mm  DD.MM.YYYY');                   
    
    },restore(id){
        axios.post('/restore/'+id).then(res=>{
             location.reload(false);         
            }).catch(err=>{
            location.reload(false);
         })
      },forceDelete(id){
         axios.delete('/force-delete/'+id).then(res=>{
              location.reload(false);       
            }).catch(err=>{
           location.reload(false);
       })
    },
   
  }
}
</script>



<style scoped>



.slide-opacity-enter-active {
  transition: all 0.3s ease-out;
}

.slide-opacity-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-opacity-enter-from,
.slide-opacity-leave-to {  
  opacity: 0;
}


</style>