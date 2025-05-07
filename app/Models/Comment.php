<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $news_id
 * @property integer $customer_id
 * @property integer $parent_id
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 * @property Customer $customer
 * @property News $news
 * @property Comment $comment
 */
class Comment extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['news_id', 'customer_id', 'parent_id', 'comment', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function news()
    {
        return $this->belongsTo('App\Models\News');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }
}
