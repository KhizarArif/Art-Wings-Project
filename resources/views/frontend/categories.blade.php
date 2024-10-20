<section>
    <div class="container">
        <h1 class="new_arrival_title"> CATEGORIES </h1>

        <div class="container">
            <div class="tabs-to-dropdown">
                <div class="nav d-flex align-items-center justify-content-center">
                    <ul class="nav nav-pills d-none d-md-flex text-center" id="pills-tab" role="tablist">
                        @if ($subCategories != null)
                            @foreach ($subCategories as $subcategory)
                                <li class="category_container" role="presentation">
                                    <a class=" p-0" id="pills-{{ $subcategory->id }}-tab" data-toggle="pill"
                                        href="#pills-{{ $subcategory->id }}" role="tab"
                                        aria-controls="pills-{{ $subcategory->id }}" aria-selected="true">
                                    </a>
                                    <h6 class="m-0"> {{ $subcategory->name }} </h6>
                                </li>
                            @endforeach
                        @endif
                    </ul>

                </div>

                <div class="tab-content" id="pills-tabContent">
                    @foreach ($subCategories as $subcategory)
                        <div class="tab-pane fade show active" id="pills-{{ $subcategory->id }}" role="tabpanel"
                            aria-labelledby="pills-{{ $subcategory->id }}-tab">
                            <div class="container-full mb-3">
                                <div class="row">
                                    @foreach ($subcategory->subCategoryImages as $subImage)
                                        <div
                                            class="col-md-4 col-lg-3 col-sm-6 col-xs-12 filter-item all new d-flex flex-column justify-content-between">
                                            <div class="card border border-2">
                                                <div class="img-container position-relative">
                                                    <a href="javascript::void(0)">
                                                        <img src="{{ asset('uploads/subCategory/large/' . $subImage->image) }}"
                                                            class="card-img-top shop-item-image" alt="">
                                                    </a>
                                                    <div class="overlay">
                                                        <div class="icons">
                                                            <a
                                                                href="{{ route('frontend.subProducts', $subcategory->slug) }}">
                                                                <i class="fa fa-eye" aria-hidden="true"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="view details"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title shop-item-title">{{ $subcategory->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div id="tab-content-placeholder" class="mt-4"></div>

        </div>


    </div>





</section>
