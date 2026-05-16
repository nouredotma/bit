<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:2000',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnail_images' => 'nullable|array|max:4',
            'thumbnail_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sizes_available' => 'nullable|string',
            'colors_available' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image uploads
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        }

        if ($request->hasFile('thumbnail_images')) {
            $thumbnails = [];
            foreach ($request->file('thumbnail_images') as $file) {
                $thumbnails[] = $file->store('products', 'public');
            }
            $validated['thumbnail_images'] = $thumbnails;
        }

        // Convert comma-separated strings to arrays
        if ($request->filled('sizes_available')) {
            $validated['sizes_available'] = array_map('trim', explode(',', $request->sizes_available));
        }
        if ($request->filled('colors_available')) {
            $validated['colors_available'] = array_map('trim', explode(',', $request->colors_available));
        }

        // Ensure unique slug
        $count = Product::where('slug', $validated['slug'])->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string|max:2000',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'thumbnail_images' => 'nullable|array|max:4',
            'thumbnail_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sizes_available' => 'nullable|string',
            'colors_available' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image uploads
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        } else {
            // Keep existing main_image if no new file is uploaded
            $validated['main_image'] = $product->getRawOriginal('main_image');
        }

        if ($request->hasFile('thumbnail_images')) {
            $existing_thumbnails = json_decode($product->getRawOriginal('thumbnail_images'), true) ?? [];
            $thumbnails = $existing_thumbnails;

            foreach ($request->file('thumbnail_images') as $file) {
                if (count($thumbnails) < 4) {
                    $thumbnails[] = $file->store('products', 'public');
                }
            }
            $validated['thumbnail_images'] = $thumbnails;
        } else {
            // Keep existing thumbnail_images if no new files are uploaded
            $validated['thumbnail_images'] = json_decode($product->getRawOriginal('thumbnail_images'), true) ?? [];
        }

        // Convert comma-separated strings to arrays
        if ($request->filled('sizes_available')) {
            $validated['sizes_available'] = array_map('trim', explode(',', $request->sizes_available));
        } else {
            $validated['sizes_available'] = [];
        }
        if ($request->filled('colors_available')) {
            $validated['colors_available'] = array_map('trim', explode(',', $request->colors_available));
        } else {
            $validated['colors_available'] = [];
        }

        // Ensure unique slug (exclude current product)
        $count = Product::where('slug', $validated['slug'])->where('id', '!=', $id)->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function destroyThumbnail($id, $index)
    {
        $product = Product::findOrFail($id);
        $thumbnails = json_decode($product->getRawOriginal('thumbnail_images'), true) ?? [];

        if (isset($thumbnails[$index])) {
            // Optionally delete from storage here if desired:
            // \Illuminate\Support\Facades\Storage::disk('public')->delete($thumbnails[$index]);
            
            unset($thumbnails[$index]);
            // Re-index array
            $thumbnails = array_values($thumbnails);
            
            $product->update([
                'thumbnail_images' => empty($thumbnails) ? null : $thumbnails
            ]);
        }

        return redirect()->back()->with('success', 'Thumbnail deleted successfully.');
    }
}
