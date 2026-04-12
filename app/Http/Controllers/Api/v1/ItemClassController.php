<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ItemClass;
use App\Services\ItemClassService;
use Illuminate\Http\Request;

class ItemClassController extends Controller
{
    protected $itemClassService;

    // Fixed the variable naming here to match
    public function __construct(ItemClassService $itemClassService) {
        $this->itemClassService = $itemClassService;
    }
  
    /**
     * Display a listing of Item Classes.
     */
    public function getAllItemClass() {
        return response()->json([
            'success' => true,
            // Changed 'itemCLass' to 'items' assuming your relationship name
            'data' => ItemClass::with('items')->get() 
        ]);
    }

    /**
     * Store a newly created Item Class.
     */
    public function createItemClass(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:item_class,name',
            'slug' => 'string|max:255|unique:item_class,slug',
            'isActive' => 'boolean'
        ]);

        $itemClass = $this->itemClassService->create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Item Class created successfully',
            'data' => $itemClass
        ], 201);
    }

    /**
     * Update the specified Item Class.
     */
    public function updateItemClass(Request $request, ItemClass $itemClass) {
      $validated = $request->validate([
          'name' => 'string|max:255|unique:item_class,name,' . $itemClass->id,
          'slug' => 'string|max:255|unique:item_class,slug,' . $itemClass->id,
          'isActive' => 'boolean'
      ]);

      $updated = $this->itemClassService->update($itemClass, $validated);
      return response()->json(['success' => true, 'data' => $updated]);
    }

    /**
     * Remove the specified Item Class.
     */
    public function deleteItemClass(ItemClass $itemClass) {
        $this->itemClassService->delete($itemClass);

        return response()->json([
            'success' => true,
            'message' => 'Item Class deleted successfully'
        ], 200);
    }
}