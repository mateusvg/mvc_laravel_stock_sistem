<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // create a new product
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->price = $request->price;

        // convert image and change extention an image name
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $requestImage = $request->img;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // save the image on folder and server
            $requestImage->move(public_path('img/products'), $imageName);
            $product->img = $imageName;
        }

        // Save on db
        $product->save();

        return redirect()->route('products.create')->with('success', 'Product successfully created');
    }

    public function showAll()
    {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

    public function edit($id)
    {
        // Search for product id
        $product = Product::find($id);

        // Verify if product exists
        if (!$product) {
            abort(404, 'Produto não encontrado');
        }

        // Retorna a view de edição com o produto encontrado
        return view('products.edit', ['product' => $product]);
    }


    public function update(Request $request, $id)
    {
        // Search for product
        $product = Product::findOrFail($id);

        // Log the ID
        Log::info('Product ID: ' . $id);

        // Update data for this product
        $product->name = $request->name;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->price = $request->price;

        // Save changes to DB
        $product->save();

        // Redirect to a relevant route
        return redirect()->route('products.index')->with('success', 'Product successfully updated!');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $record = Product::find($id);

        if (!$record) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        // Optionally, ask for confirmation
        // Implement your confirmation logic here

        $record->delete();

        return redirect()->route('products.index')->with('success', 'Product successfully deleted!');
    }
}
