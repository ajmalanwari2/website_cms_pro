@if(auth()->user()->hasPermissionTo($permission))
    @if($modal != '')
        <button type="button" class="btn btn-primary btn-sm form-control {{ $class }} float-end mb-3" onclick='addEditModal(@json(route($label . ".add")), @json($path), 0)'>
            <i class="bx bx-plus"></i> {{ ucfirst(str_contains($label, '_') ? substr(strrchr($label, '_'), 1) : $label) }}
        </button>
    @else
        <a href="@if(isset($newPageRoute)){{ $newPageRoute}}@endif" class="btn btn-primary btn-sm form-control {{ $class }} float-end text-white mb-3">
            <i class="bx bx-plus"></i> {{ ucfirst(str_contains($label, '_') ? substr(strrchr($label, '_'), 1) : $label) }}
        </a>
    @endif
@endif