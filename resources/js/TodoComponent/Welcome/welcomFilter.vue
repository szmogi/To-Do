<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>






<template>
        <div class="flex flex-wrap justify-around items-end">
         
                    <div v-for="categors in this.category" :key="categors.id" class="flex flex-row items-center" >              
                      <Link  :href="'/category/'+categors.id" >                     
                         <h3 class="px-2 text-sm font-semibold" for="home">{{categors.name}}</h3>
                      </Link>
                    </div>
               
                     <div class="flex flex-row items-center" >                       
                        <Link :href="'/done'" >                     
                          <h3 class="px-2 text-sm font-semibold" for="home">Done</h3>
                       </Link>
                    </div>
                     <div class="flex flex-row items-center" >
                       <Link :href="'/'" >                     
                          <h3 class="px-2 text-sm font-semibold" for="home">All</h3>
                       </Link>
                    </div>
                    
           </div>
         
</template>

<script>
export default {   
    props: {
      category:{
         type:Object,Array
      }
    },
    data () {
        

        return {          
          
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
