@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Dashboard</h2>

<a href="{{ route('incidents.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
   Submit Incident
</a>

<table class="min-w-full bg-white shadow border mt-4">
    <thead class="bg-gray-100">
        <tr class="border-b">
            <th class="px-4 py-2 text-left font-semibold">ID</th>
            <th class="px-4 py-2 text-left font-semibold">Submitted By</th>
            <th class="px-4 py-2 text-left font-semibold">Description</th>
            <th class="px-4 py-2 text-left font-semibold">Status</th>
            <th class="px-4 py-2 text-left font-semibold">Image</th>
            <th class="px-4 py-2 text-left font-semibold">Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($incidents as $i)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $i->id }}</td>
            <td class="px-4 py-2">{{ $i->user->name ?? '—' }}</td>
            <td class="px-4 py-2">{{ $i->description }}</td>
            <td class="px-4 py-2">{!! status_badge($i->status) !!}</td>
            <td class="px-4 py-2">
                @if($i->image_path)
                    <img src="{{ $i->image_path }}" class="w-20 h-auto rounded">
                @else
                    <span class="text-gray-400 text-sm">None</span>
                @endif
            </td>
            <td class="px-4 py-2 space-x-2">

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('incidents.editStatus', $i->id) }}"
                       class="bg-yellow-500 text-black px-3 py-1 rounded hover:bg-yellow-600">
                       Edit Status
                    </a>

                    <form action="{{ route('incidents.destroy', $i->id) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Delete this incident?');">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $incidents->links() }}
</div>
@endsection
