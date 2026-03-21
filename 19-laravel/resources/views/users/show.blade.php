@extends('layouts.app')

@section('title', 'Larapets: Show User')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentcolor" viewBox="0 0 256 256">
            <path
                d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
            </path>
        </svg>
        Show User
    </h1>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z">
                        </path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z">
                        </path>
                    </svg>
                    User Module
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentcolor" viewBox="0 0 256 256">
                        <path
                            d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                        </path>
                    </svg>
                    Show User
                </span>
            </li>
        </ul>
    </div>
    <div class="card text-white md:w-[720px] w-[320px] bg-black/20 p-4 mb-4 rounded">
        <form method="POST" action="{{ url('users') }}" class="flex flex-col md:flex-row gap-4 mt-4"
            enctype="multipart/form-data">
            @csrf
            <div class="w-full md:w-[320px]">
                <div
                    class="avatar flex flex-col gap-1 items-center justify-center cursor-pointer hover:scale-105 transition ease-in">
                    <div class="avatar">
                        <div>
                            <img src="{{ asset('images/' . $user->photo) }}" />
                        </div>
                    </div>
                </div>
                <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
            </div>
            <div class="w-full md:w-[320px]">
                {{-- Document --}}
                <label class="label text-white">Document:</label>
                <td class="hidden md:table-cell">{{ $user->document }}</td>
                {{-- FullName --}}
                <label class="label text-white">FullName:</label>
                <td>{{ $user->fullname }}</td>
                {{-- Gender --}}
                <label class="label text-white">Gender:</label>
                <td>{{ $user->gender }}</td>
                {{-- Birthdate --}}
                <label class="label text-white">Birthdate:</label>
                <input type="date" class="input bg-[#0009] outline-0" name="birthdate" placeholder="1640-10-08"
                    value="{{ old('birthdate') }}">
                @error('birthdate')
                    <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-full md:w-[320px]">
                {{-- Phone --}}
                <label class="label text-white">Phone:</label>
                <input type="text" class="input bg-[#0009] outline-0" name="phone" placeholder="3101231234"
                    value="{{ old('phone') }}">
                @error('phone')
                    <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
                {{-- Email --}}
                <label class="label text-white">Email:</label>
                <input type="text" class="input bg-[#0009] outline-0" name="email" placeholder="Email"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="badge badge-error w-full mt-1 text-xs py-4">{{ $message }}</small>
                @enderror
                {{-- Password --}}
                <label class="label text-white">Password:</label>
                <input type="password" class="input bg-[#0009] outline-0" name="password" placeholder="Secret">
                @error('password')
                    <small class="badge badge-error w-full mt-1 text-xs py-3">{{ $message }}</small>
                @enderror
                {{-- Password Confirmation --}}
                <label class="label text-white">Password Confirmation:</label>
                <input type="password" class="input bg-[#0009] outline-0" name="password_confirmation" placeholder="Secret">

                <button class="btn btn-outline hover:bg-[#fff6] hover:text-white mt-3 w-full">Add</button>
            </div>
        </form>
    </div>
@endsection
