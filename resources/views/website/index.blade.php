<x-website.layout title="{{__('website.home')}}">

    <!-- Trending news  carousel-->
    <x-website.breaking-news />
    <!-- End Trending news carousel -->


    <!-- slider news  header-->
    <x-website.hero-slider />
    <!-- End slider news header-->


    <div class="large_add_banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="large_add_banner_img">
                        <img src="{{ asset('website_assets/images/placeholder_large.jpg') }}" alt="adds">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular news category -->
    <section class="pt-0 mt-5">

        <div class="popular__section-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <x-website.recent-news />
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <x-website.popular-news />
                    </div>
                </div>
            </div>
        </div>

        <!-- section one slider news -->
        <x-website.slider-news section="1"/>
        <!-- End section one slider news -->

        <!-- section two slider news -->
        <x-website.slider-news section="2"/>
        <!-- End section two slider news -->


        <!-- Popular news category -->
        <div class="mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <x-website.cards-news section="3" />

                        <div class="small_add_banner">
                            <div class="small_add_banner_img">
                                <img src="{{ asset('website_assets/images/placeholder_large.jpg') }}" alt="adds">
                            </div>
                        </div>

                        <x-website.cards-news section="4" />
                    </div>

                    <div class="col-md-4">
                        <x-website.sidebar />
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Popular news category -->

</x-website.layout>
