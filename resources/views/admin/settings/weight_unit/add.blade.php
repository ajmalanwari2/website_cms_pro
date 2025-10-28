<form id="add-weight-unit-form" action="{{ route('weight_unit.store') }}" method="POST">
    @csrf
    <div class="card-header pt-3" style="background: #343a40; color: #FFF;">
        <h4 class="card-title text-white">
            <i class="fa fa-plus" style="margin-top: -1px"></i> {{ __('global.weight_unit.add_weight_unit'); }}
        </h4>
        <button type="button" class="close cancel-btn m-1" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row mt-1 mb-3">
                <div class="col-md-12">
                    <label class="custom-label">{{ __('global.weight_unit.name') }} <span class="required">*</span></label>
                    <input type="text" name="r_weight_unit_name" id="weight_unit_name" class="form-control" placeholder="{{ __('global.weight_unit.name') }}">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('global.submit') }}
                    </button>
                    <button type="button" class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                        {{ __('global.cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>