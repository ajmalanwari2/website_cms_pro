<form id="edit-company-form" action="{{ route('company.update') }}" method="POST">
    @csrf
    <div class="card-header pt-3" style="background: #343a40; color: #FFF;">
        <h4 class="card-title text-white">
            <i class="fa fa-pen" style="margin-top: -1px"></i> {{ __('global.company.edit_broker'); }}
        </h4>
        <button type="button" class="close cancel-btn m-1" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="card-body">
        @php
            $imagePath = @$company->image ? storage_path('app/public/attachment/company/image/' . @$company->image) : null;
            $imageExists = $imagePath && file_exists($imagePath); // true only if file exists physically
            $inputName = $imageExists ? 'r_edit_image' : 'edit_image';
            $imageSrc = $imageExists ? asset('storage/attachment/company/image/' . @$company->image) : asset('assets/images/default-company.png');
        @endphp
        <div class="col-md-12">
            <div class="row mt-1">
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.company.name') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_name" id="company_name" value="{{ $company->name }}" class="form-control">
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                </div>
                <div class="col-md-6">
                    <label class="custom-label">{{ __('global.company.email') }}</label>
                    <input type="text" name="company_email" id="company_email" value="{{ $company->email }}" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="custom-label">{{ __('global.company.phone') }}</label>
                    <input type="text" name="company_phone" id="company_phone" value="{{ $company->phone }}" class="form-control">
                </div>
                <div class="col-md-4">
                   <label class="custom-label">{{ __('global.company.dot_number') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_dot_number" id="company_dot_number" value="{{ $company->dot_number }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="custom-label">{{ __('global.company.mc_number') }} <span class="required">*</span></label>
                    <input type="text" name="r_company_mc_number" id="company_mc_number" value="{{ $company->mc_number }}" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-5">
                   <label class="custom-label">{{ __('global.company.authorities') }}</label>
                    <select name="authorities[]" class="multiple-select select2" multiple>
                        <option value="operating" {{ in_array('operating', @$company->authorities ?? []) ? 'selected' : '' }}>{{ __('global.operating')}}</option>
                        <option value="hazmat" {{ in_array('hazmat', @$company->authorities ?? []) ? 'selected' : '' }}>{{ __('global.hazmat')}}</option>
                        <option value="broker" {{ in_array('broker', @$company->authorities ?? []) ? 'selected' : '' }}>{{ __('global.broker')}}</option>
                    </select>
                </div>
                <div class="col-md-4">
                     <label class="custom-label">{{ __('global.company.ein') }}</label>
                    <input type="text" name="r_company_ein" id="company_ein" class="form-control" placeholder="{{ __('global.company.ein') }}" value="{{ $company->ein}}">
                </div>
                <div class="col-md-3">
                    <label class="custom-label">{{ __('global.company.scac') }}</label>
                    <input type="text" name="r_company_scac" id="company_scac" class="form-control" placeholder="{{ __('global.company.scac') }}" value="{{ $company->scac}}">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row mt-3">
                <div class="col-md-12">
                    <label class="custom-label">{{ __('global.company.address') }}</label>
                    <textarea name="company_address" id="company_address" class="form-control" cols="5" rows="2">{{ $company->address }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row mt-3 mb-4">
                <div class="col-md-12">
                   <label for="{{ $inputName }}" id="img-label" style="padding: 3px 5px; border-radius: 5px; text-align: center;">
                        <img id="previewImage" src="{{ $imageSrc }}" alt="{{ @$company->name }}" class="rounded-circle" width="182" height="auto">
                        @if($imageExists)
                            <span class="required">*</span>
                        @endif
                    </label>
                    <input type="file" class="custom-file-input" name="{{ $inputName }}" id="{{ $inputName }}" onchange="showImages(event, '{{ $inputName }}', 'previewImage')" style="display:none;">
                </div>
            </div>
        </div>
        <hr>
        <h4>{{ __('global.company.attachment') }}</h4>
        <div class="col-md-12">
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('global.company.attachment_name') }}</th>
                                <th>{{ __('global.company.attachment') }}</th>
                                <th class="text-center" style="width: 3%;"><i class="fa fa-gear fs-15"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyAttachments as $attachment)
                                <tr id="row_{{ $attachment->id}}">
                                    <td>{{ $attachment->name }}</td>
                                    <td>
                                        <a href="{{ asset('storage/attachment/company/documents/' . $attachment->file_path) }}" target="_blank">
                                            {{ __('global.download') }}
                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm action-btn" onclick="deleteExistingAttachment({{ $attachment->id }})">
                                            <i class="fa fa-trash fs-15"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <input type="hidden" name="deleted_attachments" id="deleted_attachments" value="" />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr>
         <div class="col-md-12 mt-3 mb-4">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="col-md-6 mb-3 mt-3 pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                        <button type="button"  class="btn btn-primary btn-sm" id="addAttachmentBtn" onclick="addNewAttachmentField();"><i class="fa fa-plus fs-15"></i> {{__('global.company.add_new_attachment')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4" id="attachmentArea"></div>
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