<form id="add-permission-form" action="{{ route('permission.storepermission') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title"><i class="bx bx-user"></i> {{ __('rolePermission.permission.add'); }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div id="confrim-content-text" style="padding: 5px; font-size: 16px">
            <label class="custom-label">{{ __('rolePermission.permission.name') }}</label>
            <input type="text" name="permission" id="permission-name" class="form-control">
        </div>
        <div id="confrim-content-text" style="padding: 5px; font-size: 16px">
            <label class="custom-label">{{ __('rolePermission.role.select_role') }}</label>
            <select class="select2 form-control" name="role" id="role-name" style="width: 100%;">
                <option value="0">{{ __('global.select') }}</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div style="padding: 5px;">
            <button type="button" class="btn btn-primary btn-sm" onclick="addPermission('add-permission-form');">
                {{ __('global.submit') }}
            </button>
            <button type="button" class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                {{ __('global.cancel') }}
            </button>
        </div>
    </div>
</form>