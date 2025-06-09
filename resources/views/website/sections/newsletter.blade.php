
<aside class="wrapper__list__article" style="margin-top: 40px">
    <h4 class="border_section">{{ __('website.newsletter') }}</h4>
    <!-- Form Subscribe -->
    <form wire:submit="submit">

    <div class="widget__form-subscribe bg__card-shadow">
        <h6>
{{--            The most important world news and events of the day.--}}
            {{ __('website.newsletter_massage_one') }}
        </h6>

        <p>
            <small>
{{--                Get magazine daily newsletter on your inbox.--}}
                {{ __('website.newsletter_massage_two') }}
            </small>
        </p>

        @session('subscribe_success')
            <div class="alert alert-success"> {{ __('website.subscribe_success') }} </div>
        @endsession

        <x-input name="email" class="form-control" placeholder="{{ __('website.enter_your_email') }}" />
        <div style="display: flex; justify-content: flex-end">
           <x-submit-btn class="btn btn-primary">{{ __('website.subscribe') }}</x-submit-btn>
        </div>

    </div>
    </form>

</aside>
