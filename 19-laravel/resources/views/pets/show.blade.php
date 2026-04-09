@extends('layouts.app')

@section('title', 'Larapets: Show Pet')

@section('content')
    @include('partials.navbar')

    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/>
        </svg>
        Show Pet
    </h1>

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li><span>Show Pet</span></li>
        </ul>
    </div>

    <div class="card text-white md:w-[720px] w-[95%] max-w-[720px] bg-black/50 p-4 md:p-8 mb-4 mx-auto">
        <div class="flex flex-col items-center gap-6">

            {{-- Imagen de la mascota --}}
            <div class="mask mask-squircle w-32 md:w-48">
                @php
                    $imagePath = 'images/pets/' . ($pet->image ?? 'default-pet.png');
                    $fullImagePath = public_path($imagePath);
                    $imageExists = file_exists($fullImagePath);
                @endphp

                @if($imageExists && !empty($pet->image))
                    <img src="{{ asset($imagePath) }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/default-pet.png') }}" class="w-full h-full object-cover">
                @endif
            </div>

            {{-- Grid responsive --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 md:gap-x-16 gap-y-4 w-full">

                {{-- Columna izquierda --}}
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="font-bold block">Name:</span>
                        <span>{{ $pet->name ?? 'Not specified' }}</span>
                    </div>

                    <div>
                        <span class="font-bold block">Kind:</span>
                        <span>
                            @switch($pet->kind)
                                @case('dog') Dog @break
                                @case('cat') Cat @break
                                @case('pig') Pig @break
                                @default Bird
                            @endswitch
                        </span>
                    </div>

                    <div>
                        <span class="font-bold block">Breed:</span>
                        <span>{{ $pet->breed ?? 'Not specified' }}</span>
                    </div>

                    <div>
                        <span class="font-bold block">Weight:</span>
                        <span>{{ $pet->weight ?? 'Not specified' }} kg</span>
                    </div>

                    <div>
                        <span class="font-bold block">Age:</span>
                        <span>{{ $pet->age ?? 'Not specified' }} years</span>
                    </div>
                </div>

                {{-- Columna derecha --}}
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="font-bold block">Location:</span>
                        <span>{{ $pet->location ?? 'Not specified' }}</span>
                    </div>

                    <div>
                        <span class="font-bold block">Description:</span>
                        <span>{{ $pet->description ?? 'Not specified' }}</span>
                    </div>

                    <div>
                        <span class="font-bold block">Status:</span>
                        @if($pet->active == '1')
                            <span class="badge badge-outline badge-success">Active</span>
                        @else
                            <span class="badge badge-outline badge-error">Inactive</span>
                        @endif
                    </div>

                    <div>
                        <span class="font-bold block">Adopted:</span>
                        @if($pet->adopted == '1')
                            <span class="badge badge-outline badge-info">Adopted</span>
                        @else
                            <span class="badge badge-outline badge-success">Available</span>
                        @endif
                    </div>

                    <div>
                        <span class="font-bold block">Created At:</span>
                        @if(isset($pet->created_at))
                            {{ $pet->created_at->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </div>
                </div>
            </div>

            {{-- Botón --}}
            <a href="{{ url('pets') }}" class="btn btn-outline hover:bg-[#fff6] hover:text-white w-full mt-4">
                ← Back
            </a>

        </div>
    </div>
@endsection