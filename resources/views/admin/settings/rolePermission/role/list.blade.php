<table class="table custom-table">
    <thead class="table-dark">
        <tr>
            <th style="width: 2%" class="text-center">#</th>
            <th style="">{{ __('rolePermission.role.name') }}</th>
            <th style="">{{ __('rolePermission.permission.name') }}</th>
            <th style="width: 5%" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @php $counter = ($roles->currentPage() - 1) * $roles->perPage() + 1; @endphp
        @foreach ($roles as $role)
            <tr id="role-tr-{{ $counter }}">
                <td class="text-center">{{ $counter }}</td>
                <td>
                    {{ $role->name }}
                </td>
                <td>
                    <ul class="numbered-list">
                        @foreach ($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-center text-nowrap">
                    <button class="btn btn-outline-primary btn-sm action-btn" onclick='addEditModal(@json(route($item . ".add")), @json("settings.rolePermission.role"), {{ $role->id }})'>
                        <i class="fa fa-pen fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm action-btn" onclick="confirmModal('{{ $role->id }}', '{{ $counter }}')" title="{{ __('global.delete') }}">
                        <i class="fa fa-trash fs-15"></i>
                    </button>
                </td>
            </tr>
            @php $counter++; @endphp
        @endforeach
        @if ($roles->isEmpty())
            <tr>
                <td colspan="5">
                    No Role records found!
                </td>
            </tr>
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9" style="padding: 5px;">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12" style="text-align: right;">
                        <nav aria-label="role pagination">
                            <ul class="pagination" style="margin-top: 5px;">
                                @if ($roles->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="{{ $roles->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                    @if ($page == $roles->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($roles->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="{{ $roles->nextPageUrl() }}">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" data-resultid="role-list" data-formid="role-filter" href="#" tabindex="-1" aria-disabled="true">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12" style="text-align: right;" id="role-filter">
                        <input type="text" name="search" value="{{ $search }}" class="form-control" style="padding: 5px; width: 80%; display: inline;" onkeyup="filterRecord(event, 'role-filter', 'role-list', '{{ route('roles') }}')" placeholder="{{ __('rolePermission.role.name') }}, {{ __('rolePermission.permission.name') }}">
                        <button class="btn btn-primary btn-sm" onclick="filterRecord(event, 'role-filter', 'role-list', '{{ route('roles') }}')">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>