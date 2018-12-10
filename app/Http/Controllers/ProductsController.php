<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){

        //get products
        $products = Product::paginate(15);

        //return collection of products
        return ProductResource::collection($products);

    }

    public function show($id){
        // get product
        $product = Product::findOrFail($id);

        return new ProductResource($product);
    }

    public function store(Request $request){

        $this->validate($request, [
            'product_name' => 'bail|required|max:255',
            'product_description' => 'bail|required',
        ]);
        
        $product = Product::create($request->all());
        
        return new ProductResource($product);        
    }

    public function update($id, Request $request) {
        
        //validate request parameters
        $this->validate($request, [
            'product_name' => 'max:255',
        ]);
        
        //Return error 404 response if product was not found
        if(!Product::findOrFail($id)) return response('product not found!', 404);

        $product = Product::findOrFail($id)->update($request->all());
        if($product){
            //return updated data
            return new ProductResource(Product::findOrFail($id)); 
        }
        //Return error 400 response if updated was not successful        
        return response('Failed to update product!', 400);
    }

    public function destroy($id){
        $product = Product::findOrFail($id);

        if($product->delete()){
            return response('Product deleted successfully!', 410);
        }

    }
}
