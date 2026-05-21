<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Pet;
use Carbon\Carbon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================
// RUTAS DE PERFIL (AUTH)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// RUTAS PROTEGIDAS POR AUTENTICACIÓN
// ============================================
Route::middleware('auth')->group(function () {

    // Búsquedas (todos los usuarios autenticados)
    Route::post('search/users', [UserController::class, 'search'])->name('users.search');
    Route::post('search/pets', [PetController::class, 'search'])->name('pets.search');
    Route::post('search/adoptions', [AdoptionController::class, 'search'])->name('adoptions.search');

    // ========================================
    // RUTAS SOLO PARA ADMINISTRADORES
    // ========================================
    Route::middleware('admin')->group(function () {

        // Exportaciones
        Route::get('export/users/pdf', [UserController::class, 'pdf'])->name('users.pdf');
        Route::get('export/pets/pdf', [PetController::class, 'pdf'])->name('pets.pdf');
        Route::get('export/adoptions/pdf', [AdoptionController::class, 'pdf'])->name('adoptions.pdf');
        Route::get('export/users/excel', [UserController::class, 'excel'])->name('users.excel');
        Route::get('export/pets/excel', [PetController::class, 'excel'])->name('pets.excel');
        Route::get('export/adoptions/excel', [AdoptionController::class, 'excel'])->name('adoptions.excel');

        // Importación de usuarios
        Route::post('import/users', [UserController::class, 'import'])->name('users.import');

        // Recursos completos (CRUD)
        Route::resources([
            'users'       => UserController::class,
            'pets'        => PetController::class,
            'adoptions'   => AdoptionController::class,
        ]);
    });

    // ========================================
    // RUTAS DE CUSTOMER (ACCESO PARA CLIENTES)
    // ========================================
    // Perfil
    Route::get('myprofile', [CustomerController::class, 'myprofile'])->name('customer.myprofile');
    Route::put('myprofile/{user}', [CustomerController::class, 'updatemyprofile'])->name('customer.updatemyprofile');

    // Adopciones del usuario
    Route::get('myadoptions', [CustomerController::class, 'myadoptions'])->name('customer.myadoptions');
    Route::get('myadoption/{id}', [CustomerController::class, 'showadoption'])->name('customer.showadoption');

    // Mascotas disponibles
    Route::get('listpets', [CustomerController::class, 'listpets'])->name('customer.listpets');
Route::get('showpet/{id}', [CustomerController::class, 'showpet'])->name('customer.showpet');

Route::match(['get', 'post'], 'search/adoptionpets', [CustomerController::class, 'search'])->name('customer.searchpets');
Route::post('makeadoption', [CustomerController::class, 'makeadoption'])->name('customer.makeadoption');
});


require __DIR__.'/auth.php';
// ============================================
// RUTAS PÚBLICAS
// ============================================

Route::get('hello', function () {
    return "<h1>Hello Laravel 🚀</h1>";
});

Route::get('sayhello/{name}', function ($name) {
    return "<h1>Hello: " . $name . "</h1>";
});

// Ruta getall/pets (solo una, no duplicada)
Route::get('getall/pets', function(){
    $pets = Pet::all();
    return view('getallpets')->with('pets', $pets);
});

Route::get('show/pet/{id}', function($id){
    $pet = Pet::findOrFail($id);
    return view('showpet')->with('pet', $pet);
});

Route::get('challenge', function () {
    if (!file_exists(public_path('images'))) {
        mkdir(public_path('images'), 0777, true);
    }

    if (User::count() < 20) {
        User::factory()->count(20)->create();
    }

    $users = User::take(20)->get();

    foreach ($users as $user) {
        $imagePath = public_path('images/' . $user->photo);
        if (!file_exists($imagePath)) {
            try {
                $gender = ($user->gender == 'Male') ? 'men' : 'women';
                $url = "https://randomuser.me/api/portraits/{$gender}/" . rand(1,99) . ".png";
                file_put_contents($imagePath, file_get_contents($url));
            } catch (\Exception $e) {
            }
        }
    }

    $headerStyle = "style='background: gray; color: white; padding: 0.4rem; border: 1px solid gray;'";
    $cellStyle = "style='border: 1px solid gray; padding: 0.4rem;'";

    $code = "<h2>Challenge</h2>";
    $code .= "<table style='border-collapse: collapse; margin: 2px auto; font-family: Arial; border: 1px solid gray; width: 100%;'>";

    $code .= "<tr>";
    $code .= "<th $headerStyle>Photo</th>";
    $code .= "<th $headerStyle>Fullname</th>";
    $code .= "<th $headerStyle>Age</th>";
    $code .= "<th $headerStyle>Gender</th>";
    $code .= "<th $headerStyle>Created At</th>";
    $code .= "</tr>";

    foreach ($users as $user) {
        $age = Carbon::parse($user->birthdate)->age;

        $code .= "<tr>";

        $code .= "<td $cellStyle>";
        if (file_exists(public_path('images/' . $user->photo))) {
            $code .= "<img src='" . asset('images/' . $user->photo) . "' width='60' height='60' style='display: block; margin: 0 auto;'>";
        }
        $code .= "</td>";

        $code .= "<td $cellStyle>" . $user->fullname . "</td>";
        $code .= "<td $cellStyle>" . $age . " años</td>";
        $code .= "<td $cellStyle>" . $user->gender . "</td>";
        $code .= "<td $cellStyle>" . $user->created_at . "</td>";
        $code .= "</tr>";
    }

    $code .= "</table>";

    return $code;
});
