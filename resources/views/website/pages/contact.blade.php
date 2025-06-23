<div>
    <!-- Breadcrumb  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumbs bg-light mb-4">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('home') }}" class="breadcrumbs__url">
                                <i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumbs__item breadcrumbs__item--current">
                            Contact Us
                        </li>
                    </ul>
                    <!-- End breadcrumb -->
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb  -->


    <!-- Form contact -->
    <section class="wrap__contact-form">
        <form class="container" wire:submit.prevent="submit">
            <div class="row">
                <div class="col-md-8">
                    <h5>contact us</h5>
                    @session('contact_success')
                    <div class="alert alert-success"> {{ __('website.contact_success') }} </div>
                    @endsession
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-name">
                                {{--                                <label> <span class="required"></span></label>--}}
                                {{--                                <input  class="form-control" name="email" required="">--}}
                                <x-input name="email" type="email" label="Your email" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-name">
                                <x-input name="subject" type="text" label="Subject" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Your Message</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" rows="8"
                                          name="message" wire:model="message"></textarea>
                                @error('message')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <x-submit-btn class="btn btn-primary">Submit</x-submit-btn>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5>Info location</h5>
                    <div class="wrap__contact-form-office">
                        <ul class="list-unstyled">
                            <li>
                                <span>
                                    <i class="fa fa-home"></i>
                                </span>
                                {{setting('contact.address')}}
                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:">{{setting('contact.phone')}}</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:">{{setting('contact.email')}}</a>
                                </span>

                            </li>
                        </ul>

                        <div class="social__media">
                            <h5>find us</h5>
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a href="{{setting('social.facebook')}}" target="_blank"
                                       class="btn btn-social rounded text-white facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{setting('social.twitter')}}" target="_blank"
                                       class="btn btn-social rounded text-white twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{setting('social.whatsapp')}}" target="_blank"
                                       class="btn btn-social rounded text-white whatsapp">
                                        <i class="fa fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{setting('social.telegram')}}" target="_blank"
                                       class="btn btn-social rounded text-white telegram">
                                        <i class="fa fa-telegram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{setting('social.linkedin')}}" target="_blank"
                                       class="btn btn-social rounded text-white linkedin">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- End Form contact  -->
</div>
