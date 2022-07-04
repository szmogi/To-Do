<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import welcomeMain from '@/TodoComponent/Welcome/welcomMain.vue';
import NavLinkMe from '@/Components/NavLinkMe.vue';


defineProps({
    oneItem:Boolean,
    items:Object,Array,
    category:Object,Array,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,

    
})


</script>

<template>
    <Head title="Welcome" />
      <div class="container mx-auto m-10 w-[70rem] bg-[#f3f4f6] h-[50rem] shadow-2xl rounded-md overflow-hidden">
        <div class="min-h-42 bg-gray-100"> 
           <nav class="bg-white border-b border-gray-100">
              <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 p-2 border-b-4 border-gray-500/50">
                 <div  class="flex justify-between h-16 ">                
                   <div class="flex">
                           <div class="hidden space-x-8 sm:-my-px sm:ml-10  sm:flex">
                                <nav-link-me :href="route('dashboard')" class="text-5xl text-zinc-800/80 font-bold inline-flex items-center px-1 pt-1 border-b-2 border-gray-400 leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out"  :active="route().current('dashboard')">
                                    To do
                                </nav-link-me>
                             </div>                    
                      </div>
                      <div class="w-48 items-center flex justify-between">
                        <div v-if="canLogin" >
                                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-xl no-underline hover:text-gray-800   text-gray-700 ">
                                    <h3 class="text-xl text-gray-500 font-semibold">{{$page.props.auth.user.name}}</h3> 
                                </Link>

                                <template v-else>
                                    <Link :href="route('login')" class="text-xl m-[0.5rem] no-underline  text-gray-700  hover:text-gray-800 ">
                                        <h3>Log in</h3> 
                                    </Link>

                                    <Link v-if="canRegister" :href="route('register')" class="text-xl m-[0.5rem] no-underline text-gray-700  hover:text-gray-800 ">
                                        <h3>Register</h3> 
                                    </Link>
                                </template>
                            </div>
                       </div>
                  </div> 
               </div>            
             </nav> 
          </div>
          <welcome-main
           :category="this.category"
           :canLogin="this.canLogin"
           :items="this.items"
           :one-item="this.oneItem">


          </welcome-main>


    </div>


    
      
</template>

<script>
export default {
    data () {        
        
        return {        
            
        }
    },mounted(){    
        
    }
}
</script>


<style scoped>

h3 { 
  display:inline-block;
  margin:0; 
 }
h3:after {
  display:block;
  content: '';
  border-bottom: solid 2px #a2a2a3;  
  transform: scaleX(0);  
  transition: transform 400ms ease-in-out;
}
h3:hover:after {
 transform: scaleX(1);
}

 
</style>
