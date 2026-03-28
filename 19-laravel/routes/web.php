<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\petController;
use App\Http\Controllers\AdoptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'users' => UserController::class,
        'pets' => PetController::class,
        'adoptions' => AdoptionController::class,
    ]);
    //Exports PDF
    Route::get('export/users/pdf', [UserController::class, 'pdf']);

    // Exports Excel
    Route::get('export/users/excel', [UserController::class, 'excel']);

    // Import Excel
    Route::post('import/users', [UserController::class, 'import']);
    
    // Search Users
    Route::post('search/users', [UserController::class, 'search']);
});



require __DIR__.'/auth.php';
Route::get('hello', function () {
    return "<h1>Hello Laravel 🚀</h1>";
});

Route::get('sayhello/{name}', function () {
    return "<h1>Hello: ".request()->name."</h1>";
});

Route::get('getall/pets', function(){
    $pets = App\Models\Pet::all();
    dd($pets->toArray()); 
});

Route::get('show/pet/{id}', function(){
    $pet = App\Models\Pet::find(request()->id);
    dd($pet->toArray()); 
});
Route::get('challenge', function () {
    // Crear carpeta images si no existe
    if (!file_exists(public_path('images'))) {
        mkdir(public_path('images'), 0777, true);
    }
    
    // Verificar si hay usuarios
    if (User::count() < 20) {
        User::factory()->count(20)->create();
    }
    
    $users = User::take(20)->get();

    foreach ($users as $user) {
        $imagePath = public_path('images/' . $user->photo);
        if (!file_exists($imagePath)) {
            try {
                $gender = ($user->gender == 'Male') ? 'men' : 'women';
                $url = "https://randomuser.me/api/portraits/{$gender}/" . rand(1,99) . ".jpg";
                file_put_contents($imagePath, file_get_contents($url));
            } catch (\Exception $e) {
            }
        }
    }
    

    // Tabla sin estilos (lo más simple posible). Solo la fila superior en rojo.
    $output = "<h2>Usuarios Challenge</h2>";
    $output .= "<table>";
    $output .= "<tr bgcolor='#d9534f'>";
    $output .= "<th><font color='#ffffff'>Photo</font></th>";
    $output .= "<th><font color='#ffffff'>Fullname</font></th>";
    $output .= "<th><font color='#ffffff'>Age</font></th>";
    $output .= "<th><font color='#ffffff'>Created At</font></th>";
    $output .= "</tr>";
    
    foreach ($users as $user) {
        $age = Carbon::parse($user->birthdate)->age;
        
        $output .= "<tr>";
        $output .= "<td align='center'>";
        if (file_exists(public_path('images/' . $user->photo))) {
            $output .= "<img src='" . asset('images/' . $user->photo) . "' width='52' height='52' alt='photo'>";
        } else {
            $output .= "🖼️";
        }
        $output .= "</td>";
        $output .= "<td>" . $user->fullname . "</td>";
        $output .= "<td>" . $age . " Years old</td>";
        $output .= "<td>" . $user->created_at . "</td>";
        $output .= "</tr>";
    }
    
    $output .= "</table>";
    
    return $output;
});

Route::get('getall/pets', function(){
    $pets = App\Models\Pet::all();
    return view('getallpets')->with('pets', $pets);
});