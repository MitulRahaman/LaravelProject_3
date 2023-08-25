<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class Problem extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'attachment', 'user_id', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
