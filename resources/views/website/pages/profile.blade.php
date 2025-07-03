<div>
    <section class="blog_pages">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Breadcrumb -->
                    <ul class="breadcrumb bg-light mb-4">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="fa fa-home"></i> {{ __('website.home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('website.profile') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ session('success') }}
                            {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            {{ session('error') }}
                            {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                        </div>
                    @endif

                    @if($success_message)
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ $success_message }}
                            {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                        </div>
                    @endif

                    <div class="card shadow-sm mb-5">
                        <div class="card-body p-4">
                            <h2 class="h4 font-weight-bold mb-3">{{ __('website.profile_information') }}</h2>
                            <p class="text-muted mb-4">{{ __('website.update_your_profile') }}</p>

                            <div class="row">
                                <!-- Profile Image -->
                                <div class="col-md-4 text-center mb-4 mb-md-0">
                                    <div class="mb-3 position-relative"
                                         style="width: 150px; height: 150px; margin: 0 auto;">
                                        <!-- Preview Image (shown when a new image is selected) -->
                                        @if($temp_image)
                                            <img src="{{ $temp_image }}" alt="Preview"
                                                 class="img-fluid rounded-circle w-100 h-100"
                                                 style="object-fit: cover; border: 3px solid #0d6efd;">
                                            <!-- Existing Profile Image -->
                                        @elseif($image_path)
                                            <img src="{{ asset($image_path) }}" alt="Profile Image"
                                                 class="img-fluid rounded-circle w-100 h-100"
                                                 style="object-fit: cover; border: 3px solid #0d6efd;">
                                            <!-- Default Avatar -->
                                        @else
                                            <div
                                                class="rounded-circle bg-light w-100 h-100 d-flex align-items-center justify-content-center"
                                                style="border: 3px solid #0d6efd;">
                                                <span
                                                    class="text-muted display-4">{{ strtoupper(substr($name, 0, 1)) }}</span>
                                            </div>
                                        @endif

                                        <!-- Loading Spinner (initially hidden) -->
                                        <div class="position-absolute top-50 start-50 translate-middle"
                                             style="display: none;" id="imageLoading">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <input type="file" wire:model="image" class="d-none" id="profile_image"
                                               accept="image/*">
                                        <label for="profile_image" class="btn btn-primary btn-sm cursor-pointer"
                                               style="cursor: pointer;">
                                            <i class="fa fa-camera me-1"></i> {{ __('website.change_photo') }}
                                        </label>
                                        @if($image)
                                            <div
                                                class="small text-muted mt-2">{{ $image->getClientOriginalName() }}</div>
                                        @endif
                                        @error('image')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Add Livewire and JavaScript for image preview -->
                                    @push('scripts')
                                        <script>
                                            document.addEventListener('livewire:load', function () {
                                                // Show loading spinner when image is being processed
                                                document.getElementById('profile_image').addEventListener('change', function () {
                                                    document.getElementById('imageLoading').style.display = 'block';
                                                });

                                                // Hide loading spinner when preview is updated
                                                window.addEventListener('image-preview-updated', () => {
                                                    document.getElementById('imageLoading').style.display = 'none';
                                                });
                                            });
                                        </script>
                                    @endpush
                                </div>

                                <!-- Profile Form -->
                                <div class="col-md-8">
                                    <form wire:submit.prevent="updateProfile">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('website.name') }}</label>
                                            <input type="text" id="name" wire:model="name"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="email" class="form-label">{{ __('website.email') }}</label>
                                            <input type="email" id="email" wire:model="email"
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save me-1"></i> {{ __('website.save_changes') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="h4 font-weight-bold mb-3">{{ __('website.update_password') }}</h2>
                            <p class="text-muted mb-4">{{ __('website.update_password_description') }}</p>

                            <form wire:submit.prevent="updatePassword">
                                <div class="mb-3">
                                    <label for="current_password"
                                           class="form-label">{{ __('website.current_password') }}</label>
                                    <input type="password" id="current_password" wire:model="current_password"
                                           class="form-control @error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_password"
                                           class="form-label">{{ __('website.new_password') }}</label>
                                    <input type="password" id="new_password" wire:model="new_password"
                                           class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="new_password_confirmation"
                                           class="form-label">{{ __('website.confirm_new_password') }}</label>
                                    <input type="password" id="new_password_confirmation"
                                           wire:model="new_password_confirmation" class="form-control">
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-key me-1"></i> {{ __('website.update_password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
