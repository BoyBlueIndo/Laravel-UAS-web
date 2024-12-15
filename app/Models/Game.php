<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Game extends Model
{
    protected $table = 'game';

    protected $fillable = ['judul', 'genre', 'stok'];

    public function peminjaman(): HasMany
{
    return $this->hasMany(Peminjaman::class, 'game_id', 'id');
}
}
