<!-- login -->
<section class="wrap__section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto" style="max-width: 380px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('website.login') }}</h4>

                        <form wire:submit="login">
                            <a href="#" class="btn btn-facebook btn-block mb-2 text-white">
                                <i class="fa fa-facebook"></i>
                                {{ __('website.loginByFacebook') }}
                            </a>
                            <a href="#" class="btn btn-danger btn-block mb-4" style="background: red">
                                <i class="fa fa-google"></i> &nbsp;
                                {{ __('website.loginByGoogle') }}
                            </a>
                            <x-input placeholder="{{ __('website.email') }}" name="form.email"/>

                            <x-input placeholder="{{ __('website.password') }}" name="form.password" type="password"/>


                            <div class="form-group">
                                <a href="#" class="float-right">{{ __('website.forget') }} {{ __('website.password') }}{{ __('website.question_mark') }}</a>
                                <label class="float-left custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="">
                                    <span class="custom-control-label"> {{ __('website.remember') }} </span>
                                </label>
                            </div>
                            <div class="form-group">
                                <x-submit-btn class="btn btn-primary btn-block">{{ __('website.login') }}</x-submit-btn>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-4 mb-0">{{ __('website.noAccount') }}{{ __('website.question_mark') }} <a href="{{route('register')}}">{{ __('website.register') }}</a></p>
            </div>
        </div>
    </div>
</section>
<!-- end login -->
