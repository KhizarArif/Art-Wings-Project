<section>
    <div class="container">
        <h1 class="new_arrival_title"> FEATURED PRODUCT</h1>

        @if ($featuredProducts->count() > 0)
            @foreach ($featuredProducts as $item)
                <form action="" id="featuredProductForm">
                    @csrf
                    <div class="row">
                    <div class="product_container">
                            <!-- Product Image -->
                            <div class="featured_product_image col-md-6">
                                <img src="{{ asset('uploads/featured/' . $item->image) }}" alt="{{ $item->name }}">
                            </div>

                            <!-- Product Details -->
                            <div class="product_details col-md-6">
                                <h1 class="product_title">{{ $item->name }}</h1>
                                <p class="featured_price">Rs.{{ number_format($item->price) }}</p>
                                <p class="product-description">
                                    {{ $item->description }}
                                </p>

                                <div class="mt-4 d-flex align-items-end justify-content-between">
                                    <div class="col-md-4 p-0">
                                        <div class="input-group quantity border border-1 justify-content-between rounded">
                                            <button class="btn btn-outline-none border border-none  btn-bold"
                                                type="button" id="decrement-btn"><i class="fa fa-minus"
                                                    aria-hidden="true"></i></button>
                                            <input type="text" class="quantity_value" id="quantity-input"
                                                name="quantity" value="1">
                                            <button class="btn btn-outline-none border border-none  btn-bold "
                                                type="button" id="increment-btn"><i class="fa fa-plus"
                                                    aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button class="btn btn-dark btn-lg btn-bold border-1 rounded w-50 " type="submit"
                                        title="Add To Cart">Add To Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        @endif



    </div>
</section>
