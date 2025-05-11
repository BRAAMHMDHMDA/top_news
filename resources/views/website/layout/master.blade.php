<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

@include('website.layout.sections.head')

<body>

<!-- Start Header -->
@include('website.layout.sections.header')
<!-- End Header -->

<!-- Start Content -->
{{$slot}}
<!-- End Content -->

<!-- Start Footer -->
@include('website.layout.sections.footer')
<!-- End Footer -->

<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>


@include('website.layout.sections.scripts')

</body>

</html>
