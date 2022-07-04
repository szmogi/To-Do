<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import dashMain from '@/TodoComponent/Dashboard/dashMain.vue'




defineProps({
    items:Object,Array, 
    category:Array,
 
    created:{
        type:Boolean,
        default:false,
    },
    itemsShow:{
        type:Boolean,
        default:false,
    },
    archive:{
        type:Boolean,
        default:false,
    } 


    
})


</script>

<template>
    <Head title="Dashboard" />   

        
     
        <div class="container mx-auto m-10 w-[70rem] bg-[#f3f4f6] h-[50rem] shadow-2xl rounded-md overflow-hidden">

            <BreezeAuthenticatedLayout>                     


            </BreezeAuthenticatedLayout>


            <dash-main
            :archive="this.archive"
            :itemsShow="this.itemsShow"
            :created="this.created"
            :itemsGroup="this.items"
            :categoryGroup="this.category"
            :user="$page.props.auth.user">
                
            </dash-main>
          
        </div>

     
</template>

<script>
export default {
    data () {        

        return {}
    },mounted(){
        
    }
}
</script>

<style lang="scss" scoped>

</style>