@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Submit New Incident</h2>

<form method="POST" action="{{ route('incidents.store') }}" enctype="multipart/form-data">
    @csrf

    <label>Description</label>
    <textarea name="description" class="border p-2 w-full" required></textarea>

    <label class="mt-3 block">Image (optional)</label>
    <input type="file" name="image" class="border p-2 w-full">

    <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">Submit</button>
</form>
@endsection
