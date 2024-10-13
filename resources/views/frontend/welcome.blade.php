@extends('frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="hero_img_container">
            <img src="{{ asset('frontend_assets/img/heros.png') }}" alt="" class="hero_img">
        </div>
    </div>

    {{-- New Arrivals Start  --}}
    <section class="m-4">
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
                                        <img src="{{ asset('uploads/subCategory/large/' . $subcategory->subCategoryImages->first()->image) }}"
                                            class="card-img-top shop-item-image" alt="">
                                    </a>
                                    <div class="overlay">
                                        <div class="icons">
                                            <a href="javascript::void(0)">
                                                <i class="fa fa-shopping-cart" aria-hidden="true" data-toggle="tooltip"
                                                    data-placement="top" title="view details"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title shop-item-title">{{ $subcategory->name }}</h5>
                                    <p class="card-text shop-item-price w-100 d-flex justify-content-between">
                                        <span class="original-price">Rs. {{ $subcategory->price }} PKR</span>
                                        <span class="discounted-price">Rs. {{ $subcategory->price }} PKR</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>


        </div>
    </section>
    {{-- New Arrivals End --}}

    @include('frontend.categories')


    @include('frontend.featured')


@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            const $tabsToDropdown = $(".tabs-to-dropdown");
            console.log("Starts");

            function generateDropdownMarkup(container) {
                const $navWrapper = container.find(".nav-wrapper");
                const $navPills = container.find(".nav-pills");
                const firstTextLink = $navPills.find("li:first-child a").text();
                const $items = $navPills.find("li");
                const markup = `
                    <div class="dropdown d-md-none">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ${firstTextLink}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                        ${generateDropdownLinksMarkup($items)}
                        khizar
                    </div>
                    </div>
                `;
                $navWrapper.prepend(markup);
            }

            function generateDropdownLinksMarkup(items) {
                let markup = "";
                items.each(function() {
                    const textLink = $(this).find("a").text();
                    markup += `<a class="dropdown-item" href="#">${textLink}</a>`;
                });

                return markup;
            }

            function showDropdownHandler(e) {
                // works also
                //const $this = $(this);
                const $this = $(e.target);
                const $dropdownToggle = $this.find(".dropdown-toggle");
                const dropdownToggleText = $dropdownToggle.text().trim();
                const $dropdownMenuLinks = $this.find(".dropdown-menu a");
                const dNoneClass = "d-none";
                $dropdownMenuLinks.each(function() {
                    const $this = $(this);
                    if ($this.text() == dropdownToggleText) {
                        $this.addClass(dNoneClass);
                    } else {
                        $this.removeClass(dNoneClass);
                    }
                });
            }

            function clickHandler(e) {
                e.preventDefault();
                const $this = $(this);
                const index = $this.index();
                const text = $this.text();
                $this.closest(".dropdown").find(".dropdown-toggle").text(`${text}`);
                $this
                    .closest($tabsToDropdown)
                    .find(`.nav-pills li:eq(${index}) a`)
                    .tab("show");

                // Define the content for each tab
                const content = {
                    'Company': `<p>Additional content for Company.</p>`,
                    'Product': `<p>Additional content for Product.</p>`,
                    'News': `<p>Additional content for News.</p>`,
                    'Contact': `<p>Additional content for Contact.</p>`
                };

                // Append the content to the placeholder
                $('#tab-content-placeholder').html(content[text]);
            }

            function shownTabsHandler(e) {
                console.log("shownTabsHandler", e);
                // works also
                //const $this = $(this);
                const $this = $(e.target);
                const index = $this.parent().index();
                const $parent = $this.closest($tabsToDropdown);
                const $targetDropdownLink = $parent.find(".dropdown-menu a").eq(index);
                const targetDropdownLinkText = $targetDropdownLink.text();
                $parent.find(".dropdown-toggle").text(targetDropdownLinkText);
            }

            $tabsToDropdown.each(function() {
                const $this = $(this);
                const $pills = $this.find('a[data-toggle="pill"]');

                generateDropdownMarkup($this);

                const $dropdown = $this.find(".dropdown");
                const $dropdownLinks = $this.find(".dropdown-menu a");

                $dropdown.on("show.bs.dropdown", showDropdownHandler);
                $dropdownLinks.on("click", clickHandler);
                $pills.on("shown.bs.tab", shownTabsHandler);

                // Attach click handler to append content dynamically
                $pills.on("click", clickHandler);
            });
        })
    </script>

    <script></script>
@endsection
