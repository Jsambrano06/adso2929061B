@extends('layouts.app')

@section('title', 'Larapets: My Adoptions')

@section('content')
    @include('partials.navbar')
    <h1 class="mt-6 text-4xl text-white flex gap-2 items-center justify-center pb-4 border-b-2 border-neutral-50 mb-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="size-12" fill="currentColor" viewBox="0 0 256 256">
            <path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"></path>
        </svg>
        My Adoptions
    </h1>

    <div class="flex flex-col gap-4 justify-center items-center">
        {{-- Search --}}
        <label class="input text-white bg-[#0009] w-44 md:w-84 outline outline-white mb-10">
            <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none" stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </g>
            </svg>
            <input type="search" placeholder="Search..." name="qsearch" id="qsearch" />
        </label>
    </div>

    <div class="datalist flex flex-col gap-4 items-center justify-center">
        @forelse ($adoptions as $adoption)
            <div class="avatar-group mt-2 -space-x-6">
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
            <h4 class="text-white">
                <span class="underline font-bold">{{ $adoption->pet->name ?? 'N/A' }}</span>
                was adopted by
                <span class="underline font-bold">{{ $adoption->user->fullname ?? 'N/A' }}</span>
                {{ $adoption->created_at->diffForHumans() }}
            </h4>
            <a href="{{ url('myadoption/'.$adoption->id) }}" class="btn btn-outline text-white hover:bg-[#fff6] hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M152,112a8,8,0,0,1-8,8H120v24a8,8,0,0,1-16,0V120H80a8,8,0,0,1,0-16h24V80a8,8,0,0,1,16,0v24h24A8,8,0,0,1,152,112Zm77.66,117.66a8,8,0,0,1-11.32,0l-50.06-50.07a88.11,88.11,0,1,1,11.31-11.31l50.07,50.06A8,8,0,0,1,229.66,229.66ZM112,184a72,72,0,1,0-72-72A72.08,72.08,0,0,0,112,184Z"></path>
                </svg>
                Show more
            </a>
            <span class="border-b-1 border-dashed mt-2 border-[#fff6] h-2 w-12/12"></span>
        @empty
            <div class="alert alert-info w-full max-w-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>You haven't made any adoptions yet.</span>
            </div>
        @endforelse
    </div>

    @if(method_exists($adoptions, 'links') && $adoptions->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $adoptions->links('partials.pagination') }}
        </div>
    @endif
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

    @if(session('error'))
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error",
            text: "{{ session('error') }}",
            showConfirmButton: true,
            timer: 3500
        });
    @endif

    let timeout;
    $('#qsearch').on('keyup', function() {
        let query = $(this).val();
        clearTimeout(timeout);

        if(query.length >= 2) {
            timeout = setTimeout(function() {
                $.ajax({
                    url: "{{ url('search/adoptions') }}",
                    type: "POST",
                    data: {
                        q: query,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('.datalist').html(response);
                    },
                    error: function() {
                        $('.datalist').html('<div class="text-center py-8 text-red-500">Error searching</div>');
                    }
                });
            }, 500);
        } else if(query.length === 0) {
            location.reload();
        }
    });
</script>
@endsection
