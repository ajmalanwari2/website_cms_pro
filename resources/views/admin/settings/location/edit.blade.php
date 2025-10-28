<form id="edit-location-form" action="{{ route('location.update') }}" method="POST">
    @csrf
    <div class="card-header pt-3" style="background: #343a40; color: #FFF;">
        <h4 class="card-title text-white">
            <i class="fa fa-pen" style="margin-top: -1px"></i> {{ __('global.location.edit_location'); }}
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
                    <input type="text" name="r_location_name" id="location_name" value="{{ $location->name }}" class="form-control">
                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.location.city') }}</label>
                    <input type="text" name="location_city" id="location_city" value="{{ $location->city }}" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                   <label class="custom-label">{{ __('global.location.state') }}</label>
                    <input type="text" name="location_state" id="location_state" value="{{ $location->state }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.location.zipcode') }} <span class="required">*</span></label>
                    <input type="text" name="r_location_zipcode" id="location_zipcode" value="{{ $location->zipcode }}" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
                <div class="col-md-12">
                    <label class="custom-label">{{ __('global.location.address') }}</label>
                    <textarea cols="5" rows="2" name="location_address" id="location_address" class="form-control" placeholder="{{ __('global.location.address') }}">{{ $location->address }}</textarea>
                </div>
            </div>
        <div style="padding: 5px;">
            <button type="submit" class="btn btn-primary btn-sm">
                {{ __('global.update') }}
            </button>
            <button type="button" class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                {{ __('global.cancel') }}
            </button>
        </div>
    </div>
</form>