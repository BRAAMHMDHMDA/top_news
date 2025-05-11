<!-- register -->
<section class="wrap__section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- register -->
                <!-- Form Register -->

                <div class="card mx-auto" style="max-width:520px;">
                    <article class="card-body">
                        <header class="mb-4">
                            <h4 class="card-title">{{ __('website.register') }}</h4>
                        </header>
                        <form wire:submit="register">
{{--                                <div class="form-row">--}}
{{--                                    <div class="col form-group">--}}
{{--                                        <label>First name</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="">--}}
{{--                                    </div> <!-- form-group end.// -->--}}
{{--                                    <div class="col form-group">--}}
{{--                                        <label>Last name</label>--}}
{{--                                        <input type="text" class="form-control" placeholder="">--}}
{{--                                    </div> <!-- form-group end.// -->--}}
{{--                                </div> <!-- form-row end.// -->--}}

                            <x-input placeholder="{{ __('website.name') }}" name="name" label="{{ __('website.name') }}"/>

                            <x-input placeholder="example@example.com" name="email" type="email" label="{{ __('website.email') }}"/>


                            <div class="form-group">
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" checked="" type="radio" name="gender"
                                           value="option1">
                                    <span class="custom-control-label"> {{ __('website.male') }} </span>
                                </label>
                                <label class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="gender" value="option2">
                                    <span class="custom-control-label"> {{ __('website.female') }} </span>
                                </label>
                            </div> <!-- form-group end.// -->
{{--                                <div class="form-row">--}}
{{--                                    <div class="form-group col-md-6">--}}
{{--                                        <label>City</label>--}}
{{--                                        <input type="text" class="form-control">--}}
{{--                                    </div> <!-- form-group end.// -->--}}
{{--                                    <div class="form-group col-md-6">--}}
{{--                                        <label>Country</label>--}}
{{--                                        <select id="inputState" class="form-control">--}}
{{--                                            <option> Choose...</option>--}}
{{--                                            <option>Uzbekistan</option>--}}
{{--                                            <option>Russia</option>--}}
{{--                                            <option selected="">United States</option>--}}
{{--                                            <option>India</option>--}}
{{--                                            <option>Afganistan</option>--}}
{{--                                        </select>--}}
{{--                                    </div> <!-- form-group end.// -->--}}
{{--                                </div> <!-- form-row.// -->--}}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <x-input placeholder="******" name="password" type="password" label="{{ __('website.password') }}"/>

                                </div> <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <x-input placeholder="******" name="password_confirmation" type="password" label="{{ __('website.confirm_password') }}"/>
                                </div> <!-- form-group end.// -->
                            </div>
                            <div class="form-group">
                                <x-submit-btn class="btn btn-primary btn-block">{{ __('website.register') }}</x-submit-btn>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="">
                                    <span class="custom-control-label"> {{ __('website.iam_agree') }} <a href="#">{{ __('website.terms_condition') }}</a> </span>
                                </label>
                            </div> <!-- form-group end.// -->
                        </form>
                    </article><!-- card-body.// -->
                </div>
                <!-- end register -->
            </div>
        </div>
    </div>
</section>
<!-- end register -->
