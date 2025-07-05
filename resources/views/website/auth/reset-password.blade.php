<!-- reset password -->
<section class="wrap__section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto" style="max-width: 380px;">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('website.reset_password') }}</h4>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form wire:submit="resetPassword">
                            <div class="form-group">
                                <label for="email">{{ __('website.email') }}</label>
                                <input 
                                    type="email" 
                                    id="email"
                                    class="form-control @error('form.email') is-invalid @enderror" 
                                    placeholder="{{ __('website.email') }}" 
                                    wire:model="form.email"
                                    disabled
                                >
                                @error('form.email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('website.new_password') }}</label>
                                <input 
                                    type="password" 
                                    id="password"
                                    class="form-control @error('form.password') is-invalid @enderror" 
                                    placeholder="{{ __('website.new_password') }}" 
                                    wire:model="form.password"
                                >
                                @error('form.password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">{{ __('website.confirm_password') }}</label>
                                <input 
                                    type="password" 
                                    id="password_confirmation"
                                    class="form-control @error('form.password_confirmation') is-invalid @enderror" 
                                    placeholder="{{ __('website.confirm_password') }}" 
                                    wire:model="form.password_confirmation"
                                >
                                @error('form.password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('website.reset_password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end reset password -->
