<script setup>
import itemTable from '@/TodoComponent/Welcome/welcomItemsTable.vue';
import itemFilter from '@/TodoComponent/Welcome/welcomFilter.vue'
import UserList from '@/TodoComponent/Welcome/welcomUserList.vue'
import OneItem from '@/TodoComponent/Welcome/welcomOneItem.vue'
</script>



<template>      
        <div class="flex flex-wrap ">           
            
            <div :class="this.userVisible == true ? 'w-[50rem]' : 'min-w-full'"
             class="scrollStyle h-[45rem] overflow-y-auto   ">

              <div class="text-end py-0.5 px-2">
                 <h3 @click="this.userVisible = !this.userVisible" class="cursor-pointer text-[.9rem]  text-gray-700/80 " >User list</h3>
              </div>
               
              
               <h1 class="text-4xl font-semibold text-gray-700/80 text-center p-1">Public items</h1>

               <item-filter
               v-if="this.oneItem === false"
               :category="this.category"
                >

               </item-filter>
               
               
               <item-table   
                v-if="this.oneItem === false"          
               :itemsGroups="this.itemsGroups">

               </item-table>

               <one-item
               v-if="this.oneItem === true" 
               :oneItem="this.items"
               
               >

               </one-item>

               
                
            
            
            </div>

           <transition name="slide-fade">                 
              <div v-if="this.userVisible" class="w-[20rem] border-l-4 border-gray-500/50">
                <h1 class="text-2xl font-semibold text-gray-700/80 text-center py-4">User list</h1>
                
                <user-list>    

                </user-list>                

              </div>
            </transition>  

           
        </div>  
</template>

<script>
export default {  
    props: {
      oneItem:{
        type:Boolean,        
        default:false
      },
      items:{
        type:Object,Array
      },
      category:{
        type:Object,Array,
      }
     
    },
    data () {
        

        return {
           itemsGroups:this.items,     
           userVisible:false   
        }
    },watch:{
   
    },mounted(){       
                 
    },methods:{     
 
    }
}
</script>

<style  scoped>


</style>