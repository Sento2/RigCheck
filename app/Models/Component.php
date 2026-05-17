<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'price', 'wattage', 'spesifikasi'];

    // Casting kolom spesifikasi (JSON) agar otomatis menjadi Array di Laravel
    protected $casts = [
        'spesifikasi' => 'array',
    ];

    // Relasi Many-to-Many balik ke Rig
    public function rigs()
    {
        return $this->belongsToMany(Rig::class, 'component_rig')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}