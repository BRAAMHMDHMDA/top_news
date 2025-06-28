<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasImage;

    const STATUS_DRAFT = 'draft';
    const STATUS_ACTIVE = 'active';

    //status
    const HOME_TOP = 'home_top';
    const HOME_MIDDLE = 'home_middle';

    // positions ads
    const NEWS_PAGE = 'news_page';
    const VIEW_PAGE = 'view_page';
    const SIDE_BAR = 'side_bar';
    static string $DISK = 'public';
    static string $NAME_IMG_COL = 'image_path';
    protected $fillable = ['position', 'url', 'image', 'status', 'created_at', 'updated_at'];

}
