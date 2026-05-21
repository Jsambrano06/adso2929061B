@extends('layouts.app')

@section('title', 'Larapets: Show My Adoption')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
        </svg>
        Show My Adoption
    </h1>
    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ url('myadoptions') }}">My adoptions</a>
            </li>
            <li>
                <span class="inline-flex items-center gap-2">Show My Adoption</span>
            </li>
        </ul>
    </div>
    {{-- Card --}}
    <div class="bg-[#0009] p-10 rounded-sm flex flex-col items-center">
        {{-- Image --}}
        <div class="avatar-group -space-x-6">
            <div class="avatar">
                <div class="w-36">
                    <img src="{{ asset('images/' . ($adoption->user->photo ?? 'no-photo.png')) }}"
                         onerror="this.src='{{ asset('images/no-photo.png') }}'"
                         alt="User photo" />
                </div>
            </div>
            <div class="avatar">
                <div class="w-36">
                    <img src="{{ asset('images/pets/' . ($adoption->pet->image ?? 'no-photo.png')) }}"
                         onerror="this.src='{{ asset('images/pets/no-photo.png') }}'"
                         alt="Pet photo" />
                </div>
            </div>
        </div>

        {{-- Adoption Date --}}
        <div class="mt-4 text-center">
            <div class="badge badge-outline badge-info gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
                </svg>
                {{ \Carbon\Carbon::parse($adoption->created_at)->format('d/m/Y') }}
            </div>
            <p class="text-white/50 text-xs mt-1">Hace {{ \Carbon\Carbon::parse($adoption->created_at)->diffForHumans() }}</p>
        </div>

        {{-- Data --}}
        <div class="flex gap-2 flex-col md:flex-row mt-4">
            <ul class="list bg-[#0006] mt-4 text-white rounded-box shadow-md w-64">
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Document:</span> <span>{{ $adoption->user->document ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">FullName:</span> <span>{{ $adoption->user->fullname ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Gender:</span> <span>{{ $adoption->user->gender ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Age:</span> <span>{{ \Carbon\Carbon::parse($adoption->user->birthdate)->age }} years old</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Phone:</span> <span>{{ $adoption->user->phone ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Email:</span> <span>{{ $adoption->user->email ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Active:</span>
                    <span>
                        @if (isset($adoption->user->active) && $adoption->user->active == 1)
                            <div class="badge badge-outline badge-success">Active</div>
                        @else
                            <div class="badge badge-outline badge-error">Inactive</div>
                        @endif
                    </span>
                </li>
            </ul>
            <ul class="list bg-[#0006] mt-4 text-white rounded-box shadow-md w-64">
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Name:</span> <span>{{ $adoption->pet->name ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Kind:</span> <span>
                        @if(isset($adoption->pet->kind))
                            @if($adoption->pet->kind == 'Perro')
                                <div class="badge badge-outline badge-info">Dog</div>
                            @elseif ($adoption->pet->kind == 'Gato')
                                <div class="badge badge-outline badge-secondary">Cat</div>
                            @else
                                <div class="badge badge-outline">{{ $adoption->pet->kind }}</div>
                            @endif
                        @else
                            <div class="badge badge-outline">N/A</div>
                        @endif
                    </span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Breed:</span> <span>{{ $adoption->pet->breed ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Weight:</span> <span>{{ $adoption->pet->weight ?? 'N/A' }} kg</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Age:</span> <span>{{ $adoption->pet->age ?? 'N/A' }} years old</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Location:</span>
                    <span>{{ $adoption->pet->location ?? 'N/A' }}</span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Active:</span>
                    <span>
                        @if(isset($adoption->pet->active) && $adoption->pet->active == 1)
                            <div class="badge badge-outline badge-success">Yes</div>
                        @else
                            <div class="badge badge-outline badge-error">No</div>
                        @endif
                    </span>
                </li>
                <li class="list-row">
                    <span class="text-[#fff9] font-semibold">Status:</span>
                    <span>
                        @if(isset($adoption->pet->adopted) && $adoption->pet->adopted == 1)
                            <div class="badge badge-outline badge-error">Adopted</div>
                        @else
                            <div class="badge badge-outline badge-success">Available</div>
                        @endif
                    </span>
                </li>
            </ul>
        </div>

        {{-- Back Button --}}
        <div class="mt-6">
            <a href="{{ url('myadoptions') }}" class="btn btn-outline btn-sm hover:bg-white/50 bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                </svg>
                Back
            </a>
        </div>
    </div>
@endsection
