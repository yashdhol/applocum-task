<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductForm;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('products/list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productData(Request $request) {
        return Datatables::of(Product::with(['category', 'created_by'])->orderBy('created_at', 'desc')->get())->addColumn('image_url', function ($products) {
                    return asset('storage/product/' . $products->image);
                })->addColumn('timestamp', function ($products) {
                    return date("d-m-Y", strtotime($products->created_at));
                })->addColumn('action', function ($products) {
                    return '<a href = "' . url('products/' . $products->id . '/edit') . '" style="margin-right: 10px;" class = "btn btn-primary">Edit</a><button type="button" class ="btn btn-danger delete-products" data-id = "' . $products->id . '" style="margin-right: 10px;"> Delete</button>';
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $category = Category::all();
        return view('products/form', ['category' => $category, 'title' => 'Create Product', 'button' => 'save']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductForm $request) {
        $fileNameToStore = '';
        if ($request->hasFile('image')) {
            if ($request->id) {
                $Product = Product::find($request->id);
                $path = storage_path() . "/app/public/product/" . $Product->image;
                if (!Storage::exists($path)) {
                    // unlink or remove previous image from folder
                    unlink($path);
                }
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->storeAs('public/product', $fileNameToStore);
        }
        $category_data = array(
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'created_by' => Auth::user()->id,
            'image' => $fileNameToStore
        );
        Product::updateOrCreate(['id' => $request->id], $category_data);
        $massge = $request->id ? 'Product Updated successfully.' : 'Product Added successfully.';
        return redirect('products')->with('success', $massge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $products = Product::findOrFail($id);
        $category = Category::all();
        return view('products/form', ['products' => $products, 'category' => $category, 'title' => 'Update Product', 'button' => 'Update']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $data = Product::findOrFail($id);
        if ($data) {
            $path = storage_path() . "/app/public/product/" . $data->image;
            if (!Storage::exists($path)) {
                // unlink or remove previous image from folder
                unlink($path);
            }
        }
        $data->delete();
        return response()->json(['status' => 'success', 'massage' => 'Product is deleted successfully', 'data' => []], 200);
    }

}
