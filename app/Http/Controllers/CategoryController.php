<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

// HomeController - Move this to separate file: app/Http/Controllers/HomeController.php
/*
use App\Models\Destination;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::with(['category', 'galleries'])
            ->latest()
            ->take(6)
            ->get();
        
        $categories = Category::withCount('destinations')->get();
        
        return view('public.home', compact('featuredDestinations', 'categories'));
    }

    public function destinations(Request $request)
    {
        $query = Destination::with(['category', 'galleries']);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_232136', 'like', "%{$search}%")
                  ->orWhere('location_232136', 'like', "%{$search}%")
                  ->orWhere('description_232136', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('category')) {
            $query->where('category_id_232136', $request->category);
        }
        
        $destinations = $query->paginate(12);
        $categories = Category::all();
        
        return view('public.destinations', compact('destinations', 'categories'));
    }

    public function show($id)
    {
        $destination = Destination::with(['category', 'galleries', 'reviews'])
            ->findOrFail($id);
        
        $relatedDestinations = Destination::with(['category', 'galleries'])
            ->where('category_id_232136', $destination->category_id_232136)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();
        
        return view('public.destination-detail', compact('destination', 'relatedDestinations'));
    }
}
*/

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('destinations')->latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_232136' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('destinations')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name_232136' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
