<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Models\ProductVariant;


class ProductController extends Controller
{
    /**
     * Display the product creation form.
     */

     public function index()
     {
         $products = Product::with(['category', 'variants'])->get();
         return view('product_management', compact('products'));
     }


    public function create()
    {
        $categories = Category::all();
        return view('add_products', compact('categories'));
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // Log request data
        Log::info('Raw Request Data:', $request->all());

        // Validate input
        $validatedData = $request->validate([
            'product_code' => 'required|unique:products,product_code|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
        ]);


        Log::info('Validated Data:', $validatedData);

        $product = Product::create($validatedData);

        return redirect()->route('product.variants.create', ['productId' => $product->product_id]);

    }

    public function storeVariant(Request $request, $productId)
{
    $validated = $request->validate([
        'size' => 'nullable|string',
        'color' => 'nullable|string',
        'height' => 'nullable|numeric',
        'weight' => 'nullable|numeric',
        'width' => 'nullable|numeric',
        'dimensions' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'sku' => 'required|string|unique:product_variants',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure correct column name
    ]);

    $product = Product::findOrFail($productId);

    // Handle image upload correctly
    if ($request->hasFile('image_url')) { // Ensure input name is correct
        $imagePath = $request->file('image_url')->store('variants', 'public');
        $validated['image_url'] = $imagePath; // Assign correctly to image_url
    }

    // Explicitly set the correct foreign key
    $validated['product_id'] = $productId;

    // Save the variant
    ProductVariant::create($validated);

    return redirect()->route('products')->with('success', 'Variant added successfully!');
}


    public function showProductForm($productId)
{
    $product = Product::findOrFail($productId);
    return view('product_variants', compact('product'));
}


public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Delete related variants
    $product->variants()->delete();
    $product->delete();

    return redirect()->route('products')->with('success', 'Product deleted successfully!');
}




}
