<?php

use App\Models\Item;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Renders the home page.
Route::get('/',[ItemController::class,'index'])->name('home');



// Renders the dashboard.
Route::get('/dashboard-user', function () {   
  
   $items = Item::where('user_id',Auth::user()->id)->paginate(10);

    return Inertia::render('Dashboard',[
        'itemsShow' => true,     
        'items' => $items,
        'category' => Category::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');




// Render the create route.
Route::get('/create', function () {
    return Inertia::render('Dashboard',[        
        'created' => true,   
        'category' => Category::all()
    ]);
})->middleware(['auth', 'verified'])->name('create');



// Route for item show
Route::get('/item-show/{item}',[ItemController::class,'oneItemShow'])->name('item.show');


// Set the user route.
Route::get('user',[Controller::class,'users'])->name('user')->middleware(['auth', 'verified']);

// REST route for the category controller
Route::resource('category', CategoryController::class);


// Route for the desh category.
Route::get('/desh-category/{id}', [CategoryController::class, 'deshCategory'])->name('deshCategory')->middleware(['auth', 'verified']);


// Route for the desh public.
Route::get('/desh-publis', [Controller::class, 'dashPublic'])->name('dashPublic')->middleware(['auth', 'verified']);


// Route for desh - done authentication.
Route::get('/desh-done', [Controller::class, 'dashDone'])->name('dashDone')->middleware(['auth', 'verified']);


// Get route for done
Route::get('done',[Controller::class,'welcomeDone'])->name('done');

// REST route for Item
Route::resource('item', ItemController::class)->middleware(['auth', 'verified']);


// Delete all items.
Route::post('destroy-items',[ItemController::class,'destroyAll'])->name('destroyAll')->middleware(['auth', 'verified']);


// Define the restore routes.
Route::get('/restore/', [ItemController::class,'restoreItem'])->name('items.store')->middleware(['auth', 'verified']);
Route::post('/restore/{item}', [ItemController::class,'restore'])->name('items.restore')->middleware(['auth', 'verified']);
Route::delete('/force-delete/{item}',[ItemController::class,'forceRestore'])->name('items.force-delete')->middleware(['auth', 'verified']);
Route::get('/restore-all/', [ItemController::class,'restoreAll'])->name('items.restore-all')->middleware(['auth', 'verified']);



require __DIR__.'/auth.php';
