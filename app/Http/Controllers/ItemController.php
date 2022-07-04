<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Mail\NotificationDone;


use App\Mail\NotificationMail;
use App\Mail\NotificationPublish;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('public',1)->paginate(10);    

        return Inertia::render('Welcome', [       
            'items' => $items,      
            'category' =>Category::all(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    
    }


    public function oneItemShow ($id){

        $items = Item::find($id);           
      

        return Inertia::render('Welcome',[        
            'items' => $items, 
            'oneItem' => true,
            'category' =>Category::all(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            
         ]);       

    }


  
    public function restoreItem(){
      
        $Item = Item::where('user_id',Auth::user()->id)->latest();
        
        $Item = $Item->onlyTrashed();      
    
        $Item = $Item->paginate(10);           
        

        

        return Inertia::render('Dashboard',[        
                'archive' => true, 
                 'items' => compact('Item'),
                'category' => Category::all()
         ]);     
      
         

       
    }


    public function restore($id) 
    {
        Item::where('id',$id)->withTrashed()->restore();

        return 'Restore';
    }



    public function forceRestore($id) 
    {
        Item::where('id', $id)->withTrashed()->forceDelete();

        return 'Force deleted';
    }


    public function restoreAll() 
    {

        $Item = Item::where('user_id',Auth::user()->id)->latest();

        $Item->onlyTrashed()->restore();

        return redirect()->route('dashboard')->with('message','Data successfully restore all');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validation = $request->validate([            
            'category' => 'required',
            'dateTime' => 'required', 
            'task' => 'required',   
            'userId' => 'required',       
            'catName' => 'required',
            
        ]);            



        $item = new Item;
        $item->user_id = $request->userId;
        $item->category_id = $request->category;
        $item->category_name = $request->catName;
        $item->task = $request->task;
        $item->name = $request->name;
        $item->public = $request->public;
        $item->done = 0;
        $item->dateTime = $request->dateTime;        
        $item->save();     


        $data = array(
            'name' => Auth::user()->name,            
            'mail' => Auth::user()->mail,
            'title' => 'Add new item',
            'category' => $request->catName,
            'task' => $request->task,
            'public' => $request->public === 1 ? 'Yes':'No',
            'dateTime' => $request->dateTime, 
            'link' => '/dashboard'          
          );

          Mail::to($request->mail)->send(new NotificationMail ($data));  

       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Item::where('user_id',$id)->paginate(10);

        return $items ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)    
    {
     
               
       if($request->type == 'all'){
            $dataItem = (Object) $request->data;
            $validation = $request->validate([            
                'data' => 'required'
              ]);    

            Item::find($item);
            $item->user_id = $dataItem->user_id;
            $item->category_id = $dataItem->category_id;
            $item->category_name = $dataItem->category_name;
            $item->task = $dataItem->task;
            $item->name = $dataItem->name;
            $item->public = $dataItem->public;
            $item->done = $dataItem->done;
            $item->dateTime = $dataItem->dateTime;        
            $item->save();         


            $data = array(
                'name' => Auth::user()->name,                 
                'title' => 'Change item!',
                'category' => $dataItem->category_name,
                'task' => $dataItem->task,
                'public' => $dataItem->public === 1 ? 'Yes':'No',
                'dateTime' => $dataItem->dateTime,     
                'link' => '/item-show/'.$item->id           
              );
    
              Mail::to(Auth::user()->mail)->send(new NotificationMail ($data));  
    
           
           
         }else if($request->type == 'public'){
            Item::find($item);
            $item->public = $request->data;
            $item->save();  

            $data = array(
                'name' => Auth::user()->name,                 
                'title' => 'Change Public!',                
                'public' => $request->data === 1 ? 'Yes':'No',                   
                'link' => '/item-show/'.$item->id           
              );
    
              Mail::to(Auth::user()->mail)->send(new NotificationPublish ($data));  
    
           




         }else if($request->type == 'done'){
            Item::find($item);
            $item->done = $request->data;
            $item->save();

            $data = array(
                'name' => Auth::user()->name,                 
                'title' => $request->data === 1 ? 'Item done!!!':'nop',                              
                'link' => '/item-show/'.$item->id           
              );
    
            Mail::to(Auth::user()->mail)->send(new  NotificationDone ($data));  
         }





        
    }

    /**
     * Remove the specified resource from storage.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
      $item->delete();     
    }

    /**
     * Remove the specified resource from storage.
     *
     
     * @param  \Illuminate\Http\Request  $request
     */
    public function destroyAll(Request $request)
    {
         
        if(is_array($request->delete)){
            foreach ($request->delete as $item){              
              Item::find($item)->delete();            
            }
        }
    }
}
