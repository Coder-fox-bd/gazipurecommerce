<div>
    @if (Session::has('success'))
        <script>
        toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    @if (Session::has('errors'))
        <script>
        toastr.success("{{ Session::get('success') }}");
        </script>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form wire:submit.prevent="store" data-toggle="validator" data-disable="false" method="POST" role="form">
                            @csrf
                            <h3 class="tile-title">Attribute Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="code">Code</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="Enter attribute code"
                                        id="code"
                                        wire:model="code"
                                        value="{{ old('code') }}"
                                    />
                                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="name"
                                        wire:model="name"
                                        value="{{ old('name') }}"
                                    />
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="frontend_type">Frontend Type</label>
                                    @php $types = ['select' => 'Select Box', 'radio' => 'Radio Button', 'text' => 'Text Field', 'text_area' => 'Text Area']; @endphp
                                    <select wire:model="frontend_type" id="frontend_type" class="form-control">
                                        @foreach($types as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('frontend_type') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" id="is_filterable" wire:model="is_filterable"/>Filterable
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" id="is_required" wire:model="is_required"/>Required
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Attribute</button>
                                        <a class="btn btn-danger" href="{{ route('attributes') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
