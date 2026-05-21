<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

use App\Imports\UsersImport;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->get('search');
    if ($search) {
        $users = User::where('fullname', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('document', 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->paginate(12);
    } else {
        $users = User::orderBy('id', 'desc')->paginate(12);
    }
    return view('users.index')->with('users', $users);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([

            'document' => ['required', 'numeric', 'unique:' . User::class],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'photo' => ['required', 'image'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validation) {
            // dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
            }
        }

        $user = new User;
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()) {
            return redirect('users')
                ->with('message', 'The User: ' . $user->fullname . ' Was added successful!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show')->with('user', $user);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $Request, User $user)
    {
        // Convertir email a minúsculas antes de todo
        $email = strtolower($Request->email);

        $Request->validate([
            'document' => ['required', 'numeric', 'unique:users,document,' . $user->id],
            'fullname' => ['required', 'string'],
            'gender'   => ['required', 'in:Female,Male'],
            'birthdate' => ['required', 'date'],
            'phone'    => ['required', 'string'],
            'email'    => ['required', 'string', 'email', 'unique:users,email,' . $user->id],
            'photo'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'active'   => ['required', 'in:0,1'],
            'role'     => ['required', 'in:Customer,Admin,Moderator'],
        ]);

        // Asignar el email convertido
        $user->email = $email;
        $user->document = $Request->document;
        $user->fullname = $Request->fullname;
        $user->gender = $Request->gender;
        $user->birthdate = $Request->birthdate;
        $user->phone = $Request->phone;
        $user->active = $Request->active;
        $user->role = $Request->role;

        // Manejar la foto
        if ($Request->hasFile('photo')) {
            // Eliminar foto anterior si no es la default
            if ($user->photo && $user->photo != 'default.jpg') {
                $oldPhotoPath = public_path('images/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $photoName = time() . '.' . $Request->photo->extension();
            $Request->photo->move(public_path('images'), $photoName);
            $user->photo = $photoName;
        }

        if ($user->save()) {
            return redirect('users')->with('message', 'The User: ' . $user->fullname . ' was edited successfully!');
        }

        return back()->with('error', 'Error updating user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Delete old photo
        if (
            $user->photo != 'no-photo.png' &&
            file_exists(public_path('images/' . $user->photo))
        ) {
            unlink(public_path('images/' . $user->photo));
        }
        if ($user->delete()) {
            return redirect('users')
                ->with('message', 'The User: ' . $user->fullname . ' was delete successfully!');
        }
    }

    /**
     * Generate a PDF file
     */
    public function pdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('users.pdf', compact('users'));
        return $pdf->download('allusers.pdf');
    }
    /**
     * Generate a Excel file
     */
    public function excel()
    {
        return Excel::download(new UsersExport, 'allusers.xlsx');
    }
/**
 * Import a Excel file
 */
public function import(Request $request)  // ← Request con R mayúscula
{
    $file = $request->file('file');
    Excel::import(new UsersImport, $file);
    return redirect()->back()->with('message', 'Users Imported successfully!');
}

public function search(Request $request)
{
    $q = $request->input('q');
    $users = User::where('fullname', 'like', '%' . $q . '%')
        ->orWhere('email', 'like', '%' . $q . '%')
        ->orWhere('document', 'like', '%' . $q . '%')
        ->orderBy('id', 'desc')
        ->paginate(12);
    
    return view('users.search', compact('users'));
}
}
