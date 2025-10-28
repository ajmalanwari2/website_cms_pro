<div class="page-breadcrumb align-items-center mb-3">
    <nav aria-label="breadcrumb">
        <div class="row">
            @if($totalCount !='')
                <div class="col-md-10 px-0">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard'); }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ $pageTitle }}</li>
                    </ol>
                </div>
                <div class="col-md-2 align-items-center d-flex">
                    <div id="item-total-count">{{ $totalCount }}</div>
                    <i class="bx bx-collection m{{ app()->getLocale() == 'en' ? 'l' : 'r' }}-1 m{{ app()->getLocale() == 'en' ? 'l' : 'r' }}-half-1"></i> 
                </div>
            @else
                <div class="col-md-10 px-0">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard'); }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ $pageTitle }}</li>
                    </ol>
                </div>
            @endif
        </div>
    </nav>
</div>