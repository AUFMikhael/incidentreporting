@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Incident Status</h2>

<form method="POST" action="{{ route('incidents.updateStatus', $incident->id) }}">
    @csrf

    <label>Status</label>
    <select name="status" class="border p-2 w-full">
        <option value="to_be_fixed" {{ $incident->status === 'to_be_fixed' ? 'selected' : '' }}>To Be Fixed</option>
        <option value="fixing" {{ $incident->status === 'fixing' ? 'selected' : '' }}>Fixing</option>
        <option value="fixed" {{ $incident->status === 'fixed' ? 'selected' : '' }}>Fixed</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Update Status</button>
</form>
@endsection
