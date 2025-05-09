<!DOCTYPE html>
<html lang="en" dir="ltr">

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

<script type="text/javascript" src="{{ asset('website_assets/js/index_en.bundle.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('website_assets/js/index_ar.bundle.js') }}"></script>--}}
</body>

</html>
