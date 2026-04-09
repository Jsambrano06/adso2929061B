@extends('layouts.app')

@section('title', 'Larapets: Module pets')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-10" fill="currentColor" viewBox="0 0 256 256">
            <path
                d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z">
            </path>
        </svg>
        Module pets
    </h1>

    {{-- Options --}}
    <div class="flex flex-col gap-4 justify-center items-center">
        <div class="join mx-auto">
            <a class="btn btn-outline btn-success join-item" href="{{ url('pets/create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H136v32a8,8,0,0,1-16,0V136H88a8,8,0,0,1,0-16h32V88a8,8,0,0,1,16,0v32h32A8,8,0,0,1,176,128Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Add Pets</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item"
                href="{{ url('export/pets/pdf') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
            <a class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white join-item"
                href="{{ url('export/pets/excel') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path
                        d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z">
                    </path>
                </svg>
                <span class="hidden md:inline">Export</span>
            </a>
        </div>
        {{-- Search --}}
        <label class="input text-white bg-[#0009] w-58 md:w-112 outline outline-white mb-10">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" placeholder="Search..." name="qsearch" id="qsearch" />
        </label>
    </div>

    <div class="overflow-x-auto mb-10 rounded-box border border-base-content/5 bg-black/50">
        <table class="table">
            <!-- head -->
            <thead class="text-white bg-black">
                <tr>
                    <th class="hidden md:table-cell">ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Kind</th>
                    <th class="hidden md:table-cell">Breed</th>
                    <th>Adopted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="datalist text-white">
                @foreach ($pets as $pet)
                    <tr class="even:bg-white/10">
                        <td class="hidden md:table-cell">{{ $pet->id }}</td>
                        <td>
                            <div class="avatar">
                                <div class="mask mask-squircle w-18">
                                    <img src="{{ asset('images/pets/' . $pet->image) }}" />
                                </div>
                            </div>
                        </td>
                        <td>{{ $pet->name }}</td>
                        <td>
                            @switch($pet->kind)
                                @case('dog')
                                    <span class="badge badge-soft badge-secondary">Dog</span>
                                @break

                                @case('cat')
                                    <span class="badge badge-soft badge-primary">Cat</span>
                                @break

                                @default
                                    <span class="badge badge-soft badge-warning">Other</span>
                            @endswitch
                        </td>
                        <td class="hidden md:table-cell">{{ $pet->breed }}</td>
                        <td>
                            @if ($pet->adopted == '1')
                                <span class="badge badge-outline badge-info">Adopted</span>
                            @else
                                <span class="badge badge-outline badge-success">Available</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('pets/' . $pet->id) }}" class="btn btn-xs btn-outline btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
                                    </path>
                                </svg>
                            </a>
                            <a href="{{ url('pets/' . $pet->id . '/edit') }}" class="btn btn-xs btn-outline btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z">
                                    </path>
                                </svg>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-outline btn-error btn-delete"
                                data-name="{{ $pet->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor"
                                    viewBox="0 0 256 256">
                                    <path
                                        d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                    </path>
                                </svg>
                            </a>
                            <form class="hidden" method="POST" action="{{ url('pets/' . $pet->id) }}">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">{{ $pets->links('partials.pagination') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script>
        // Messages - - -
        @if (session('message'))
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 4500
            });
        @endif

        // Delete - - -
        $('.btn-delete').click(function() {
            $name = $(this).attr('data-name')
            Swal.fire({
                title: "Are you sure?",
                text: "The Pet: " + $name + "  will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().submit();
                }
            });
        });

        // Import File - - -
        $('.btn-import').click(function(e) {
            $('#file').click()
        })
        $('#file').change(function(e) {
            $(this).parent().submit()
        })

        // Search - - - - - - - - - - - - - - - -
        function debounce(func, wait) {
            let timeout
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout)
                    func(...args)
                };
                clearTimeout(timeout)
                timeout = setTimeout(later, wait)
            }
        }
        const search = debounce(function(query) {
            $token = $('input[name=_token]').val()
            $.post("search/pets", {
                    'q': query,
                    '_token': $token
                },
                function(data) {
                    $('.datalist').html(data).hide().fadeIn(1000)
                }
            )
        }, 500)
        $('body').on('input', '#qsearch', function(event) {
            event.preventDefault()
            const query = $(this).val()
            $('.datalist').html(`<tr>
                                    <td colspan="7" class="text-center py-18">
                                        <span class="loading loading-spinner loading-xl"></span>
                                    </td>
                                </tr>`)
            if (query != '') {
                search(query)
            } else {
                setTimeout(() => {
                    window.location.replace('pets')
                }, 500)
            }
        })
    </script>
@endsection
