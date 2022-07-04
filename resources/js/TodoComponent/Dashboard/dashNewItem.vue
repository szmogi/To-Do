<template>
   <div class="flex flex-col ...">
        <div class="p-4">
             <h1  class="text-center text-3xl font-semibold text-gray-600/90 ">Add new item</h1>
            <transition name="bounce">
                <h1 class="text-center text-3xl font-semibold text-green-500 " v-if="this.msg.visible">{{this.msg.text}}</h1>
            </transition>
        </div>
       <div class="grid grid-cols-2 gap-4 text-center p-4 min-h-[20rem]">           
            <div class="flex justify-center">
                 <div class="mb-3 xl:w-96">
                        <label for="category">Category</label>
                        <select @change="this.selectedCategory()" :class="this.categorySelect > 0 ? 'border-2 border-blue-600' : '' " class="form-select form-select-lg mb-3
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
                            <option selected>Select a category</option>
                            <option v-for="categors in this.categoryGroup" :key="categors.id" :value="categors.id">{{categors.name}}</option>                           
                        </select>
                  </div>
            </div>          
            <div class="flex justify-center">
                <div class="mb-3 xl:w-96">
                    <label for="birthdaytime">Date time</label>
                    <input @change="this.dateTime()" :class="this.timeDate ? 'border-2 border-blue-600' : '' " class="mb-3 appearance-none block w-full px-4 py-2 text-xl  font-normal
                        text-gray-700
                        bg-white bg-clip-padding bg-no-repeat
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="datetime-local" id="dateTime" name="dateTime">

                </div>                  
            </div>            
            <div class="flex justify-center col-span-3">
                <div class="mb-3 xl:w-96">
                    <label for="exampleFormControlTextarea1" class="form-label inline-block mb-2 text-gray-700">Task</label>
                    <textarea v-model="this.task" :class="this.task.length > 0 ? 'border-2 border-blue-600' : '' " class="form-control  block  w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding
                        border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 
                        focus:bg-white focus:border-blue-600 focus:outline-none "
                    id="exampleFormControlTextarea1"
                    rows="3"
                    placeholder="Your message"
                    ></textarea>
                </div>
            </div>
                            
       </div>           
          <div class="form-check flex flex-row justify-center p-2">
              <input @change="this.checkedPublic()" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckChecked">
              <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
                Public
              </label>
          </div>         
       <div class="text-center">
           <button @click="this.addNewItems(),this.$emit('spinner',true)" @keydown.enter="this.addNewItems(),this.$emit('spinner',true)" type="button" class="inline-block px-6 m-1 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Save</button>         
           <button @click="this.reset()" @keydown.enter="this.reset()" type="button" class="inline-block px-4 m-1 py-1.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Reset</button>
       </div>
    </div>   

</template>

<script>
import axios from 'axios'
export default {
    emits:['spinner'],
    props: {
        categoryGroup:{
           type:Array
        },
        user:{
           type:Object  
        }
    },
    data () {

        

        return {
          categorySelect:null,
          categoryName:'',
          timeDate:null,
          task:'',
          validateVisis:false,
          publicChecked:0,

          msg:{
            text:'',
            visible:false,
          },



        
        }
    },methods: {
         selectedCategory(){
            this.categorySelect = event.target.value      
               this.categoryGroup.filter(cat=>{
                  if(cat.id == this.categorySelect){
                      this.categoryName = cat.name                      
                  }
               })           
          },
         dateTime(){
          this.timeDate = event.target.value  
         },
         addNewItems(){
             if(!this.categorySelect > 0 || !this.timeDate || !this.task.length > 0){
                 this.msg.visible = true
                 this.message(true,'Checked data')
             }else{
                axios.post('/item',{userId:this.user.id,category:this.categorySelect,task:this.task,name:this.user.name,
                                   public:this.publicChecked,dateTime:this.timeDate, catName:this.categoryName}).then(res=>{
                                        this.msg.visible  = true
                                        this.message(true,'Added new item')
                                        this.$emit('spinner',false)
                                        setTimeout(()=>{
                                         window.location.href = '/dashboard-user'
                                        },300)
                                   }).catch(err=>{
                                this.message(true,'Checked data')
                              })

             }
         },
         reset(){
            if(confirm('Definitely reset')){
                location.reload();
            }
         },checkedPublic(){
           if(event.target.checked === true){
            this.publicChecked = 1
           }else{
            this.publicChecked = 0
           }           
         },message(vis,text){
               this.msg.visible = true
               this.msg.text = text
               setTimeout(()=>{ 
                this.msg.visible = false
                this.msg.text = ''
                
                },2500)

         }
    }
}
</script>

<style  scoped>


.bounce-enter-active {
  animation: bounce-in 0.5s;
}
.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1.25);
  }
  100% {
    transform: scale(1);
  }
}
</style>