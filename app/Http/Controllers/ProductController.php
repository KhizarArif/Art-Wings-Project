<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductServices;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productServices;
    public function __construct(ProductServices $productServices){
        $this->productServices = $productServices;
    }

    public function index(){
        return $this->productServices->index();
    }
    public function create(){
        return $this->productServices->create();
    }
    public function store(Request $request){
        return $this->productServices->store($request);
    }
    public function edit(Request $request){
        return $this->productServices->edit($request);
    }
    public function updateProductImage(Request $request){
        return $this->productServices->updateProductImage($request);
    }
    public function deleteProductImage(Request $request){
        return $this->productServices->deleteProductImage($request);
    }
    public function destroy($id){
        return $this->productServices->destroy($id);
    }
}
    