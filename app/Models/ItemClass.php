<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Models\Item;

class ItemClass extends Model
{

  use HasFactory;
  
  protected $table = 'item_class';
  protected $fillable = [
    "name",
    "slug",
    "is_active"
  ];

  // Automatically generate slug when name is set
  protected static function boot() {
    parent::boot();
    static::creating(fn ($model) => $model->slug = Str::slug($model->name));
  }

  // Scope for dropdown
  public function scopeActive($query) {
    return $query->where('is_active', true);
  }

  public function items(){
    return $this->hasMany(Item::class);
  }
}

