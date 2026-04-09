@extends('layouts.app')

@section('title', 'Larapets: Edit Pet')

@section('content')
    @include('partials.navbar')

    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
            <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63Z"/>
        </svg>
        Edit Pet
    </h1>

    {{-- Breadcrumbs --}}
    <div class="breadcrumbs text-sm text-white mb-6">
        <ul>
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('pets') }}">Pet Module</a></li>
            <li><span>Edit Pet</span></li>
        </ul>
    </div>

    {{-- Alerts --}}
    @if(session('message'))
        <div class="alert alert-success mb-4">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error mb-4">
            <span>Please fix the errors</span>
        </div>
    @endif

    <div class="card text-white md:w-[720px] w-[95%] max-w-[720px] bg-black/50 p-4 md:p-8 mb-4 mx-auto">

        <form method="POST" action="{{ url('pets/'.$pet->id) }}" enctype="multipart/form-data"
              class="flex flex-col items-center gap-6">

            @csrf
            @method('PUT')

            {{-- Imagen --}}
            <div class="flex flex-col items-center gap-2 cursor-pointer">
                <div id="upload" class="mask mask-squircle w-32 md:w-48 hover:scale-105 transition">
                    <img id="preview"
                        src="{{ asset('images/pets/' . ($pet->image ?? 'default-pet.png')) }}"
                        class="w-full h-full object-cover">
                </div>

                <small class="border-b border-white flex gap-1 items-center">
                    Change Image
                </small>

                @error('image')
                    <small class="badge badge-error w-full">{{ $message }}</small>
                @enderror

                <input type="file" id="photo" name="image" class="hidden" accept="image/*">
                <input type="hidden" name="originimage" value="{{ $pet->image }}">
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 md:gap-x-16 gap-y-4 w-full">

                {{-- Columna izquierda --}}
                <div class="flex flex-col gap-4">

                    <div>
                        <label class="font-bold block">Name:</label>
                        <input type="text" name="name"
                            class="input bg-[#0009] w-full @error('name') input-error @enderror"
                            value="{{ old('name', $pet->name) }}">
                        @error('name')
                            <small class="badge badge-error w-full">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label class="font-bold block">Kind:</label>
                        <select name="kind"
                            class="select bg-[#0009] w-full @error('kind') select-error @enderror">
                            <option value="">Select...</option>
                            <option value="dog" @selected(old('kind', $pet->kind)=='dog')>Dog</option>
                            <option value="cat" @selected(old('kind', $pet->kind)=='cat')>Cat</option>
                            <option value="pig" @selected(old('kind', $pet->kind)=='pig')>Pig</option>
                            <option value="bird" @selected(old('kind', $pet->kind)=='bird')>Bird</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-bold block">Breed:</label>
                        <input type="text" name="breed"
                            class="input bg-[#0009] w-full @error('breed') input-error @enderror"
                            value="{{ old('breed', $pet->breed) }}">
                    </div>

                    <div>
                        <label class="font-bold block">Weight:</label>
                        <input type="number" step="0.1" name="weight"
                            class="input bg-[#0009] w-full @error('weight') input-error @enderror"
                            value="{{ old('weight', $pet->weight) }}">
                    </div>

                </div>

                {{-- Columna derecha --}}
                <div class="flex flex-col gap-4">

                    <div>
                        <label class="font-bold block">Age:</label>
                        <input type="number" name="age"
                            class="input bg-[#0009] w-full @error('age') input-error @enderror"
                            value="{{ old('age', $pet->age) }}">
                    </div>

                    <div>
                        <label class="font-bold block">Location:</label>
                        <input type="text" name="location"
                            class="input bg-[#0009] w-full @error('location') input-error @enderror"
                            value="{{ old('location', $pet->location) }}">
                    </div>

                    <div>
                        <label class="font-bold block">Description:</label>
                        <textarea name="description"
                            class="textarea bg-[#0009] w-full @error('description') textarea-error @enderror">{{ old('description', $pet->description) }}</textarea>
                    </div>

                    <div>
                        <label class="font-bold block">Status:</label>
                        <select name="active" class="select bg-[#0009] w-full">
                            <option value="1" @selected(old('active',$pet->active)=='1')>Active</option>
                            <option value="0" @selected(old('active',$pet->active)=='0')>Inactive</option>
                        </select>
                    </div>

                    <div>
                        <label class="font-bold block">Adopted:</label>
                        <select name="adopted" class="select bg-[#0009] w-full">
                            <option value="0" @selected(old('adopted',$pet->adopted)=='0')>Available</option>
                            <option value="1" @selected(old('adopted',$pet->adopted)=='1')>Adopted</option>
                        </select>
                    </div>

                </div>
            </div>

            <button class="btn btn-outline hover:bg-[#fff6] hover:text-white w-full mt-4">
                Update Pet
            </button>

        </form>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#upload').click(function (e) {
            e.preventDefault()
            $('#photo').click()
        })

        $('#photo').change(function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader()
                reader.onload = e => $('#preview').attr('src', e.target.result)
                reader.readAsDataURL(this.files[0])
            }
        })
    })
</script>
@endsection