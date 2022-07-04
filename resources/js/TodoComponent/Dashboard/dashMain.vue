<script setup>
import DashNav from '@/TodoComponent/Dashboard/dashNav.vue';
import DashItems from '@/TodoComponent/Dashboard/dashItemsTable.vue';
import DashNewItem from '@/TodoComponent/Dashboard/dashNewItem.vue';
import DashArchive from '@/TodoComponent/Dashboard/dashRestore.vue';
</script>





<template>
        <div class="flex flex-col">               

                <div class="flex flex-wrap justify-evenly text-center p-4 border-b-4 border-gray-500/50">                           
                                                 
                                 <dash-nav
                                 :user="this.user"
                                 :categoryGroup="this.categoryGroup"
                                  @spinner="this.spinnerVisible($event)"
                                  @deleteMore="this.refresItems($event)"
                                 :delItems="this.delItems"  
                                 :restoreAllVisible="this.visibleRestoreAll"
                                 :archive="this.archive">
                               
                                </dash-nav>

                     <transition>              
                          <div v-show="this.spinner">
                               <img class="w-10 h-10" src="/storage/icons/spinner.gif" alt="spinner" >
                          </div>      
                     </transition>        

                   </div>                  
                
            <transition>         
                  <div v-if="this.itemsVisisble">

                     <dash-items
                     @spinner="this.spinnerVisible($event)"
                     :itemsGroup="this.itemsGroup"  
                     :categoryGroup="this.categoryGroup" 
                     :user="this.user"  
                     @del-items="this.showDellItems($event)"
                                 
                     >
                           
                     </dash-items>

                  </div>

                  
           </transition>


          <transition>   
                  <div v-if="this.createdVisisble">
                       <dash-new-item
                       :categoryGroup="this.categoryGroup"
                       :user="this.user"
                       @spinner="this.spinnerVisible($event)"
                       
                       
                       >

                       </dash-new-item>                 

                  </div>
          </transition> 


          <transition>   
                  <div v-if="this.archiveVisible">
                       <dash-archive
                       :itemsGroup="this.itemsGroup.Item"  
                       :categoryGroup="this.categoryGroup"
                       :user="this.user"
                       >

                       </dash-archive>                 

                  </div>
          </transition> 


         
                
                

              
              
        </div>
</template>

<script>
export default {
    props: {
      user:{
        type: Object,       
      },
      itemsGroup:{
         type: Object,Array
      },
      categoryGroup:{
         type: Array
      },
      created:{
         type:Boolean,
         default:false
      },
      archive:{
         type:Boolean,
         default:false,
      },
      itemsShow:{
         type:Boolean,
         default:false,
      },
      
    },
    data () {       

        return {      
        itemsVisisble:this.itemsShow,
        createdVisisble:this.created,
        archiveVisible:this.archive,
         


        delItems:[],
        visibleRestoreAll:false,


        spinner:false,
        
        }
   },created(){      
       this.ifRestoreAll()
   
    },methods:{   
        showDellItems(data){        
         this.delItems = data         
        },refresItems(data){       
           this.itemsShow.filter(item=>{
              data.forEach(function(del){
                 if(item.id == del){
                    this.itemsShow.splice(item.id,1)                   
                 }
              })
           })
        
        },ifRestoreAll(){
           if(this.archive === true){
               if(this.itemsGroup.Item.data.length > 0)
               this.visibleRestoreAll = true
            } 
        },spinnerVisible(data){
           if(data == true){
            this.spinner = data
           }else{
            this.spinner = data
           }
        }
     }  
}
</script>

<style  scoped>



</style>