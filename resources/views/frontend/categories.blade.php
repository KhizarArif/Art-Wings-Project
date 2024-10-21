<section>
    <div class="container">
        <h1 class="new_arrival_title"> CATEGORIES </h1>

        <div class="container">
            <div class="tabs-to-dropdown">
                <div class="nav d-flex align-items-center justify-content-center">
                    <ul class="nav nav-pills d-none d-md-flex text-center" id="pills-tab" role="tablist">
                        @if ($subCategories != null)
                            @foreach ($subCategories as $subcategory)
                                <li class="category_container" role="presentation"
                                    onclick="filterCategories('{{ $subcategory->id }}')">
                                    <a class=" p-0" id="pills-{{ $subcategory->id }}-tab" data-toggle="pill"
                                        href="javascript:void(0)" role="tab"
                                        aria-controls="pills-{{ $subcategory->id }}" aria-selected="true">
                                    </a>
                                    <h6 class="m-0"> {{ $subcategory->name }} </h6>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div class="tab-content" id="pills-tabContent"></div>
            </div>
        </div>
    </div>

</section>
