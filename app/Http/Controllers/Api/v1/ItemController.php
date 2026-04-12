<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller {
  
  protected $itemService;

  public function __construct(ItemService $itemService) {
    $this->itemService = $itemService;
  }

  public function getAllItems() {
    return response()->json([
      'success' => true,
      'data' => Item::with('itemClass')->get()
    ]);
  }

  /**
   * Create new user
   */
  public function createItem(Request $request) {
    
    // Validation
    $validated = $request->validate([
      'item_class_id' => 'required|exists:item_class,id',
      'name' => 'required|string|max:255',
      'unit_price' => 'required|numeric|min:0',
      'stock_quantity' => 'required|numeric|min:0'
    ]);

    try {
      $item = $this->itemService->create($validated);

      return response()->json([
        'success' => true,
        'message' => 'Item created successfully',
        'data' => $item
      ], 201);
    } catch (\Exception $e) {
      Log::error('Item Creation Error:'. $e->getMessage());
      
      return response()->json([
        'success' => false,
        'message' => "Failed to create item" . $e->getMessage(),
      ], 500);
    };
  }

  /**
   * Update existing item
   */
  public function updateItem(Request $request, Item $item) {
    $validated = $request->validate([
      'item_class_id' => 'required|exist:item_class, id',
      'name' => 'required|string|max:255' . $item->id,
      'unit_price' => 'required|numeric|min:0',
      'stock_quantity' => 'required|numeric|min:0'
    ]);

    try {
      $updateItem = $this->itemService->update($item, $validated);

      return response()->json([
        'success' => true,
        'message' => 'User updated successfully',
        'data' => $updatedItem
      ], 200);

    } catch (\Exception $e) {
      Log::error("Item update error: " . $e->getMessage());

      return response()->json([
        'success' => $e->getMessage(),
        'message' => $e->getLine()
      ], 400);
    }
  }

  /**
   * Delete item
   */
  public function deleteItem(Item $item) {
    $this->itemService->delete($item);

    return response()->json([
      'success' => true,
      'message' => 'Item deleted successfully'
    ]);
  }
}