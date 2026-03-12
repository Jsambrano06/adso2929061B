@extends('layouts.app')

@section('title', 'Larapets: Register')
@section('content')
    @include('partials.navbar')

    <section
        class="bg-[#0006] p-4 border-white border-2 rounded-md md:w-fit w-80 flex flex-col justify-center items-center my-5">

        <h1 class="text-4xl flex border-b-2 pb-2 gap-2 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentcolor" viewBox="0 0 256 256">
                <path
                    d="M256,136a8,8,0,0,1-8,8H232v16a8,8,0,0,1-16,0V144H200a8,8,0,0,1,0-16h16V112a8,8,0,0,1,16,0v16h16A8,8,0,0,1,256,136Zm-57.87,58.85a8,8,0,0,1-12.26,10.3C165.75,181.19,138.09,168,108,168s-57.75,13.19-77.87,37.15a8,8,0,0,1-12.25-10.3c14.94-17.78,33.52-30.41,54.17-37.17a68,68,0,1,1,71.9,0C164.6,164.44,183.18,177.07,198.13,194.85ZM108,152a52,52,0,1,0-52-52A52.06,52.06,0,0,0,108,152Z">
                </path>
            </svg>
            Register
        </h1>

        <form class="text-white flex flex-col md:flex-row gap-x-2 w-full" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="w-full md:w-80 flex flex-col gap-y-2 mt-8">
                <label for="label">Document:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="document" value="{{ old('document') }}"
                    placeholder="75000011">
                @error('document')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror


                <label for="label">Full-Name:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="fullname" value="{{ old('fullname') }}"
                    placeholder="pepito perez">
                @error('fullname')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Gender:</label>
                <select name="gender" class="select bg-[#0009] outline-1">
                    <option value="">Select...</option>
                    <option value="Female" @if (old('gender') == 'Female') selected @endif>
                        Female
                    </option>
                    <option value="Male" @if (old('gender') == 'Male') selected @endif>
                        Male
                    </option>
                </select>
                @error('gender')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror


                <label for="label">BirthDate:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="birthdate" value="{{ old('birthdate') }}"
                    placeholder="2000-12-25">
                @error('birthdate')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

            </div>
            <div class="w-full md:w-80 flex flex-col gap-y-2 mt-8">
                <label for="label">Phone:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="phone" value="{{ old('phone') }}"
                    placeholder="3001231234">
                @error('phone')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Email:</label>
                <input class="input bg-[#0009] outline-1" type="text" name="email" value="{{ old('email') }}"
                    placeholder="tucorreo@mail.com">
                @error('email')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Password:</label>
                <input class="input bg-[#0009] outline-1" type="password" name="password" placeholder="tusecreto">
                @error('password')
                    <small class="badge badge-error w-full ">{{ $message }} </small>
                @enderror

                <label for="label">Password Confirmation:</label>
                <input class="input bg-[#0009] outline-1" type="password" name="password_confirmation"
                    placeholder="tusecretodenuevo">

                <button class="btn btn-outline w-full mt-2">Register</button>
            </div>
        </form>

    </section>

@endsection
