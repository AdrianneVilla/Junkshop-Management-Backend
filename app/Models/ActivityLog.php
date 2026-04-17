<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model {
  
  /**
   * Create new user
   */
  protected $fillable = [
      'user_id',
      'action',
      'module',
      'description',
      'old_values',
      'new_values',
      'ip_address',
  ];

  /**
   * Converts json into PHP arrays
   */
  protected $casts =[
    'old_values' => 'array',
    'new_values' => 'array',
  ];

  /**
   * Get user who performed action
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

}