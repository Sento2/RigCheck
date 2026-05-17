<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rig extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'ai_analysis_result'];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-Many ke Component (Tabel Pivot)
    public function components()
    {
        return $this->belongsToMany(Component::class, 'component_rig')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}