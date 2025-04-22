<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name'];

      public static function seedDefault()
      {
          $defaultCategories = [
                'Fashion',
                'Alam / Nature',
                'Funny Pets',
                'gallery',
              
          ];
  
          foreach ($defaultCategories as $name) {
              self::firstOrCreate(['name' => $name]);
          }
      }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
