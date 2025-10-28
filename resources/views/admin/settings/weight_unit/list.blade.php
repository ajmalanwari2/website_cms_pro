<div id="item-total-count-hidden" style="display: none;">{{$allWeightUnits->total()}}</div>
<table class="table table-bordered fs-13">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%;" class="text-center">#</th>
            <th >{{ __('global.name') }}</th>
            <th style="width: 5%;" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @if ($allWeightUnits->isNotEmpty())
            @php $counter = ($allWeightUnits->currentPage() - 1) * $allWeightUnits->perPage() + 1; @endphp
            @foreach ($allWeightUnits as $weightUnit)
                <tr id="tr-{{$counter}}">
                    <th class="text-center">{{ $counter }}</th>
                    <td>
                        <span id="v-name-{{ $weightUnit->id }}" class="v-section">{{ $weightUnit->name }}</span>
                        <input type="text" id="name" name="r_name" value="{{ $weightUnit->name }}" class="form-control e-section d-none">
                    </td>
                    <td class="text-center text-nowrap">
                    <button class="btn btn-outline-primary btn-sm v-section action-btn" onclick="toggleEdit({{ $counter }}, true);">
                        <i class="fa fa-pen fs-15"></i>
                    </button>
                    <button class="btn btn-outline-success btn-sm e-section d-none action-btn" title="{{ __('global.edit') }}" onclick="updateWeightUnit({{ $counter }}, '{{ $weightUnit->id }}');">
                        <i class="fa fa-check-circle fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm d-none e-section action-btn" title="{{ __('global.cancel') }}" onclick="toggleEdit({{ $counter }}, false);">
                        <i class="fa fa-times-circle fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm spinner-btn d-none action-btn" title="{{ __('global.spinner') }}">
                        <i class="fas fa-2x fa-sync fa-spin fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm v-section deleteBtn action-btn" data-id="{{ encryption($weightUnit->id) }}" data-url="deletes_weight_unit_route" data-toggle="tooltip" title="{{ __('global.delete') }}">
                        <i class="fa fa-trash fs-15"></i>
                    </button>
                </td>
                </tr>
                @php $counter++; @endphp
            @endforeach
        @else
            <tr>
                <td colspan="8">
                    <x-record-not-found />
                </td>
            </tr>
        @endif
    </tbody>
</table>
@if ($allWeightUnits->isNotEmpty())
   <x-pagination-links :paginator="$allWeightUnits" />
@endif 