<template>
    <div>
        <nav>
            <ul v-if="this.users.length > 0" role="list" class="p-2 divide-y divide-slate-200">                         
                <li v-for="user in this.users" :key="user.id" class="flex cursor-pointer py-2 justify-center first:pt-0 last:pb-0">
                   <img class="h-11 w-13 rounded-full" src="" alt="" onerror="this.onerror=null;this.src='/storage/img/profil.png'" />
                     <div class="ml-4 overflow-hidden w-48">
                         <p class="text-sm font-semibold text-slate-900">{{user.name}}</p>
                         <p class="text-sm text-slate-500 truncate">{{user.email}}</p>
                    </div>
                </li>          
            </ul>
            <ul v-else class="text-center" >
                <li>
                    <h1 class="text-xl font-extrabold">Empty</h1>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script>
export default {
    data () {        

        return {
            users: [],

        }
    },mounted () {
        this.usersAxios()
    },methods:{
        usersAxios(){
            axios.get('/user').then(res=>{
               this.users = res.data
            }).catch(err=>{
               this.users ={id:1, name:'empty'}
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>