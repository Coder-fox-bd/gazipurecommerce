<div>
    {{-- Do your work, then step back. --}}
    <h2>Link A Product or Product Collection</h2>
    <br>
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    <!-- Nav tabs -->
    <ul wire:ignore class="nav nav-tabs" role="tablist">
        <li class="nav-item">
        <a wire:click="resetWire()" class="nav-link active" data-toggle="tab" href="#product">A Product</a>
        </li>
        <li class="nav-item">
        <a wire:click="resetWire()" class="nav-link" data-toggle="tab" href="#collection">Product Collection</a>
        </li>
    </ul>
    
    <!-- Tab panes -->
    <div style="min-height: 150px">
        <div wire:ignore class="tab-content">
            <div id="product" class="tab-pane active"><br>
                <div class="input-group">
                    <input type="text" wire:model.debounce.500ms="search" class="form-control bg-light border-0 small"
                        placeholder="Search for product" aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="collection" class="tab-pane fade"><br>
                <div class="form-group">
                    <select wire:model="collectionSlug" class="form-control" id="exampleFormControlSelect1">
                        <option selected>Choose Collection Name</option>
                        @foreach($collections->where('status', 1) as $collection)
                        <option value="offers/{{ $collection->slug }}">{{ $collection->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                @foreach ($products as $product)
                <div class="custom-control custom-radio">
                    <input wire:model="productSlug" type="radio" id="customRadio{{ $product->id }}" value="product/{{ $product->slug }}" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio{{ $product->id }}">
                        {{ $product->name }}<strong>Price-{{ $product->price }}-Special price-{{ $product->special_price }}</strong>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @if($url)
        <h5><a href="/{{ $url }}" target="_blank">{{ config('app.url') }}/{{ $url }}</a></h5>
        @endif
    </div>
    <h5 style="color: red;">{{ $message }}</h5>
    <form wire:submit.prevent="save(Object.fromEntries(new FormData($event.target)))">
        @csrf
        <div wire:ignore>
            <input type="hidden" id="carousel-id" name="carouselId">
        </div>
        <div class="tile-footer">
            <button class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Brand</button>
            &nbsp;&nbsp;&nbsp;
            <a wire:click.prevent="resetWire()" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
        </div>
    </form>
</div>
