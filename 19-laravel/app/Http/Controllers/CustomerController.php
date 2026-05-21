<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Adoption;

class CustomerController extends Controller
{
    public function myprofile(){
        $user = User::find(Auth::User()->id);
        return view('customer.myprofile')->with('user', $user);
    }

    public function updatemyprofile(Request $request, User $user)
    {
        // Convertir email a minúsculas antes de todo
        $email = strtolower($request->email);

        // Validar que el usuario autenticado solo pueda editar su propio perfil
        if ($user->id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'You can only edit your own profile.');
        }

        $request->validate([
            'document' => ['required', 'numeric', 'unique:users,document,' . $user->id],
            'fullname' => ['required', 'string', 'max:255'],
            'gender'   => ['required', 'in:Female,Male'],
            'birthdate' => ['required', 'date'],
            'phone'    => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'photo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'active'   => ['required', 'in:0,1'],
            'role'     => ['required', 'in:Customer,Admin,Moderator'],
        ]);

        // Actualizar los datos del usuario
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->phone = $request->phone;
        $user->active = $request->active;
        $user->role = $request->role;
        $user->email = $email;

        // Manejar la foto
        if ($request->hasFile('photo')) {
            // Eliminar foto anterior si no es la default
            if ($user->photo && $user->photo != 'default.jpg') {
                $oldPhotoPath = public_path('images/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $photoName);
            $user->photo = $photoName;
        }

        if ($user->save()) {
            return redirect('dashboard')->with('success', 'The User: ' . $user->fullname . ' was edited successfully!');
        }

        return back()->with('error', 'Error updating user');
    }

    public function myadoptions()
    {
        // Lógica para mostrar adopciones del usuario
        $adoptions = Adoption::where('user_id', Auth::user()->id)
            ->with(['user', 'pet'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('customer.myadoptions', compact('adoptions'));
    }

    public function showadoption(Request $request)
    {
        $adoption = Adoption::find($request->id);
        return view('customer.showmyadoption')->with('adoption', $adoption);
    }

    public function listpets()
    {
        $pets = Pet::where('adopted', 0)->orderBy('id', 'desc')->paginate(12);
        return view('customer.listpets')->with('pets', $pets);
    }

    public function search(Request $request)
{
    $q = $request->input('q');

    $pets = Pet::where('adopted', 0)
                ->where(function($query) use ($q) {
                    $query->where('name', 'LIKE', "%$q%")
                          ->orWhere('kind', 'LIKE', "%$q%")
                          ->orWhere('breed', 'LIKE', "%$q%")
                          ->orWhere('location', 'LIKE', "%$q%");
                })
                ->orderBy('id', 'desc')
                ->paginate(12);

    if ($request->ajax() || $request->wantsJson()) {
        return view('customer.searchpets', compact('pets'))->render();
    }

    return view('customer.listpets', compact('pets'));
}

    public function showpet($id)
    {
        $pet = Pet::find($id);
        return view('customer.showpet')->with('pet', $pet);
    }

    public function makeadoption(Request $request)
{
    $request->validate([
        'pet_id' => 'required|exists:pets,id'
    ]);

    $user = Auth::user();
    $pet = Pet::find($request->pet_id);

    if ($pet->adopted) {
        return redirect()->back()->with('error', 'This pet has already been adopted.');
    }

    $countAdoptions = Adoption::where('user_id', $user->id)->count();

    if($countAdoptions >= 3){
        return redirect()->back()->with('error', 'You have reached the maximum number of adoptions (3). You cannot adopt more pets.');
    }

    $adoption = new Adoption();
    $adoption->user_id = $user->id;
    $adoption->pet_id = $pet->id;
    $adoption->save();


    $pet->adopted = 1;
    $pet->save();

    return redirect()->route('customer.listpets')->with('message', 'Congratulations! You have successfully adopted ' . $pet->name);
}
}
