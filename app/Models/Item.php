<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemClass;

class Item extends Model {
  use HasFactory;
  

  protected $fillable = [
    'item_class_id',
    'name',
    'unit_price',
    'stock_quantity',
  ];

  /**
   * Decimal values come out as float or numbers
   */
  protected $casts = [
    'unit_price' => 'decimal:2',
    'stock_quantity' => 'decimal:2',
  ];

  /**
   * Get class that owns the item
   */
  public function itemClass() {
    return $this->belongsTo(ItemClass::class);
  }
}