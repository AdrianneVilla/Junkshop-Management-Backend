<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ItemClass;
use App\Services\ItemClassService;
use Illuminate\Http\Request;

class ItemClassController extends Controller
{
  protected $service;

  public function __construct(ItemClassService $service) {
    $this->service = $service;
  }
  
  public function index() {
  return response()->json($this->service->getAll());
  }
}
