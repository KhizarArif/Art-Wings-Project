<?php

namespace App\Http\Services;

use App\Http\Controllers\FrontController;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\ShippingCharge;
use App\Models\SubCategory;
use App\Models\SubCategoryImage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class FrontendServices
{
    public function index()
    {
        $subCatId = [];
        $subCategories = SubCategory::where([['status', "active"], ['showHome', "yes"]])->with('subCategoryImages')->get();    
        $reviews = Review::all();
        return view('frontend.welcome', compact('subCategories', 'reviews'));
    }

    public function subProducts($subcategorySlug){
        // $products = Product
        $subcategorySelected = '';
        $products = collect();
        if(!empty($subcategorySlug)){
            $productsQuery = Product::with('productImages')->where('status', "active");
            $subcategory = SubCategory::where('slug', $subcategorySlug)->first();
            if($subcategory){
                $productsQuery->where('sub_category_id', $subcategory->id);
                $subcategorySelected = $subcategory->id;
            }

            $products = $productsQuery->paginate(6);
        }

        return view('frontend.allProducts', compact('products', 'subcategorySelected'));
    }

    public function shoppingCarts()
    {
        $contentCart = Cart::content();
        return view('frontend.shoppingCart', compact('contentCart'));
    }

    public function productDetails($request, $subcategorySlug, $productSlug)
    {


        $categorySelected = "";
        $subcategorySelected = "";

        $categories = Category::with('subCategories')->orderBy("name", "asc")->where('status', "active")->get();
        $products = collect();

        if (!empty($productSlug) || !empty($subcategorySlug)) {
            $productsQuery = Product::with('productImages')->where('status', "active");

            if (!empty($subcategorySlug)) {
                $subcategory = SubCategory::where('slug', $subcategorySlug)->first();
                if ($subcategory) {
                    $productsQuery->where('sub_category_id', $subcategory->id);

                    $subcategorySelected = $subcategory->id;
                }
            }

            if (!empty($productSlug)) {
                $product = Product::where('slug', $productSlug)->first();
                if ($product) {
                    $productsQuery->where('id', $product->id);
                    $productSelected = $product->id;
                }
            }

            $products = $productsQuery->paginate(6);
        }



        return view('frontend.addToCart', compact('categories', 'products', 'categorySelected', 'subcategorySelected'));
    }

    public function addToCart($request)
    {
        $product = Product::with('productImages')->find($request->id);


        if (empty($product)) {
            return response()->json([
                "status" => false,
                "message" => "Product Not Found"
            ]);
        }

        $productImage = null;
        if (!empty($request->image_id)) {
            $productImage = $product->productImages->where('id', $request->image_id)->first();
        }

        $size = $request->input('size');
        $quantity = $request->input('quantity', 1);

        if (Cart::count() > 0) {
            $contentCart = Cart::content();
            $productAlreadyExists = false;

            foreach ($contentCart as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExists = true;
                }
            }

            if ($productAlreadyExists == false) {
                Cart::add($product->id, $product->title, $quantity, $product->price, ["productImage" => $productImage, "size" => $size]);
                $status = true;
                $message = $product->title . ' added to Cart';
            } else {
                $status = false;
                $message = $product->title . ' already added to Cart';
            }
        } else {
            Cart::add($product->id, $product->title, $quantity, $product->price, ["productImage" => $productImage, "size" => $size]);
            $status = true;
            $message = $product->title . ' added to Cart';
        }

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }

    public function deleteToCart($request)
    {
        $rowId = $request->rowId;
        $cartInfo = Cart::get($rowId);

        if ($cartInfo == null) {
            $status = false;
            $message = "Product Not Found";
            return response()->json([
                "status" => $status,
                "message" => $message
            ]);
        }

        Cart::remove($rowId);
        $status = true;
        $message = "Product Deleted Successfully!.";
        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;
        $size = $request->size;

        $cartInfo = Cart::get($rowId);
        $product = Product::find($cartInfo->id)->with('productSizes')->first();


        if($size == 'small'){
            $productSize = $product->productSizes[0]->small;
            
        }elseif($size == 'medium'){
            $productSize = $product->productSizes[0]->medium;
        }elseif($size == 'large'){
            $productSize = $product->productSizes[0]->large;
        }elseif($size == 'x_large'){
            $productSize = $product->productSizes[0]->x_large;
        }

        if ($qty <= $productSize) {
            Cart::update($rowId, $qty);
            $status = true;
            $message = "Cart Updated Successfully!.";
        } else {
            $status = false;
            $message = "Request qty ($qty) Out of Stock";
        }

        // Session::flash('success',$message);

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);
    }

    public function checkouts()
    {
        $checkoutContent = Cart::content();
        $allCities = City::all();
        return view('frontend.checkout', compact('checkoutContent', 'allCities'));
    }

    public function getShippingAmount(Request $request)
    {
        $subTotal = Cart::subtotal(2, '.', '');
        if ($request->city_id > 0) {
            $shippingInfo = ShippingCharge::where('city_id', $request->city_id)->first();

            $grandTotal = 0;

            if ($shippingInfo != null) {
                $totalShippingCharges = $shippingInfo->amount;
                $grandTotal = $subTotal  + $totalShippingCharges;

                return response()->json([
                    "status" => true,
                    "totalShippingCharges" => $totalShippingCharges,
                    "subTotal" => $subTotal,
                    "grandTotal" => $grandTotal
                ]);
            } else {
                $shippingInfo = ShippingCharge::where('city_id', "rest_of_cities")->first();
                $totalShippingCharges = $shippingInfo->amount;
                $grandTotal = $subTotal  + $totalShippingCharges;

                return response()->json([
                    "status" => true,
                    "totalShippingCharges" => $totalShippingCharges,
                    "subTotal" => $subTotal,
                    "grandTotal" => $grandTotal
                ]);
            }
        } else {

            return response()->json([
                "status" => true,
                "totalShippingCharges" => 0,
                "subTotal" => $subTotal,
                "grandTotal" => $subTotal
            ]);
        }
    }

    public function processCheckout($request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'phone'     => 'required',
            'city'    => 'required',
            'address'    => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }


        $order = new Order();
        $order->email = $request->email;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->phone = $request->phone;
        $order->shipping = $request->shippingCharge_input;
        $order->subtotal = $request->subtotal_input;
        $order->grand_total = $request->grandTotal_input;
        $order->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->name = $item->name;
            $orderItem->price = $item->price;
            $orderItem->qty = $item->qty;
            $orderItem->total = $item->price * $item->qty;

            $productData = Product::with('productImages')->with('productSizes')->find($item->id);

            if ($productData && $productData->productImages->isNotEmpty()) {
                $orderItem->product_image_id = $productData->productImages[0]->id;
            } else {
                $orderItem->product_image_id = null;
            }



            if ($productData && $productData->productSizes->isNotEmpty()) {
                if ($request->size == "small") {
                    $currentQty = $productData->productSizes[0]->small;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->productSizes[0]->small = $updatedQty;
                } elseif ($request->size == "medium") {
                    $currentQty = $productData->productSizes[0]->medium;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->productSizes[0]->medium = $updatedQty;
                } elseif ($request->size == "large") {
                    $currentQty = $productData->productSizes[0]->large;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->productSizes[0]->large = $updatedQty;
                } else {
                    $currentQty = $productData->productSizes[0]->x_large;
                    $updatedQty = $currentQty - $item->qty;
                    $productData->productSizes[0]->x_large = $updatedQty;
                }
            }

            // Update product quantity
            $productData->save();

            $orderItem->save();
        }

        Cart::destroy();
        $encryptedOrderId = Crypt::encrypt($order->id);

        return response()->json([
            'message' => 'Order Created Successfully',
            'orderId' => $encryptedOrderId,
            'status' => true,
        ]);
    }

    public function thankyou($request)
    {
        $id = decrypt($request->id);
        $order = Order::find($id);

        return view('frontend.thankyou', compact('order'));
    }

    public function subCategoryProducts($subcategoryId)
    {
        $subCategoryProducts = Product::where('sub_category_id', $subcategoryId)->get();
        return view('frontend.subCategoryProducts', compact('subCategoryProducts'));
    }

}
