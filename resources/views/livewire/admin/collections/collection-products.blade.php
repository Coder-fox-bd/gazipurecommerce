<div>
    {{-- Success is as dangerous as failure. --}}
    @section('title', 'Add To')
    <h1 class="h3 mb-4 text-gray-800">Add To Collection</h1>
    @section('css') 
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    @endsection
    <style>.toast-success { background-color: #51A351; }</style>
    <style>.toast-warning { background-color: #F89406; }</style>
    @if (Session::has('success'))
      <script>
        toastr.success("{{ Session::get('success') }}");
      </script>
    @endif
    @if (Session::has('warning'))
      <script>
        toastr.warning("{{ Session::get('warning') }}");
      </script>
    @endif
    <div class="bg-white mb-4">
        <div class="row p-3">
            <div class="col-md-6">
                <div class="form-group">
                    <select wire:model="collectionId" class="form-control @error('collectionId') is-invalid @enderror" id="exampleFormControlSelect1">
                        @foreach($collections->where('status', 1) as $collection)
                        <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                        @endforeach
                    </select>
                  </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> SKU </th>
                        <th> Name </th>
                        <th class="text-center"> Brand </th>
                        <th class="text-center"> Price </th>
                        <th class="text-center"> Special Price </th>
                        <th class="text-center"> Status </th>
                    </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th> # </th>
                            <th> SKU </th>
                            <th> Name </th>
                            <th class="text-center"> Brand </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Special Price </th>
                            <th class="text-center"> Status </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <input type="checkbox" wire:click="detach({{ $product->id }})" checked>
                                </td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->brand->name }}</td>
                                <td>{{ config('settings.currency_symbol') }}{{ $product->price }}</td>
                                <td>{{ config('settings.currency_symbol') }}{{ $product->special_price }}</td>
                                <td class="text-center">
                                    @if ($product->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="col-12 d-flex justify-content-center">
            {{ $products->links() }}
        </div>  --}}
    </div>
    @section('js')
        <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    @endsection
</div>
