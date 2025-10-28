<div class="card-header py-0">
    <div class="col-md-12">
        <div class="row align-items-center">
            @if($scenario == 1) {{-- only header --}}
                <div class="col-md-12">
                    <div class="row">
                        <x-card-header-title
                            :pageTitle="$pageTitle"
                            :totalCount="$totalCount" />
                    </div>
                </div>
            @endif
            @if($scenario == 2) {{-- header and add-button --}}
                <div class="col-md-10">
                    <div class="row">
                        <x-card-header-title
                            :pageTitle="$pageTitle"
                            :totalCount="$totalCount" />
                    </div>
                </div>
                <div class="col-md-2">
                    @if(!empty($modal))
                        <x-add-new-item 
                            :permission="$permission"
                            :label="$buttonLabel"
                            :path="$resourcePath"
                            :class="$buttonClass"
                            :modal="$modal"
                        />
                    @elseif(!empty($newPageRoute))
                        <x-add-new-item 
                            :permission="$permission"
                            :label="$buttonLabel"
                            :path="$resourcePath"
                            :class="$buttonClass"
                            :newPageRoute="$newPageRoute"
                        />
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>