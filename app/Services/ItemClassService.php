<?php
namespace App\Services;

use App\Models\ItemClass;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Log;

class ItemClassService
{

  /**
   * Get all class
   */
  public function getAll() {
    return ItemClass::orderBy('name')->get();
  }

  /**
   * Create new class
   */
  public function create(array $data) {

    $itemClass = ItemClass::create($data);
    

    ActivityLogService::log(
      'Class Management',
      'CREATE',
      "Create new class {$itemClass->name}",
      null,
      $itemClass->toArray()
    );

    return $itemClass;
  }

  /**
   * Update existing class
   */
  public function update(ItemClass $itemClass, array $data) {
    $oldData = $itemClass->toArray();

    $itemClass->update($data);

    ActivityLogService::log(
      'Class Management',
      'UPDATE',
      "Updated class: {$itemClass->name}",
      $oldData,
      $itemClass->fresh()->toArray()
    );

    return $itemClass;
  }

  /**
   * Delete class
   */
  public function delete(ItemClass $itemClass) {

    ActivityLogService::log(
      'Class Management',
      'DELETE',
      "Deleted class: {$itemClass->name}",
      $itemClass->toArray(),
      null
    );

    return $itemClass->delete();
  }
}