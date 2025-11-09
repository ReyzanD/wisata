<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Category;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::with('category')->latest()->get();
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('destinations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_232136' => 'required|string|max:255',
            'description_232136' => 'nullable|string',
            'category_id_232136' => 'nullable|exists:categories_232136,id',
            'location_232136' => 'nullable|string|max:255',
            'image_232136' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_232136')) {
            $image = $request->file('image_232136');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('destinations', $imageName, 'public');
            $data['image_232136'] = $imageName;
        }

        Destination::create($data);

        return redirect()->route('destinations.index')
            ->with('success', 'Destinasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $destination = Destination::with(['category', 'galleries', 'reviews'])->findOrFail($id);
        return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $destination = Destination::findOrFail($id);
        $categories = Category::all();
        return view('destinations.edit', compact('destination', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_232136' => 'required|string|max:255',
            'description_232136' => 'nullable|string',
            'category_id_232136' => 'nullable|exists:categories_232136,id',
            'location_232136' => 'nullable|string|max:255',
            'image_232136' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $destination = Destination::findOrFail($id);
        $data = $request->except('image_232136');

        if ($request->hasFile('image_232136')) {
            // Delete old image if exists
            if ($destination->image_232136) {
                \Storage::disk('public')->delete('destinations/' . $destination->image_232136);
            }

            $image = $request->file('image_232136');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('destinations', $imageName, 'public');
            $data['image_232136'] = $imageName;
        }

        $destination->update($data);

        return redirect()->route('destinations.index')
            ->with('success', 'Destinasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::findOrFail($id);

        // Delete image if exists
        if ($destination->image_232136) {
            \Storage::disk('public')->delete('destinations/' . $destination->image_232136);
        }

        $destination->delete();

        return redirect()->route('destinations.index')
            ->with('success', 'Destinasi berhasil dihapus.');
    }
}
