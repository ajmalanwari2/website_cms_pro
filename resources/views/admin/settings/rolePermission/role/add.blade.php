<form id="add-role-form" action="{{ route('role.storeRole') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title"><i class="bx bx-user"></i> {{ __('rolePermission.role.add'); }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div style="padding: 5px; font-size: 16px">
            <label class="custom-label">{{ __('rolePermission.role.name') }}</label>
            <input type="text" name="role" id="role-name" class="form-control">
        </div>
        <div style="padding: 5px; font-size: 16px">
            <label class="custom-label">{{ __('rolePermission.permission.select_permission') }}</label>
            <select class="multiple-select" name="permission[]" id="role-perssion" multiple>
                <option value="0">{{ __('global.select') }}</option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="padding: 5px;">
            <button type="button" class="btn btn-primary btn-sm" onclick="addRole('add-role-form');">
                {{ __('global.submit') }}
            </button>
            <button type="button" class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                {{ __('global.cancel') }}
            </button>
        </div>
    </div>
</form>