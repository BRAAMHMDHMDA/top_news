<?php

namespace App\Http\Livewire\Website;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $image;
    public $image_path;
    public $temp_image;
    public $success_message;
    public $error_message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'current_password' => 'nullable|string|min:8',
        'new_password' => 'nullable|string|min:8|confirmed',
        'image' => 'nullable|image|max:2048', // 2MB max
    ];

    protected $listeners = ['profileImageUpdated' => '$refresh'];

    public function mount(): void
    {
        $user = Auth::guard('customer')->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image_path = $user->image_path;
    }

    public function updatedImage()
    {
        $this->validateOnly('image');

        // Generate a temporary URL for preview
        $this->temp_image = $this->image->temporaryUrl();

        // Refresh the component to show the preview
        $this->dispatch('image-preview-updated');
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers,email,' . Auth::guard('customer')->id(),
        ]);

        $user = Auth::guard('customer')->user();
        $user->name = $this->name;
        $user->email = $this->email;

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($user->image_path && file_exists(public_path($user->image_path))) {
                unlink(public_path($user->image_path));
            }

            $imagePath = $this->image->store('customers', 'public');
            $user->image_path = $imagePath;
            $this->image_path = $user->image_path;
        }

        $user->save();

        $this->success_message = 'Profile updated successfully!';
        $this->resetErrorBag();
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::guard('customer')->user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The provided password does not match your current password.');
            return;
        }

        $user->password = Hash::make($this->new_password);
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->success_message = 'Password updated successfully!';
        $this->resetErrorBag();
    }

    public function render(): View
    {
        return view('website.pages.profile')
            ->layout('website.layout.master', [
                'title' => __('website.my-profile')
            ]);
    }
}
