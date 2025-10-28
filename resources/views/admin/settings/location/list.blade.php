<div id="item-total-count-hidden" style="display: none;">{{$allLocations->total()}}</div>
<table class="table table-bordered fs-13">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%;" class="text-center">#</th>
            <th style="width: 15%;">{{ __('global.name') }}</th>
            <th style="width: 15%;">{{ __('global.address') }}</th>
            <th style="width: 10%;">{{ __('global.location.city') }}</th>
            <th style="width: 10%;">{{ __('global.location.state') }}</th>
            <th style="width: 30%;">{{ __('global.location.zipcode') }}</th>
            <th style="width: 5%;" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @if ($allLocations->isNotEmpty())
            @php $counter = ($allLocations->currentPage() - 1) * $allLocations->perPage() + 1; @endphp
            @foreach ($allLocations as $location)
                <tr id="tr-{{$counter}}">
                    <th class="text-center">{{ $counter }}</th>
                    <td>{{ $location->name }}</td>
                    <td>
                        {{ $location->address }}
                    </td>
                    <td>
                        {{ $location->city }}
                    </td>
                    <td>
                        {{ $location->state }}
                    </td>
                    <td>
                        {{ $location->zipcode }}
                    </td>
                    <td class="text-center text-nowrap">
                        <button class="btn btn-outline-primary btn-sm v-section action-btn" onclick='addEditModal(@json(route("location.add")), @json("settings.location"), "{{ $location->id }}")'>
                            <i class="fa fa-pen fs-15"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm v-section deleteBtn action-btn" data-id="{{ encryption($location->id) }}" data-url="deletes_location_route" data-toggle="tooltip" title="{{ __('global.delete')}}">
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
@if ($allLocations->isNotEmpty())
   <x-pagination-links :paginator="$allLocations" />
@endif 