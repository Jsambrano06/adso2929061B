@forelse ($pets as $pet)
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                </a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-8 text-white">
            No se encontraron mascotas que coincidan con la búsqueda
        </td>
    </tr>
@endforelse

@if($pets->hasPages())
    <tr>
        <td colspan="6" class="px-4 py-3 text-center">
            @if(isset($q) && $q)
                {{ $pets->appends(['q' => $q])->links('partials.pagination') }}
            @else
                {{ $pets->links('partials.pagination') }}
            @endif
        </td>
    </tr>
@endif
