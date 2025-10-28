<form id="add-location-form" action="{{ route('location.store') }}" method="POST">
    @csrf
    <div class="card-header pt-3" style="background: #343a40; color: #FFF;">
        <h4 class="card-title text-white">
            <i class="fa fa-plus" style="margin-top: -1px"></i> {{ __('global.location.add_location'); }}
        </h4>
        <button type="button" class="close cancel-btn m-1" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row mt-1">
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.location.name') }} <span class="required">*</span></label>
                    <input type="text" name="r_location_name" id="location_name" class="form-control" placeholder="{{ __('global.location.name') }}">
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.location.city') }}</label>
                    <input type="text" name="location_city" id="location_city" class="form-control" placeholder="{{ __('global.location.city') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                     <label class="custom-label">{{ __('global.location.state') }}</label>
                    <input type="text" name="location_state" id="location_state" class="form-control" placeholder="{{ __('global.location.state') }}">
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.location.zipcode') }} <span class="required">*</span></label>
                    <input type="text" name="r_location_zipcode" id="location_zipcode" class="form-control" placeholder="{{ __('global.location.zipcode') }}">
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col-md-12">
                    <label class="custom-label">{{ __('global.location.address') }}</label>
                    <textarea cols="5" rows="2" name="location_address" id="location_address" class="form-control" placeholder="{{ __('global.location.address') }}"></textarea>
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