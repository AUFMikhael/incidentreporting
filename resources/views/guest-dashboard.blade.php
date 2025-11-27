@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Guest Dashboard</h2>

<table class="min-w-full bg-white shadow border">
    <thead class="bg-gray-100">
        <tr class="border-b">
            <th class="px-4 py-2 text-left font-semibold">ID</th>
            <th class="px-4 py-2 text-left font-semibold">Description</th>
            <th class="px-4 py-2 text-left font-semibold">Status</th>
            <th class="px-4 py-2 text-left font-semibold">Image</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($incidents as $i)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $i->id }}</td>
            <td class="px-4 py-2">{{ $i->description }}</td>
            <td class="px-4 py-2">{!! status_badge($i->status) !!}</td>
            <td class="px-4 py-2">
                @if($i->image_path)
                    <img src="{{ $i->image_path }}" class="w-20 h-auto rounded">
                @else
                    <span class="text-gray-400 text-sm">None</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
