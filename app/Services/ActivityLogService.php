<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogService {
  
  public static function log($module, $action, $description, $old = null, $new = null, ) {
    ActivityLog::create([
      'user_id' => Auth::id(), // Who is logged in
      'module' => $module,
      'action' => $action,
      'description' => $description,
      'old_values' => $old,
      'new_values' => $new,
      'ip_address' => request()->ip(),
    ]);
  }
}