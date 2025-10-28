<div class="accordion" id="searchFilterArea">
    <div class="accordion-item">
        <h2 class="accordion-header" id="searchFilterHeading">
            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#searchCollapse" aria-expanded="true" aria-controls="searchCollapse">
                <i class="fas fa-search" style="padding-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}:0.35rem;"></i> 
                <span>{{ __('global.search')}}</span>
            </button>
        </h2>
        <div id="searchCollapse" class="accordion-collapse collapse" aria-labelledby="searchFilterHeading" data-bs-parent="#searchFilterArea">
            <div class="accordion-body">
                <div class="text-muted">
                    <form action="{{ $formAction }}" method="GET" id="search-filter" style="display: grid">
                        @csrf
                        <div class="search-filter">
                            @for ($i = 0; $i < $rows; $i++)
                                <div class="row mb-3">
                                    @for ($j = 0; $j < $inputsPerRow; $j++)
                                        <div class="{{ $colMdClasses[$i][$j] ?? 'col-md-12' }}">
                                            @php
                                                $input = $inputConfig[$i][$j] ?? ['type' => 'text', 'options' => []]; // Default to text input
                                                $placeholder = $placeholders[$i][$j] ?? 'Search'; // Default placeholder
                                                $name = $names[$i][$j] ?? 'name'; // Default placeholder
                                                $id = $ids[$i][$j] ?? 'id'; // Default placeholder
                                            @endphp
                                            
                                            @switch($input['type'])
                                                @case('text')
                                                    @php
                                                        // Check if 'customClass' is set in the input config, otherwise default to 'form-control'
                                                        $class = isset($input['customClass']) ? 'form-control ' . $input['customClass'] : 'form-control';
                                                    @endphp
                                                    <input type="text" class="{{ $class }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
                                                    @break

                                                @case('time')
                                                    @php
                                                        // Check if 'customClass' is set in the input config, otherwise default to 'form-control'
                                                        $class = isset($input['customClass']) ? 'form-control ' . $input['customClass'] : 'form-control';
                                                    @endphp
                                                    <input type="time" class="{{ $class }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
                                                    @break
                                                
                                                @case('select')
                                                   <select class="form-control  multiple-select select2" name="{{ $name }}" id="{{ $id }}">
                                                        <option value="" disabled selected>{{ $placeholder }}</option>

                                                        @if (isset($input['options']) && is_array($input['options']))
                                                            {{-- Array options --}}
                                                            @foreach ($input['options'] as $value => $label)
                                                                <option value="{{ $value }}">
                                                                    {{ @$localize == 'yes' ? __($label) : $label }}
                                                                </option>
                                                            @endforeach

                                                        @elseif ($input['options'] instanceof \Illuminate\Support\Collection)
                                                            {{-- Collection options --}}
                                                            @foreach ($input['options'] as $item)
                                                                @php
                                                                    // Use custom display if provided, otherwise default to 'name'
                                                                    if (isset($input['display'])) {
                                                                        $display = $item->{$input['display']};
                                                                    } else {
                                                                        // default name or localized name
                                                                        $display = isset($input['lang']) ? $item->{'name_'.$input['lang']} : $item->name;
                                                                    }
                                                                @endphp
                                                                <option value="{{ $item->id }}">
                                                                    {{ $display }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>


                                                    @break
                                                
                                                @case('checkbox')
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="{{ $name }}" id="{{ $id }}">
                                                        <label class="form-check-label" for="checkbox{{ $i }}{{ $j }}">{{ $placeholder }}</label>
                                                    </div>
                                                    @break
                                                
                                                @default
                                                    <input type="text" class="form-control" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
                                            @endswitch
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @if($reportType != '')
                                    @if($reportType == 'both')
                                        <div class="pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} col-md-6">
                                            <button type="submit" class="btn btn-primary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px">
                                                <i class="fa fa-search fs-15"></i> {{ __('global.search')}}
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px" 
                                                onclick="resetForm()">
                                                <i class="fa fa-undo fs-13"></i> {{ __('global.reset') }}
                                            </button> 
                                        </div>
                                        <div class="pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }} col-md-6">
                                            <button type="submit" class="btn btn-info pdfBtn btn-sm mx-1 pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }} m{{ app()->getLocale() == 'en' ? 'e' : 's' }}-1 p-0 lh-0" data-url={{ $formAction.'Pdf' }}>
                                                <i class="far fa-file-pdf fs-15"></i>
                                            </button>
                                            <button type="submit" class="btn btn-success btn-sm excelBtn pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }} m{{ app()->getLocale() == 'en' ? 'e' : 's' }}-1 p-0 lh-0" data-url={{ $formAction.'Excel' }}>
                                                <i class="far fa-file-excel fs-15"></i>
                                            </button>
                                        </div>
                                    @elseif($reportType =='pdf')
                                        <div class="col-md-6">
                                            <div class="pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}">
                                                <button type="submit" class="btn btn-info pdfBtn btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 'e' : 's' }}-1 p-0 lh-0" data-url={{ $formAction.'Pdf' }}>
                                                    <i class="far fa-file-pdf fs-15"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                                                <button type="submit" class="btn btn-primary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1">{{ __('global.search')}}</button>
                                                <button type="button" class="btn btn-secondary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px"
                                                    onclick="resetForm()">
                                                    <i class="fa fa-undo fs-13"></i> {{ __('global.reset') }}
                                                </button>  
                                            </div>
                                        </div>
                                    @elseif($reportType =='excel')
                                        <div class="col-md-6">
                                            <div class="pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}">
                                                <button type="submit" class="btn btn-success btn-sm excelBtn pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }} m{{ app()->getLocale() == 'en' ? 'e' : 's' }}-1 p-0 lh-0" data-url={{ $formAction.'Excel' }}>
                                                    <i class="far fa-file-excel fs-15"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                                                <button type="submit" class="btn btn-primary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1">{{ __('global.search')}}</button>
                                                <button type="button" class="btn btn-secondary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px"
                                                    onclick="resetForm()">
                                                    <i class="fa fa-undo fs-13"></i> {{ __('global.reset') }}
                                                </button>  
                                            </div>     
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                                                <button type="submit" class="btn btn-primary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1">{{ __('global.search')}}</button>
                                                <button type="button" class="btn btn-secondary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px"
                                                    onclick="resetForm()">
                                                    <i class="fa fa-undo fs-13"></i> {{ __('global.reset') }}
                                                </button>  
                                            </div>    
                                        </div>
                                    @endif
                                @else
                                    <div class="col-md-12">
                                        <div class="pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}">
                                            <button type="submit" class="btn btn-primary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1">{{ __('global.search')}}</button>
                                            <button type="button" class="btn btn-secondary btn-sm pull-{{ app()->getLocale() == 'en' ? 'left' : 'right' }} m{{ app()->getLocale() == 'en' ? 's' : 'e' }}-1" style="padding: 5px"
                                                onclick="resetForm()">
                                                <i class="fa fa-undo fs-13"></i> {{ __('global.reset') }}
                                            </button>  
                                        </div>      
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>