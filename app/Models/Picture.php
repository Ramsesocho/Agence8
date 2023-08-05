<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    use HasFactory;
    protected $fillable=[
       'filename'
    ];

   /* public function getImageUrl(): string
    {   
        return storage::disk('public')->url($this->filename);
      
    }*/

    protected static function booted(): void
    {
        static::deleting(function (Picture $picture) {
            Storage::disk('public')->delete($picture->filename);
        });
    }

    public function getImageUrl(): string
{
    return asset('storage/' . $this->filename);
}
}
