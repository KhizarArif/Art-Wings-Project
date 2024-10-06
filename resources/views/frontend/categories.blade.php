<section>
    {{-- <div class="container">
        <h1 class="new_arrival_title"> CATEGORIES </h1>

        <div class="tab-class text-center">
            @if ($subCategories->isNotEmpty())
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 " data-wow-delay="0.1s">
                    <li class="nav-item p-2">
                        <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill active"
                            data-bs-toggle="pill" href="#tab-1">
                            <span class="text-dark" style="width: 150px;"> All Events</span>
                        </a>
                    </li>
                    @foreach ($subCategories as $index => $subCategory)
                        <li class="nav-item p-2">
                            <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill"
                                data-bs-toggle="pill" href="#tab-{{ $index + 2 }}">
                                <span class="text-dark" style="width: 150px;"> {{ $subCategory->name }} </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                    </div>
                </div>

                @foreach ($subCategories as $index => $subCategory)
                    <div id="tab-{{ $index + 2 }}" class="tab-pane fade show p-0">
                        <div class="row g-4">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div> --}}



 

</section>
