<form id="add-company-form" action="{{ route('company.store') }}" method="POST">
    @csrf
    <div class="card-header pt-3" style="background: #343a40; color: #FFF;">
        <h4 class="card-title text-white">
            <i class="fa fa-plus" style="margin-top: -1px"></i> {{ __('global.company.add_broker'); }}
        </h4>
        <button type="button" class="close cancel-btn m-1" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row mt-1">
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.company.name') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_name" id="company_name" class="form-control" placeholder="{{ __('global.company.name') }}">
                    <span class="text-danger hiddens">{{ __('global.required')}}</span>
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.company.email') }}</label>
                    <input type="text" name="company_email" id="company_email" class="form-control" placeholder="{{ __('global.company.email') }}">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="custom-label">{{ __('global.company.phone') }}</label>
                    <input type="text" name="company_phone" id="company_phone" class="form-control" placeholder="{{ __('global.company.phone') }}">
                </div>
                <div class="col-md-4">
                    <label class="custom-label">{{ __('global.company.dot_number') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_dot_number" id="company_dot_number" class="form-control" placeholder="{{ __('global.company.dot_number') }}">
                    <span class="text-danger hiddens">{{ __('global.required')}}</span>
                </div>
                <div class="col-md-4">
                    <label class="custom-label">{{ __('global.company.mc_number') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_mc_number" id="company_mc_number" class="form-control" placeholder="{{ __('global.company.mc_number') }}">
                    <span class="text-danger hiddens">{{ __('global.required')}}</span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-5">
                    <label class="custom-label">{{ __('global.company.authorities') }}</label>
                    <select name="authorities[]" class="multiple-select select2" multiple>
                        <option value="">{{ __('global.select')}}</option>
                        <option value="operating">{{ __('global.operating')}}</option>
                        <option value="hazmat">{{ __('global.hazmat')}}</option>
                        <option value="broker">{{ __('global.broker')}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                     <label class="custom-label">{{ __('global.company.ein') }}</label>
                    <input type="text" name="r_company_ein" id="company_ein" class="form-control" placeholder="{{ __('global.company.ein') }}">
                </div>
                <div class="col-md-3">
                    <label class="custom-label">{{ __('global.company.scac') }}</label>
                    <input type="text" name="r_company_scac" id="company_scac" class="form-control" placeholder="{{ __('global.company.scac') }}">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row mt-3 mb-4">
                <div class="col-md-12">
                    <label class="custom-label">{{ __('global.company.address') }}</label>
                    <textarea name="company_address" id="company_address" class="form-control" cols="5" rows="2" placeholder="{{ __('global.company.address') }}"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row mt-3 mb-4">
                <div class="col-md-12">
                   <label for="image" id="img-label" style="padding: 3px 5px; border-radius: 5px; text-align: center;">
                        <img src="{{asset('assets/images/default-company.png')}}" id="previewImage" name="image" alt="Company Image" class="rounded-circle" width="182" height="auto">
                    </label>
                    <input type="file" class="custom-file-input" name="image" id="image" onchange="showImages(event, 'image', 'previewImage')" style="display:none;">
                </div>
            </div>
        </div>
        <hr>
         <div class="col-md-12 mb-4">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="col-md-6 mb-3 mt-3 pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                        <button type="button"  class="btn btn-primary btn-sm" id="addAttachmentBtn" onclick="addNewAttachmentField();"><i class="fa fa-plus fs-15"></i> {{__('global.company.add_new_attachment')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4" id="attachmentArea"></div>

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