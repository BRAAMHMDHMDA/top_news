<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ul class="breadcrumbs bg-light mb-4">
                    <li class="breadcrumbs__item">
                        <a href="{{ route('home') }}" class="breadcrumbs__url">
                            <i class="fa fa-home"></i> {{ __('website.home') }}</a>
                    </li>
                    <li class="breadcrumbs__item breadcrumbs__item--current">
                        {{ __('website.about') }}
                    </li>
                </ul>
                <!-- End breadcrumb -->

                <div class="wrap__about-us">
                    {!! $content !!}
                </div>
            </div>
        </div>
    </div>
</section>
