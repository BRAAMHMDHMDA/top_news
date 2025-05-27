<!-- Start Footer -->
<section class="wrapper__section p-0">
    <div class="wrapper__section__components">
        <!-- Footer -->
        <footer>
            <div class="wrapper__footer bg__footer-dark pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="widget__footer">
                                <figure class="image-logo">
                                    <img src="{{ asset('website_assets/images/logo2.png') }}" alt="" class="logo-footer">
                                </figure>

                                <p>
                                    {{ setting('footer.section_one.paragraph') }}
                                </p>


                                <div class="social__media mt-4">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{ setting('social.facebook') }}" class="btn btn-social rounded text-white facebook">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ setting('social.twitter') }}" class="btn btn-social rounded text-white twitter">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ setting('social.whatsapp') }}" class="btn btn-social rounded text-white whatsapp">
                                                <i class="fa fa-whatsapp"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ setting('social.telegram') }}" class="btn btn-social rounded text-white telegram">
                                                <i class="fa fa-telegram"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{ setting('social.linkedin') }}" class="btn btn-social rounded text-white linkedin">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ setting('footer.section_two.title') }}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach(setting('footer.section_two.links') as $link)
                                        <li>
                                            <a href="{{$link['url']}}">{{$link['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ setting('footer.section_three.title') }}
                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>
                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach(setting('footer.section_three.links') as $link)
                                        <li>
                                            <a href="{{$link['url']}}">{{$link['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="widget__footer">
                                <div class="dropdown-footer">
                                    <h4 class="footer-title">
                                        {{ setting('footer.section_four.title') }}

                                        <span class="fa fa-angle-down"></span>
                                    </h4>

                                </div>

                                <ul class="list-unstyled option-content is-hidden">
                                    @foreach(setting('footer.section_four.links') as $link)
                                        <li>
                                            <a href="{{$link['url']}}">{{$link['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer bottom -->
            <div class="wrapper__footer-bottom bg__footer-dark" style="padding-top: 20px">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top-1 bg__footer-bottom-section">
                                <p class="text-white text-center">
                                    Copyright © 2023 Top News
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </footer>
    </div>
</section>
<!-- End Footer -->
