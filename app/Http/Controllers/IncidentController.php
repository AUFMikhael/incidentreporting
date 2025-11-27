<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\Storage;

class IncidentController extends Controller
{
    public function create()
    {
        return view('incidents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // Upload to Azure Blob
            Storage::disk('azure')->put($fileName, file_get_contents($file));

            $imagePath = rtrim(config('filesystems.disks.azure.url'), '/') . '/' . $fileName;
        }

        Incident::create([
            'submitter' => auth()->id(),
            'description' => $request->description,
            'status' => 'to_be_fixed',
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Incident submitted.');
    }

    public function editStatus($id)
    {
        $incident = Incident::findOrFail($id);
        return view('incidents.edit-status', compact('incident'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:to_be_fixed,fixing,fixed',
        ]);

        $incident = Incident::findOrFail($id);
        $incident->status = $request->status;
        $incident->save();

        return redirect()->route('dashboard')->with('success', 'Incident status updated.');
    }

    // Optional: admin-only delete
    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);

        // If there's an image in Azure, remove it
        if ($incident->image_path) {
            // derive filename from stored URL (assumes format configured earlier)
            $url = $incident->image_path;
            $fileName = basename(parse_url($url, PHP_URL_PATH));
            Storage::disk('azure')->delete($fileName);
        }

        $incident->delete();

        return redirect()->route('dashboard')->with('success', 'Incident deleted.');
    }
}
