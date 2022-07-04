<?php

namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   

    // Get all users.
    public function users(){

        return User::all();
        
    }  


    public function welcomeDone(){
         
        $items = Item::where('public',1)->where('done',1)->paginate(10);      

        return Inertia::render('Welcome', [       
            'items' => $items,      
            'category' =>Category::all(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);

    }



    public function dashDone(){
        
        $items = Item::where('user_id',Auth::user()->id)->where('done',1)->paginate(10);    

        return Inertia::render('Dashboard',[
            'itemsShow' => true,     
            'items' => $items,
            'category' => Category::all()
        ]);
          
    }


    public function dashPublic(){
            
        $items = Item::where('user_id',Auth::user()->id)->where('public',1)->paginate(10);    

        return Inertia::render('Dashboard',[
            'itemsShow' => true,     
            'items' => $items,
            'category' => Category::all()
        ]);
    }






}
