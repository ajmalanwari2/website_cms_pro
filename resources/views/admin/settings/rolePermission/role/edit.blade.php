<form id="add-role-form" action="{{ route('role.updateRole') }}" method="POST">
    @csrf
    <div class="card-header" style="padding: 12px 5px 8px 5px; background: #343a40; color: #FFF;">
        <h3 class="card-title">
            <i class="fa fa-plus" style="margin-top: -1px"></i> {{ __('rolePermission.role.edit'); }}
        </h3>
        <button type="button" class="close cancel-btn" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="card-body">
        <div id="confrim-content-text" style="padding: 5px; font-size: 16px">
            <label class="custom-label">{{ __('rolePermission.role.name') }}</label>
            <input type="text" name="role" id="role-name" value="{{ $roles->name }}" class="form-control">
            <input type="hidden" name="role_id" value="{{ $roles->id }}">
        </div>
        <div id="confrim-content-text" style="padding: 5px; font-size: 16px">
            <label class="custom-label float-start">{{ __('rolePermission.permission.select_permission') }}</label>
            <label class="checkbox-container float-end">{{ __('global.all') }}
                <input type="checkbox" value="1" name="all_permission" id="all-permission" onchange="selectAllPermissions(this)">
                <span class="checkmark"></span>
            </label>
            <select class="multiple-select select2" name="permission[]" id="role-permission" multiple style="width: 100%;">
                <option value="0" disabled>{{ __('global.select') }}</option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}" @if($roles->hasPermissionTo($permission)) selected @endif>{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="padding: 5px;">
            <button type="button" class="btn btn-primary btn-sm" onclick="updateRole('add-role-form');">
                {{ __('global.submit') }}
            </button>
            <button type="button" class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                {{ __('global.cancel') }}
            </button>
        </div>
    </div>
</form>