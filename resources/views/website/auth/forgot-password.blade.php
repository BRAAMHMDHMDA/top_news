<!-- forgot password -->
<section class="wrap__section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto" style="max-width: 380px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('website.forgot_password') }}</h4>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form wire:submit="sendResetLink">
                            <div class="form-group">
                                <label for="email">{{ __('website.email') }}</label>
                                <input 
                                    type="email" 
                                    id="email"
                                    class="form-control @error('form.email') is-invalid @enderror" 
                                    placeholder="{{ __('website.email') }}" 
                                    wire:model="form.email"
                                >
                                @error('form.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('website.send_reset_link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center mt-4 mb-0">
                    {{ __('website.remember_password') }}
                    <a href="{{ route('login') }}">{{ __('website.back_to_login') }}</a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- end forgot password -->
