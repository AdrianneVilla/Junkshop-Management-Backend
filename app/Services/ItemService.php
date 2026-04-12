<?php

namespace App\Services;

use App\Models\Item;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Log;

class ItemService {

  /**
   * Create new item
   */
  public function create(array $data) {
    $item = Item::create($data);
    ActivityLogService::log(
      'Inventory Management',
      'CREATE',
      "Created new item: {$item->name}",
      null,
      $item->toArray()
    );
  }

  /**
   * Update existing item
   */
  public function update(Item $item, array $data) {
    $oldData = $item->toArray();
    $item->update($data);

    ActivityLogService::log(
      'Inventory Management',
      'UPDATE',
      "Updated item: {$item->name}",
      $oldData,
      $item->fresh()->toArray(),
    );

    return $item;
  }

  /**
   * Delete an item
   */
  public function delete(Item $item) {
    $oldData = $item->toArray();
    $itemName = $item->name;

    ActivityLogService::log(
      'Inventory Management',
      'DELETE',
      "Deleted item: {$itemName}",
      $oldData,
      null
    );

    return $item->delete();
    }

}
