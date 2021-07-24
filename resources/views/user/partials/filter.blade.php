<aside class="col-md-3">
                    
    <div class="right-border">
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Product type</h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_1">
                <div class="card-body">
                    <form class="pb-3">
                    <div class="input-group">
                    <input type="text" wire:model="searched" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-light" type="button"><i class="fa fa-search"></i></button>
                    </div>
                    </div>
                    </form>
                    
                    {{-- <ul class="list-menu">
                    <li><a href="#">People  </a></li>
                    <li><a href="#">Watches </a></li>
                    <li><a href="#">Cinema  </a></li>
                    <li><a href="#">Clothes  </a></li>
                    <li><a href="#">Home items </a></li>
                    <li><a href="#">Animals</a></li>
                    <li><a href="#">People </a></li>
                    </ul> --}}

                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group  .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Brands </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_2" >
                <div class="card-body">
                    @foreach($brands as $brand)
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox"  value="{{ $brand->id }}" wire:model="selectedbrands.{{ $brand->id }}" class="custom-control-input">
                        <div class="custom-control-label">{{ $brand->name }}  
                            <b class="badge badge-pill badge-light float-right">{{ $brand->products->count() }}</b>  </div>
                        </label>
                    @endforeach
                </div> <!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Price range </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_3">
                <div class="card-body">
                    <form wire:submit.prevent="priceRange(Object.fromEntries(new FormData($event.target)))">
                        @csrf
                        <input type="range" class="custom-range" min="0" max="100000" value="30000" name="" oninput="updateTextInput(this.value);">
                        <div class="form-row">
                        <div class="form-group col-md-6">
                        <label>Min</label>
                        <input type="number"  name="priceFrom" value="0" class="form-control">
                        </div>
                        <div class="form-group text-right col-md-6">
                        <label>Max</label>
                        <input type="number" name="priceTo" value="30000" class="form-control" id="range-output">
                        </div>
                        </div> <!-- form-row.// -->
                        <button type="submit" class="btn square_btn_5 btn-block cursor-pointer">Apply</button>
                    </form>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
        {{-- <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">Sizes </h6>
                </a>
            </header>
            <div class="filter-content collapse show" id="collapse_4" >
                <div class="card-body">
                <label class="checkbox-btn">
                    <input type="checkbox">
                    <span class="btn btn-light"> XS </span>
                </label>

                <label class="checkbox-btn">
                    <input type="checkbox">
                    <span class="btn btn-light"> SM </span>
                </label>

                <label class="checkbox-btn">
                    <input type="checkbox">
                    <span class="btn btn-light"> LG </span>
                </label>

                <label class="checkbox-btn">
                    <input type="checkbox">
                    <span class="btn btn-light"> XXL </span>
                </label>
            </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// --> --}}
        <article class="filter-group">
            <header class="card-header">
                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false">
                    <i class="icon-control fa fa-chevron-down"></i>
                    <h6 class="title">More filter </h6>
                </a>
            </header>
            <div class="filter-content collapse in" id="collapse_5" >
                <div class="card-body">
                    <label class="custom-control custom-radio">
                    <input type="radio" name="myfilter_radio" checked="" class="custom-control-input">
                    <div class="custom-control-label">Any condition</div>
                    </label>

                    <label class="custom-control custom-radio">
                    <input type="radio" name="myfilter_radio" class="custom-control-input">
                    <div class="custom-control-label">Brand new </div>
                    </label>

                    <label class="custom-control custom-radio">
                    <input type="radio" name="myfilter_radio" class="custom-control-input">
                    <div class="custom-control-label">Used items</div>
                    </label>

                    <label class="custom-control custom-radio">
                    <input type="radio" name="myfilter_radio" class="custom-control-input">
                    <div class="custom-control-label">Very old</div>
                    </label>
                </div><!-- card-body.// -->
            </div>
        </article> <!-- filter-group .// -->
    </div> <!-- card.// -->

</aside> <!-- col.// -->