<div id="item-total-count-hidden" style="display: none;">{{$allCompanies->total()}}</div>
<table class="table table-bordered fs-13">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%;" class="text-center">#</th>
            <th style="width: 5%;">{{ __('users.photo') }}</th>
            <th style="width: 10%;">{{ __('global.name') }}</th>
            <th style="width: 10%;">{{ __('global.email') }}</th>
            <th style="width: 8%;">{{ __('global.dot_number') }}</th>
            <th style="width: 7%;">{{ __('global.mc_number') }}</th>
            <th style="width: 10%;">{{ __('global.company.ein') }}</th>
            <th style="width: 10%;">{{ __('global.company.scac') }}</th>
            <th style="width: 20%;">{{ __('global.authorities') }}</th>
            <th style="width: 5%;" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @if ($allCompanies->isNotEmpty())
            @php $counter = ($allCompanies->currentPage() - 1) * $allCompanies->perPage() + 1; @endphp
            @foreach ($allCompanies as $company)
                <tr id="tr-{{$counter}}">
                    <th class="text-center">{{ $counter }}</th>
                    <td style="text-align: center">
                        @php
                            $default = asset('assets/images/default-company.png');
                            $src = $company->image ? asset('storage/attachment/company/image/' . $company->image)
                                : $default;
                        @endphp

                        <img alt="image" src="{{ $src }}" style="width: 40px; height: 40px; border: 1px double #CCC; border-radius: 50%;">
                    </td>
                    <td>{{ $company->name }}</td>
                    <td>
                        {{ $company->email }}
                    </td>
                    <td>
                        {{ $company->dot_number }}
                    </td>
                    <td>
                        {{ $company->mc_number }}
                    </td>
                    <td>
                        {{ $company->ein }}
                    </td>
                    <td>
                        {{ $company->scac }}
                    </td>
                    <td>
                    @if(!empty(@$company->authorities))
                        @foreach(@$company->authorities as $key => $value)
                            @if($value)
                                <span class="badge bg-primary text-uppercase p-2">{{ __('global.' . $value) }}</span>
                            @endif
                        @endforeach
                    @endif
                    </td>
                    <td class="text-center text-nowrap">
                        <button class="btn btn-outline-primary btn-sm v-section action-btn" onclick='addEditModal(@json(route("broker.add")), @json("settings.company"), "{{ $company->id }}")'>
                            <i class="fa fa-pen fs-15"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm v-section deleteBtn action-btn" data-id="{{ encryption($company->id) }}" data-url="deletes_company_route" data-toggle="tooltip" title="{{ __('global.delete')}}">
                            <i class="fa fa-trash fs-15"></i>
                        </button>
                    </td>
                </tr>
                @php $counter++; @endphp
            @endforeach
        @else
            <tr>
                <td colspan="10">
                    <x-record-not-found />
                </td>
            </tr>
        @endif
    </tbody>
</table>
@if ($allCompanies->isNotEmpty())
   <x-pagination-links :paginator="$allCompanies" />
@endif 