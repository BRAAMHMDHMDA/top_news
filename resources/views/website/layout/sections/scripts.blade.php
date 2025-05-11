@if (app()->getLocale() == 'ar')
    <script type="text/javascript" src="{{ asset('website_assets/js/index_ar.bundle.js') }}"></script>
@else
    <script type="text/javascript" src="{{ asset('website_assets/js/index_en.bundle.js') }}"></script>
@endif
<script>
    document.getElementById('languageSelector').addEventListener('change', function() {
        var selectedUrl = this.value;
        if (selectedUrl) {
            window.location.href = selectedUrl;
        }
    });
</script>
