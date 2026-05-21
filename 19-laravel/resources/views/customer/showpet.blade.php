@extends('layouts.app')

@section('title', 'Larapets: Show Pet')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56ZM119.46,48A31.15,31.15,0,0,1,148.6,67a8,8,0,0,0,14.8,0,31.15,31.15,0,0,1,29.14-19C209.59,48,224,62.65,224,80c0,19.51-15.79,41.58-45.66,63.9l-11.09,2.55A28,28,0,0,0,140,112H100.68C92.05,100.36,88,90.12,88,80,88,62.65,102.41,48,119.46,48ZM16,160H40v40H16Zm203.43,8.21-38,16.18L119,200H56V155.31l22.63-22.62A15.86,15.86,0,0,1,89.94,128H140a12,12,0,0,1,0,24H112a8,8,0,0,0,0,16h32a8.32,8.32,0,0,0,1.79-.2l67-15.41.31-.08a8.6,8.6,0,0,1,6.3,15.9Z">
            </path>
        </svg>
        Adoption Details
    </h1>

    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ url('listpets') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56ZM119.46,48A31.15,31.15,0,0,1,148.6,67a8,8,0,0,0,14.8,0,31.15,31.15,0,0,1,29.14-19C209.59,48,224,62.65,224,80c0,19.51-15.79,41.58-45.66,63.9l-11.09,2.55A28,28,0,0,0,140,112H100.68C92.05,100.36,88,90.12,88,80,88,62.65,102.41,48,119.46,48ZM16,160H40v40H16Zm203.43,8.21-38,16.18L119,200H56V155.31l22.63-22.62A15.86,15.86,0,0,1,89.94,128H140a12,12,0,0,1,0,24H112a8,8,0,0,0,0,16h32a8.32,8.32,0,0,0,1.79-.2l67-15.41.31-.08a8.6,8.6,0,0,1,6.3,15.9Z">
                        </path>
                    </svg>
                    Make Adoption
                </a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z" />
                    </svg>
                    {{ $pet->name }}
                </span>
            </li>
        </ul>
    </div>

    <div class="card text-white md:w-[720px] w-[95%] max-w-[720px] bg-black/50 p-4 md:p-8 mb-4 mx-auto">
        <div class="flex flex-col items-center gap-6">
            {{-- Photo --}}
            <div class="mask mask-squircle w-32 md:w-48">
                @php
                    $imagePath = 'images/pets/' . ($pet->image ?? 'no-photo.png');
                    $fullImagePath = public_path($imagePath);
                    $imageExists = file_exists($fullImagePath);
                @endphp

                @if ($imageExists && !empty($pet->image) && $pet->image != 'no-photo.png')
                    <img src="{{ asset($imagePath) }}" alt="Photo of {{ $pet->name }}"
                        class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/pets/no-photo.png') }}" alt="Default pet photo"
                        class="w-full h-full object-cover">
                @endif
            </div>

            {{-- Responsive grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 md:gap-x-16 gap-y-4 w-full">
                {{-- Columna izquierda --}}
                <div class="flex flex-col gap-4">
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Name:</span>
                        <span class="break-all">{{ $pet->name ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Kind:</span>
                        <span class="break-all">{{ $pet->kind ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Weight:</span>
                        <span class="break-all">{{ $pet->weight ?? 'Not specified' }} kg</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Age:</span>
                        @if (!empty($pet->age))
                            @if ($pet->age < 1)
                                {{ $pet->age * 12 }} months
                            @else
                                {{ number_format($pet->age, 1) }} years
                            @endif
                        @else
                            Not specified
                        @endif
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Breed:</span>
                        <span class="break-all">{{ $pet->breed ?? 'Not specified' }}</span>
                    </div>
                </div>

                {{-- Columna derecha --}}
                <div class="flex flex-col gap-4">
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Location:</span>
                        <span class="break-all">{{ $pet->location ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Description:</span>
                        <span class="break-all">{{ $pet->description ?? 'Not specified' }}</span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Status:</span>
                        <span>
                            @if ($pet->adopted)
                                <span class="badge badge-error">Adopted</span>
                            @else
                                <span class="badge badge-success">Available</span>
                            @endif
                        </span>
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Created At:</span>
                        @if (isset($pet->created_at))
                            {{ $pet->created_at->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </div>
                    <div class="break-words">
                        <span class="font-bold block text-sm md:text-base">Updated At:</span>
                        @if (isset($pet->updated_at))
                            {{ $pet->updated_at->diffForHumans() }}
                        @else
                            Not available
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex gap-4 w-full">
                <a href="{{ url('listpets') }}" class="btn btn-outline hover:bg-[#fff6] hover:text-white flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 mr-2" fill="currentColor" viewBox="0 0 256 256">
                        <path
                            d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z" />
                    </svg>
                    Back
                </a>

                @if (!$pet->adopted)
                    <button id="btn-adopt" class="btn btn-success flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5 mr-2" fill="currentColor"
                            viewBox="0 0 256 256">
                            <path
                                d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56Z" />
                        </svg>
                        Adopt this Pet
                    </button>
                    <form id="adopt-form" method="POST" action="{{ url('makeadoption') }}" style="display: none;">
                        @csrf
                        <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                    </form>
                @else
                    <button class="btn btn-disabled flex-1" disabled>
                        Already Adopted
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @if (session('message'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 4500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Cannot Adopt',
                text: "{{ session('error') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif

        // Confirmación de adopción con SweetAlert
        $('#btn-adopt').click(function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to adopt this pet. Are you sure you want to proceed?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, adopt it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#adopt-form').submit();
                }
            });
        });
    </script>
@endsection
