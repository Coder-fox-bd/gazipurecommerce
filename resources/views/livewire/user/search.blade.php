<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <form action="{{ route('search-results', $search) }}">
        <div class="input-group w-100">
            <input wire:model.debounce.500ms="search" type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
            <button type="submit" class="btn search-btn">
                <i class="fa fa-search"></i>
            </button>
            </div>

            @if($results)
            <div class="container search-div position-absolute rounded form-inline bg-dark search-dropdown my-5 py-2">
                <ul class="search-ul">
                    @foreach($results as $result)
                    <li class="py-1">
                        <a class="d-inline-block font-12-px text-decoration-none search-a" href="{{ route('search-results', $result->name) }}">{{ $result->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </form>
</div>
