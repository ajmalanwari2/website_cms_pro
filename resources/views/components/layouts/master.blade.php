<!DOCTYPE html>
@props([
'title' => 'Home',
'sidebar' => null,
])
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
direction="{{ session()->has('locale') && (session()->get('locale') == 'en' || session()->get('locale') == 'ger') ? 'ltr' : 'rtl' }}"
      dir="{{ session()->has('locale') && (session()->get('locale') == 'en' || session()->get('locale') == 'ger') ? 'ltr' : 'rtl' }}"
      style="direction: {{ session()->has('locale') && (session()->get('locale') == 'en' || session()->get('locale') == 'ger') ? 'ltr' : 'rtl' }}"
      data-theme="theme-default" data-assets-path="{{ asset('assets/') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Association</title>
    <!-- <link rel="icon" href="assets/img/m-tax.png"> -->
    <title>{{$title}}</title>

    <x-js_css.css />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/> -->
    <!--custom css -->
    {{ $css ?? '' }}
    @stack('css')
</head>

<body>
    <div class="preloder" id="page-preloader">
        <div class="circle"></div>
    </div>
    <x-layouts.header />
    @stack('content')

    <x-layouts.footer />

    <x-js_css.js />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    {{ $jsLinks ?? '' }}
    @stack('js')
</body>

</html>