@extends('layouts.app')

@section('title', 'Larapets: Module Pets')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M104,40H56A16,16,0,0,0,40,56v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,104,40Zm0,64H56V56h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V56A16,16,0,0,0,200,40Zm0,64H152V56h48v48Zm-96,32H56a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,104,136Zm0,64H56V152h48v48Zm96-64H152a16,16,0,0,0-16,16v48a16,16,0,0,0,16,16h48a16,16,0,0,0,16-16V152A16,16,0,0,0,200,136Zm0,64H152V152h48v48Z"></path>
        </svg>
        Module Pets
    </h1>

    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="join mx-auto">
            <a class="btn btn-outline btn-success join-item" href="{{ url('pets/create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z"></path>
                </svg>
                <span class="hidden md:inline">Add Pet</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/pets/pdf') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
                </svg>
                <span class="hidden md:inline">PDF</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item" href="{{ url('export/pets/excel') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
                </svg>
                <span class="hidden md:inline">Excel</span>
            </a>
        </div>

        <label class="input text-white bg-[#0009] md:w-110 w-57 outline mb-10 outline-white">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" placeholder="Search pets..." name="qsearch" id="qsearch" />
        </label>
    </div>

    <div class="overflow-x-auto mb-10 rounded-box border border-base-content/5 bg-black/50 text-white">
        <table class="table">
            <thead>
                <tr class="text-white bg-black">
                    <th class="hidden md:table-cell">ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th class="hidden md:table-cell">Kind</th>
                    <th class="hidden md:table-cell">Breed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="pets-table-body">
                @foreach ($pets as $pet)
                <tr class="even:bg-white/5">
                    <td class="hidden md:table-cell">{{ $pet->id }}</td>
                    <td>
                        <div class="avatar">
                            <div class="mask mask-squircle w-12">
                                <img src="{{ asset('images/pets/' . $pet->image) }}" />
                            </div>
                        </div>
                    </td>
                    <td class="font-bold">{{ $pet->name }}</td>
                    <td class="hidden md:table-cell">{{ $pet->kind }}</td>
                    <td class="hidden md:table-cell">{{ $pet->breed }}</td>
                    <td>
                        @if ($pet->adopted)
                            <span class="badge badge-success">Adopted</span>
                        @else
                            <span class="badge badge-info">Available</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-1">
                            <a href="{{ url('pets/' . $pet->id) }}" class="btn btn-xs btn-outline btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                </svg>
                            </a>
                            <a href="{{ url('pets/' . $pet->id . '/edit') }}" class="btn btn-xs btn-outline btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                                </svg>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-outline btn-error btn-delete" data-name="{{ $pet->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path>
                                </svg>
                            </a>
                            <form class="hidden" method="POST" action="{{ url('pets/' . $pet->id) }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t border-base-content/10">
                    <td colspan="7" class="px-4 py-3 text-center">
                        {{ $pets->links('partials.pagination') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('js')
<script>
    @if(session('message'))
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ session('message') }}",
            showConfirmButton: false,
            timer: 4500
        });
    @endif

    $('.btn-delete').click(function() {
        let petName = $(this).attr('data-name');
        let form = $(this).next('form');
        Swal.fire({
            title: "Are you sure?",
            text: "The Pet: " + petName + " will be deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

    // Búsqueda en tiempo real
    let timeout;
    $('#qsearch').on('keyup', function() {
        let query = $(this).val();

        clearTimeout(timeout);

        if(query.length >= 2) {
            timeout = setTimeout(function() {
                $.ajax({
                    url: "{{ url('search/pets') }}",
                    type: "POST",
                    data: {
                        q: query,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        $('#pets-table-body').html('<tr><td colspan="7" class="text-center py-8"><div class="loading loading-spinner loading-md"></div> Searching...<\/td><\/tr>');
                    },
                    success: function(response) {
                        $('#pets-table-body').html(response);
                    },
                    error: function() {
                        $('#pets-table-body').html('<tr><td colspan="7" class="text-center py-8 text-red-500">Error searching<\/td><\/tr>');
                    }
                });
            }, 500);
        } else if(query.length === 0) {
            location.reload();
        }
    });
</script>
@endsection
