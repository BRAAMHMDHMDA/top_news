<?php

namespace App\Policies;

use App\Models\User;
use TomatoPHP\FilamentTranslations\Models\Translation;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrowserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('page_Browser');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->can('page_Browser');
    }


}
