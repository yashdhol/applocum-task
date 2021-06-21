<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\CategoryForm;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('category/list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryData(Request $request) {
        return Datatables::of(Category::with(['parent_category', 'created_by'])->orderBy('created_at', 'desc')->get())->addColumn('image_url', function ($category) {
                    return asset('storage/category/' . $category->image);
                })->addColumn('timestamp', function ($category) {
                    return date("d-m-Y", strtotime($category->created_at));
                })->addColumn('action', function ($category) {
                    return '<a href = "' . url('category/' . $category->id . '/edit') . '" style="margin-right: 10px;" class = "btn btn-primary">Edit</a><button type="button" class ="btn btn-danger delete-category" data-id = "' . $category->id . '" style="margin-right: 10px;"> Delete</button>';
                })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categorys = Category::all();
        return view('category/form', ['categorys' => $categorys, 'title' => 'Create Category', 'button' => 'save']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryForm $request) {
        $fileNameToStore = '';
        if ($request->hasFile('image')) {
            if ($request->id) {
                $category = Category::find($request->id);
                $path = storage_path() . "/app/public/category/" . $category->image;
                if (!Storage::exists($path)) {
                    // unlink or remove previous image from folder
                    unlink($path);
                }
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->storeAs('public/category', $fileNameToStore);
        }
        $category_data = array(
            'name' => $request->name,
            'parent_id' => $request->category,
            'created_by' => Auth ::user()->id,
            'image' => $fileNameToStore
        );
        Category::updateOrCreate(['id' => $request->id], $category_data);
        $massge = $request->id ? 'Category Updated successfully.' : 'Category Added successfully.';
        return redirect('category')->with('success', $massge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Category::findOrFail($id);
        $categorys = Category::all();
        return view('category/form', ['category' => $category, 'categorys' => $categorys, 'title' => 'Update Category', 'button' => 'Update']);
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
        $data = Category::findOrFail($id);
        if ($data) {
            $path = storage_path() . "/app/public/category/" . $data->image;
            if (!Storage::exists($path)) {
                // unlink or remove previous image from folder
                unlink($path);
            }
        }
        $data->delete();
        return response()->json(['status' => 'success', 'massage' => 'Category is deleted successfully', 'data' => []], 200);
    }

}
