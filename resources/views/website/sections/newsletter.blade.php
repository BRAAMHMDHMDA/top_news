
<aside class="wrapper__list__article">
    <h4 class="border_section">newsletter</h4>
    <!-- Form Subscribe -->
    <form wire:submit="submit">

    <div class="widget__form-subscribe bg__card-shadow">
        <h6>
            The most important world news and events of the day.
        </h6>

        <p><small>Get magzrenvi daily newsletter on your inbox.</small></p>

        @session('subscribe_success')
            <div class="alert alert-success">Subscribe Successfully</div>
        @endsession

        <x-input name="email" class="form-control" placeholder="Your email address" />
        <div style="display: flex; justify-content: flex-end">
           <x-submit-btn class="btn btn-primary">Subscribe</x-submit-btn>
        </div>

    </div>
    </form>

</aside>
