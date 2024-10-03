@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="hero_img_container">
            <img src="{{ asset('frontend_assets/img/heros.png') }}" alt="" class="hero_img">
        </div>
    </div>

    {{-- New Arrivals Start  --}}
    <section class="mx-3">
        <h1 class="new_arrival_title"> New Arrivals</h1>
        <div class="contianer">

            <div class="row row-cols-2 row-cols-md-3 g-4" id="product-list">
                @if ($subCategories != null)
                    @foreach ($subCategories as $subcategory)
                        <div
                            class="col-md-3 col-sm-6 col-xs-12 filter-item all new d-flex flex-column justify-content-between">
                            <div class="card border border-2">
                                <div class="img-container position-relative">
                                    <a href="javascript::void(0)">
                                        <img src="{{ asset('uploads/subCategory/large/'.$subcategory->subCategoryImages->first()->image) }}"
                                            class="card-img-top shop-item-image" alt="">
                                    </a>
                                    <div class="overlay"> 
                                        <div class="icons"> 
                                                <i class="fa fa-eye" aria-hidden="true"  data-toggle="tooltip" data-placement="top"
                                                title="view details"></i> 
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="card-body d-flex flex-column">
                                    <h5 class="card-title shop-item-title"></h5>
                                    <p class="card-text shop-item-price w-100 d-flex justify-content-between">
                                        <span class="original-price">Rs. {{ $subcategory->price }} PKR</span>
                                        <span class="discounted-price">Rs. PKR</span>
                                    </p>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>


        </div>
    </section>
    {{-- New Arrivals End --}}
@endsection
