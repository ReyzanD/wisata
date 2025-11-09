<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Destination;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with('destination')->latest()->get();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = Destination::all();
        return view('galleries.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_232136' => 'required|string|max:255',
            'url_232136' => 'nullable|url|max:255',
            'image_232136' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_id_232136' => 'nullable|exists:destinations_232136,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_232136')) {
            $image = $request->file('image_232136');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('galleries', $imageName, 'public');
            $data['image_232136'] = $imageName;
        }

        Gallery::create($data);

        return redirect()->route('galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::with('destination')->findOrFail($id);
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        $destinations = Destination::all();
        return view('galleries.edit', compact('gallery', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title_232136' => 'required|string|max:255',
            'url_232136' => 'nullable|url|max:255',
            'image_232136' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_id_232136' => 'nullable|exists:destinations_232136,id',
        ]);

        $gallery = Gallery::findOrFail($id);
        $data = $request->except('image_232136');

        if ($request->hasFile('image_232136')) {
            // Delete old image if exists
            if ($gallery->image_232136) {
                \Storage::disk('public')->delete('galleries/' . $gallery->image_232136);
            }

            $image = $request->file('image_232136');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('galleries', $imageName, 'public');
            $data['image_232136'] = $imageName;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete image if exists
        if ($gallery->image_232136) {
            \Storage::disk('public')->delete('galleries/' . $gallery->image_232136);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}
