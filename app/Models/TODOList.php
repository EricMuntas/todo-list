<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TODOList extends Model
{
    use HasFactory;
    protected $table = 'list'; // Nom de la taula
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
