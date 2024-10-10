<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'user_posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid_post',
        'user_post_user_uuid',
        'user_post_description',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'post_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_post_user_uuid', 'uuid');
    }

    static function boot(): void
    {
        parent::boot();

        static::creating(function ($user) {
            $user->uuid_post = (string) Str::uuid();
            $user->created_by = Auth::user()->uuid;
            $user->created_at = now();
        });

        static::updating(function ($user) {
            $user->updated_by = Auth::user()->uuid;
            $user->updated_at = now();
        });
    }
}
