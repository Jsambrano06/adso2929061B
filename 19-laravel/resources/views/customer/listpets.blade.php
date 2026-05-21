@extends('layouts.app')

@section('title', 'Larapets: Make Adoption')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56ZM119.46,48A31.15,31.15,0,0,1,148.6,67a8,8,0,0,0,14.8,0,31.15,31.15,0,0,1,29.14-19C209.59,48,224,62.65,224,80c0,19.51-15.79,41.58-45.66,63.9l-11.09,2.55A28,28,0,0,0,140,112H100.68C92.05,100.36,88,90.12,88,80,88,62.65,102.41,48,119.46,48ZM16,160H40v40H16Zm203.43,8.21-38,16.18L119,200H56V155.31l22.63-22.62A15.86,15.86,0,0,1,89.94,128H140a12,12,0,0,1,0,24H112a8,8,0,0,0,0,16h32a8.32,8.32,0,0,0,1.79-.2l67-15.41.31-.08a8.6,8.6,0,0,1,6.3,15.9Z">
            </path>
        </svg>
        Make Adoption
    </h1>

    <div class="flex flex-col gap-4 justify-center items-center">
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
                    <th>Kind</th>
                    <th class="hidden md:table-cell">Breed</th>
                    <th>Action</th>
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
                        <td>{{ $pet->kind }}</td>
                        <td class="hidden md:table-cell">{{ $pet->breed }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ url('showpet/' . $pet->id) }}" class="btn btn-xs btn-outline btn-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M230.33,141.06a24.34,24.34,0,0,0-18.61-4.77C230.5,117.33,240,98.48,240,80c0-26.47-21.29-48-47.46-48A47.58,47.58,0,0,0,156,48.75,47.58,47.58,0,0,0,119.46,32C93.29,32,72,53.53,72,80c0,11,3.24,21.69,10.06,33a31.87,31.87,0,0,0-14.75,8.4L44.69,144H16A16,16,0,0,0,0,160v40a16,16,0,0,0,16,16H120a7.93,7.93,0,0,0,1.94-.24l64-16a6.94,6.94,0,0,0,1.19-.4L226,182.82l.44-.2a24.6,24.6,0,0,0,3.93-41.56ZM119.46,48A31.15,31.15,0,0,1,148.6,67a8,8,0,0,0,14.8,0,31.15,31.15,0,0,1,29.14-19C209.59,48,224,62.65,224,80c0,19.51-15.79,41.58-45.66,63.9l-11.09,2.55A28,28,0,0,0,140,112H100.68C92.05,100.36,88,90.12,88,80,88,62.65,102.41,48,119.46,48ZM16,160H40v40H16Zm203.43,8.21-38,16.18L119,200H56V155.31l22.63-22.62A15.86,15.86,0,0,1,89.94,128H140a12,12,0,0,1,0,24H112a8,8,0,0,0,0,16h32a8.32,8.32,0,0,0,1.79-.2l67-15.41.31-.08a8.6,8.6,0,0,1,6.3,15.9Z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t border-base-content/10">
                    <td colspan="6" class="px-4 py-3 text-center">
                        <div class="pagination-wrapper">
                            {{ $pets->links('partials.pagination') }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
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

        let searchTimeout;
        let currentQuery = '';

        $('#qsearch').on('keyup', function() {
            let query = $(this).val();
            currentQuery = query;

            clearTimeout(searchTimeout);

            if (query.length >= 2) {
                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: "{{ url('search/adoptionpets') }}",
                        type: "POST",
                        data: {
                            q: query,
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            $('#pets-table-body').html(
                                '<tr><td colspan="6" class="text-center py-8"><span class="loading loading-spinner loading-md"></span> Searching...<\/td><\/tr>'
                                );
                            $('.pagination-wrapper').hide();
                        },
                        success: function(data) {
                            $('#pets-table-body').html(data);
                        },
                        error: function() {
                            $('#pets-table-body').html(
                                '<tr><td colspan="6" class="text-center py-8 text-red-500">Error searching<\/td><\/tr>'
                                );
                        }
                    });
                }, 500);
            } else if (query.length === 0) {
                location.reload();
            }
        });

        // Para la paginación cuando hay búsqueda activa
        $(document).on('click', '.pagination a', function(e) {
            if (currentQuery.length >= 2) {
                e.preventDefault();
                let url = $(this).attr('href');

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        q: currentQuery,
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        $('#pets-table-body').html(
                            '<tr><td colspan="6" class="text-center py-8"><span class="loading loading-spinner loading-md"></span> Loading...<\/td><\/tr>'
                            );
                    },
                    success: function(data) {
                        $('#pets-table-body').html(data);
                        $('.pagination-wrapper').hide();
                    },
                    error: function() {
                        $('#pets-table-body').html(
                            '<tr><td colspan="6" class="text-center py-8 text-red-500">Error loading page<\/td><\/tr>'
                            );
                    }
                });
            }
        });
    </script>
@endsection
