<script setup>
import NavLinkMe from '@/Components/NavLinkMe.vue';
</script>


<template>    
    <transition name="slide-down">
        <div  v-if="this.editVisible" id="editItem" class="flex flex-col border-b-4 border-gray-400">  
            <div  class="flex flex-wrap justify-around items-center p-1">         
                <div class="mb-3 xl:w-64">
                        <label for="category">Category</label>
                        <select @change="this.editing('category')" class="form-select form-select-lg mb-3
                        appearance-none
                        block
                        w-full
                        px-4
                        py-2
                        text-xl
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label=".form-select-lg example">
                            <option selected>{{this.editArray.category_name}}</option>   
                            <option v-for="categors in this.categoryGroup" :key="categors.id" :value="categors.id" >{{categors.name}}</option>                                                    
                        </select>                 
                  </div>          
               
                  <div class="mb-3 xl:w-72">
                    <label for="birthdaytime">Date time</label>
                    <input @change="this.editing('dateTime')"  class="mb-3 appearance-none block w-full px-4 py-2 text-xl  font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="datetime-local" id="dateTime" name="dateTime" :value="this.editArray.dateTime">

                  </div>           
                <div>
                  <div class="mb-3 xl:w-96">
                    <label for="exampleFormControlTextarea1" class="form-label inline-block  text-gray-700">Task</label>
                    <textarea v-model="this.editArray.task" class="form-control  block  w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                        border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 
                        focus:bg-white focus:border-blue-600 focus:outline-none "
                    id="exampleFormControlTextarea1"
                    rows="3" 
                    >fasdada</textarea>
                  </div>
                </div>
              </div>   
                <div class="flex flex-row justify-center items-center">  
                   <button @click="this.saveEdit('all',this.editArray.id,this.editArray),this.$emit('spinner',true)" 
                   @keydown.enter="this.saveEdit('all',this.editArray.id,this.editArray),this.$emit('spinner',true)"
                    type="button" class="inline-block px-4 py-1.5 my-2 bg-green-500 text-white text-xl font-medium  leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Save</button>  
                   <img  @click="this.editVisible = false" @keypress.enter="this.editVisible = false" class="cursor-pointer mx-2" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABwklEQVRIibXWyWpUQRQG4C/tkIWtydJOp0FBadGVmOQhzKBB0J1rIfElVAy+gfOwUEkvFBvd+hwiqOCIZpdsNMFhUaehvbndt2mvPxR1q+o//6npnLoj+qOBU5jFgWjDB7zDCzzDxwKdbajjFr7hTjhpYk+UJk7jbnBuYmJQ8QV8xRXsG4A/hqthM19Evoj3ODHobLowFbbLvQgLQZgcQryDydDYtpK6tMRhZp7FdGjVujtv43IJ4h2s4Ean0ZBuwliJDsaxhvoOnMc6WgVGu7CKs9Ld/9mH+x1HsbeCk2gPIN7Cziir2F1g0w5tr3GoQPwpnmM02k+kKB7tY9fEK9hAdUDxbH8/J1VsVPC7j3gr6jP40TW2JZ3FZqwmz0kFvyr4Ij+PPIp6MSPe7eRc1A9zxmv4XMEb6cSzaMcst3LGOtgMTt4lORbalqSsWDYe4AIpf/zXQFvHYRzHy5IcXJK253GnY0JKUFMliM+E1v7swLx/T9cN6Tmd7UVYDifTQ4jPhPhSEXFOWuKKdFhFGMe1sOk58yxqUj5fwz0p2I5I4V+N70XcD851OXsOIwWO6tJTOoeD/v5teSvlojY+9RL4AzVaX+kU2htgAAAAAElFTkSuQmCC">                  
                </div>   
          </div>              
     </transition >   

    <div class="flex flex-col h-[41.3rem] scrollStyle overflow-y-auto">      
        <div v-if="this.refresh" class="flex flex-row justify-center m-2">
            <table class="table-auto w-[65rem] text-gray-600">
                <thead class="text-xl h-12 border-b bg-gray-700 text-gray-100 border-gray-700">
                    <tr>
                    <th>Sr No.</th>
                    <th>Category</th>
                    <th>Task</th>
                    <th>Date time</th>
                    <th>Options</th>
                    <th>Public</th>
                    <th>Done</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-center ">
                <transition-group>          
                     <tr v-for="item in this.itemsGroup.data" :key="item.id" class="hover:bg-blue-200 cursor-pointer   " :class="item.done === 1 ? 'border-b bg-green-200/75 border-green-300': 'border-b bg-blue-200/70 border-blue-300'">
                          <td class="p-4">{{item.id}}
                           <nav-link-me :href="'/item-show/'+item.id" >
                                <button   type="button" class="inline-block px-2 ml-2 py-1.5 bg-green-600 text-white font-medium text-[.6rem] leading-tight rounded-full shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Show</button>
                            </nav-link-me>
                          
                          </td>
                           <td class="p-2 text-sm">{{item.category_name}}</td>
                        <td>
                           <div class="w-48 break-words">{{item.task}}</div>                    
                                         
                        </td>                        
                           <td class="p-2">{{item.dateTime}}</td>
                        <td class="p-2 ">  

                            <button @click="this.showEdit(item.id), this.editVisible = true"
                                    @keydown="this.showEdit(item.id),this.editVisible = !this.editVisible" 
                                   type="button" class="inline-block px-4 py-1 m-0.5 bg-green-500 text-white text-[.8rem]  font-medium text-xs leading-tight  rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Edit</button>                                                                                                 
                            <button @click="this.deleteItem(item.id),this.$emit('spinner',true)" 
                                   type="button" class="inline-block px-2 py-1 m-0.5 bg-red-600 text-white font-medium text-[.8rem] leading-tight  rounded-full shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Delet</button>

                            <input class="ml-2 w-3 h-3 p-1"  type="checkbox" :id="item.name" :value="item.id" v-model="checkedId">
                        </td>       
                        <td class="w-36">  

                            <span v-if="item.public === 1" class="text-md text-green-600">&#10004;</span>
                            <span v-else class="text-md text-red-800">&#10006;</span>
                            <button @click="this.saveEdit('public',item.id,0),this.$emit('spinner',true)" @keydown="this.saveEdit('public',item.id,0),this.$emit('spinner',true)" v-if="item.public === 1"  type="button" class="inline-block px-4 py-1 m-0.5 text-[.8rem] mx-2  bg-blue-600 text-white font-medium text-xs leading-tight  rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">Not public</button>
                            <button @click="this.saveEdit('public',item.id,1),this.$emit('spinner',true)" @keydown="this.saveEdit('public',item.id,1),this.$emit('spinner',true)" v-else type="button" class="inline-block px-4 py-1 m-0.5 text-[.8rem] mx-2  bg-blue-600 text-white font-medium text-xs leading-tight  rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">Public</button>                  
                         
                        </td>
                        <td>            

                            <span v-if="item.done === 1" class="text-md text-green-600">&#10004;</span>
                            <span v-else class="text-md text-red-800">&#10006;</span>
                            <button  v-if="item.done === 0"  @click="this.saveEdit('done',item.id,1),this.$emit('spinner',true)" @keydown="this.saveEdit('done',item.id,1),this.$emit('spinner',true)" type="button" class="inline-block px-4 mx-2 py-1 bg-blue-600 text-white font-medium text-[.8rem] leading-tight  rounded-full shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">done</button>
                    
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
   emits:['delItems','spinner'],
    props: {
        itemsGroup:{
            type:Object            
        },
        categoryGroup:{
            type:Array
        },
        user:{
           type:Object  
        }
 
    },
    data () {       

        return {
          item:this.itemsGroup,
          refresh:true,

          checkedId:[],
 
          editVisible:false,
          editArray:[],
       

        }

    },watch:{
      checkedId(newVal){
        if(newVal.length > 0){
          this.$emit('delItems',{status:true,data:this.checkedId})
        }else{
          this.$emit('delItems',{status:false,data:newVal})
        }
      }
    }
    ,mounted(){     
 
     
    },methods:{
      formatDate(dateString) {
                    const data = dayjs(dateString);                        
                    return data.format('HH:mm  DD.MM.YYYY');                    
     
     },showEdit(data){                      
            this.itemsGroup['data'].filter(item =>{
                if(item.id == data){
                    this.editArray = item                               
                }
                
            }) 
     },editing(type){
          if(type === 'category'){                
            this.categoryGroup.filter(cat=>{
                if(cat.id === Number(event.target.value)){
                    this.editArray.category_id = event.target.value  
                    this.editArray.category_name = cat.name          
                    
                  }
               })     
            }

            if(type === 'dateTime'){
            this.editArray.dateTime = event.target.value  
            }

    
     },saveEdit(type,id,edit){        
        axios.put('/item/'+id,{type:type,data:edit}).then(res=>{        
           if(type == 'all') {
            this.itemsGroup.data.forEach(function(item){if(item.id == id){item = edit}})  
           }else if(type == 'public'){
             this.itemsGroup.data.forEach(function(item){if(item.id == id){item.public = edit}})  
           }else if(type == 'done'){
             this.itemsGroup.data.forEach(function(item){if(item.id == id){item.done = edit}})  
           }          


           this.editVisible = false
           this.$emit('spinner',false)
         }).catch(err=>{         
        location.reload(false)
        })


     },deleteItem(id){   
        if(confirm('Definitely delete')){
           axios.delete('/item/'+Number(id)).then(res=>{              
               this.$emit('spinner',false)
               location.reload(false)
           }).catch(err=>{
            location.reload(false)
          })
       }
         
     }
  }
}
</script>



<style scoped>



.slide-down-enter-active {
  transition: all 0.3s ease-out;
}

.slide-down-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-down-enter-from,
.slide-down-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}



.slide-opacity-enter-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-opacity-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-opacity-enter-from,
.slide-opacity-leave-to {  
    transform: translateY(-20px);
  opacity: 0;
}


</style>