<table class="table custom-table">
    <thead class="table-dark">
        <tr>
            <th style="width: 2%" class="text-center">#</th>
            <th>{{ __('rolePermission.permission.name') }}</th>
            <th style="width: 6%" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @php $counter = ($permissions->currentPage() - 1) * $permissions->perPage() + 1; @endphp
        @foreach ($permissions as $permission)
            <tr id="tr-{{ $counter }}">
                <td class="text-center">{{ $counter }}</td>
                <td>
                    <span class="v-section" id="pname-{{ $counter }}">{{ $permission->name }}</span>
                    <input type="text" id="permission" value="{{ $permission->name }}" class="form-control d-none e-section">
                </td>
                <td class="text-center text-nowrap">
                    <button class="btn btn-outline-primary btn-sm v-section action-btn" onclick="toggleEdit({{ $counter }}, true);">
                        <i class="fa fa-pen fs-15"></i>
                    </button>
                    <button class="btn btn-outline-success btn-sm e-section d-none action-btn" title="{{ __('global.edit') }}" onclick="updatePermission({{ $counter }}, '{{ $permission->id }}');">
                        <i class="fa fa-check-circle fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm d-none e-section action-btn" title="{{ __('global.cancel') }}" onclick="toggleEdit({{ $counter }}, false);">
                        <i class="fa fa-times-circle fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm spinner-btn d-none action-btn" title="{{ __('global.spinner') }}">
                        <i class="fas fa-2x fa-sync fa-spin fs-15"></i>
                    </button>
                    <button class="btn btn-outline-danger btn-sm v-section action-btn" onclick="confirmModal('{{ $permission->id }}', '{{ $counter }}')" title="{{ __('global.delete') }}">
                        <i class="fa fa-trash fs-15"></i>
                    </button>
                </td>
            </tr>
            @php $counter++; @endphp
        @endforeach
        @if ($permissions->isEmpty())
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
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <nav aria-label="role pagination">
                            <ul class="pagination" style="margin-top: 5px;">
                                @if ($permissions->onFirstPage())
                                    <li class="page-item disabled">
                                        <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="{{ $permissions->previousPageUrl() }}" tabindex="-1">Previous</a>
                                    </li>
                                @endif

                                @foreach ($permissions->getUrlRange(1, $permissions->lastPage()) as $page => $url)
                                    @if ($page == $permissions->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                @if ($permissions->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="{{ $permissions->nextPageUrl() }}">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" data-resultid="permission-list" data-formid="permission-filter" href="#" tabindex="-1" aria-disabled="true">Next</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12" style="text-align: right;" id="permission-filter">
                        <input type="text" name="search" id="search" value="{{ $search }}" style="padding: 5px; width: 80%; display: inline; border: 1px solid #CCC" onkeyup="filterRecord(event, 'permission-filter', 'permission-list', '{{ route('permission') }}')" placeholder="{{ __('rolePermission.permission.name') }}">
                        <button class="btn btn-primary btn-sm" onclick="filterRecord(event, 'permission-filter', 'permission-list', '{{ route('permission') }}')">
                            <i class="bx bx-search"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>
</table>