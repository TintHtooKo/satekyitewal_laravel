<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //route to create product page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.create',compact('categories')); 
    }

    //create product
    public function create(Request $request){
        $this->checkProductValidate($request,'create');
        $product = $this->requestProductData($request);

        if($request->hasFile('image')){
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/product/',$fileName);
            $product['image'] = $fileName;
        }
        Product::create($product);
        Alert::success('Success', 'Product Added Successfully');
        return back();
    }

    //product list page
    public function productList($amt = 'default'){
        // category name ko lo chin loh tabel na khu join tr.
        $product = Product::select('categories.name as category_name','products.id','products.name','products.price','products.image','products.stock','products.category_id','products.created_at',)
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->when(request('search'),function($query){
                        $query->whereAny(['products.name','categories.name'],'like','%'.request('search').'%');
                    });
        //low stock shr tr phox query khwae yay tr
        if($amt != 'default'){
            $product = $product->where('stock','<=',3);
        }
        $product = $product->orderBy('products.created_at','desc')->paginate(5);
        return view('admin.product.list',compact('product'));
    }

    //route update page
    public function updateProductPage($id){
        $product = Product::find($id);
        $categories = Category::get();
        return view('admin.product.edit',compact('product','categories'));
    }

    //update product
    public function updateProduct(Request $request){
        $this->checkProductValidate($request,'update');
        $product = $this->requestProductData($request);
        if($request->hasFile('image')){
            if(file_exists(public_path('/product/'.$request->oldPhoto))){
                unlink(public_path('/product/'.$request->oldPhoto));
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/product/',$fileName);
            $product['image'] = $fileName;
        }else{
            $product['image'] = $request->oldPhoto;
        }

        Product::where('id',$request->productId)->update($product);
        Alert::success('Success', 'Product Updated Successfully');
        return to_route('productList');
    }

    //detail product
    public function detailProduct($id){
        $product = Product::select('categories.name as category_name','products.id','products.name','products.price','products.image','products.stock','products.category_id','products.created_at','products.description')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->find($id);
        return view('admin.product.detail',compact('product'));
    }

    // delete product
    public function deleteProduct($id){
        if(file_exists(public_path('/product/'.Product::find($id)->image))){
            unlink(public_path('/product/'.Product::find($id)->image));
        }
        Product::where('id',$id)->delete();
        Alert::success('Success', 'Product Deleted Successfully');
        return back();
    }

    // product validation
    private function checkProductValidate($request,$action){
        $rule = [
            'name' => 'required|unique:products,name,'.$request->productId,
            'categoryId' => 'required',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1|max:999',
            'description' => 'required'
        ];

        $rule['image'] = $action == 'create' ? 'required|mimes:jpeg,jpg,png,svg|file' : 'mimes:jpeg,jpg,png,svg|file';

        $request->validate($rule);
    }

    //request product data
    private function requestProductData($request){
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryId,
            'stock' => $request->stock, 
        ];
    }
}
