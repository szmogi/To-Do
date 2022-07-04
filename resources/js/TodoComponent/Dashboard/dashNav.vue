<script setup>
import NavLinkMe from '@/Components/NavLinkMe.vue';

</script>





<template>
        <div class="flex flex-wrap justify-around items-end w-[20rem]">
             <nav>
                <ul>
                    <li @mouseenter="this.categoryVisible = true" @mouseleave="this.categoryVisible = false" class="w-[5rem] text-[.8rem]">
                        <h1 @click="this.categoryVisible = !this.categoryVisible" class="text-xl cursor-pointer hover:text-gray-500" rel="noopener noreferrer">Category</h1>
                      <transition>                     
                          <div v-if="this.categoryVisible" class="flex flex-col z-10 absolute bg-slate-300/100 py-2 px-2 rounded-md">
                            <nav-link-me v-for="category in this.categoryGroup" :key="category.id" class="mx-1" :href="'/desh-category/'+category.id">
                                 <h1 class="px-4 m-1 py-0.5 text-[1rem] hover:border-b cursor-pointer border-gray-800 ">{{category.name}}</h1>
                            </nav-link-me>                                                   
                           </div>     
                       </transition>                             
                    </li>
                 </ul>
             </nav>    
                    
             <nav>
                <ul>                          
                    <li @mouseenter="this.statusVisible = true" @mouseleave="this.statusVisible = false" class=" w-[5rem] text-[.8rem] text-md">
                        <a @click="this.statusVisible = !this.statusVisible" class="text-xl cursor-pointer  hover:text-gray-500" rel="noopener noreferrer">Status</a>  
                       <transition>                         
                             <div v-if="this.statusVisible" class="flex flex-col z-10  absolute bg-slate-300/100 py-2 px-2 rounded-md">  
                                   <nav-link-me class="mx-1" :href="'/desh-publis'">
                                        <h1 class="px-4 m-1 py-0.5 text-[1rem]  hover:border-b cursor-pointer border-gray-800 ">Publish</h1>
                                   </nav-link-me>
                                
                                   <nav-link-me class="mx-1" :href="'/desh-done'">
                                        <h1 class="px-4 m-1 py-0.5 text-[1rem]  hover:border-b cursor-pointer border-gray-800 ">Done</h1>
                                  </nav-link-me>                                    
                             </div>   
                       </transition>                                 
                    </li>
                 </ul>
            </nav>   
                           
        </div>
         <div class="min-w-[25rem]">

                <nav-link-me class="mx-1" :href="route('home')">
                    <button  type="button" class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Home</button>
                </nav-link-me>

                
                <nav-link-me class="mx-1" :href="route('dashboard')">
                    <button  type="button" class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Items</button>
                </nav-link-me>  

                <nav-link-me class="mx-1" :href="route('create')">
                    <button  type="button" class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Add item</button>
                </nav-link-me>       

                <nav-link-me class="mx-1" :href="route('items.store')">
                    <button  type="button" class="inline-block px-4 py-1.5 bg-gray-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg transition duration-150 ease-in-out">Restore deleted</button>
                </nav-link-me>
                
               
                    <nav-link-me v-if="this.archive && this.restoreAllVisible"  class="mx-1" :href="route('items.restore-all')">
                        <button   type="button" class="inline-block px-4 py-1.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Restore all</button>
                    </nav-link-me>
             

               <transition>     
                   <button @click="this.deleteIItems(),this.$emit('spinner',true)"  @keydown.enter="this.deleteIItems(),this.$emit('spinner',true)"   v-if="this.delItems.status"  type="button" class="inline-block px-4 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delete all</button>
              </transition>    
       </div> 
        
</template>

<script>
export default {  
    emits:['deleteMore','spinner'],
    props: {
       archive: {
          type:Boolean,
          default:false,
       },
       delItems:{
         type:Object,
         default:false
       },
       restoreAllVisible:{
          type:Boolean,
        
       },
       user:{
        type:Object
       },
       categoryGroup:{
        type:Array,
       }
    },
    data () {
        

        return {
            statusVisible:false,
            categoryVisible:false,

        }
    },watch:{
       
    },methods:{
       deleteIItems(){
         if(confirm('Definitely delete')){
          axios.post('destroy-items',{delete:this.delItems.data}).then(res=>{
                 this.$emit('deleteMore',this.deleteItems.data )      
                 this.$emit('spinner',false)         
            }).catch(err=>{
               location.reload()
            })
         }else{return}
       
       }
    }
}
</script>

<style scoped>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}




</style>
