<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService) {
      $this->userService = $userService;
    }

    /**
     * Get all user
     */
    public function getAllUser(){
      $user = $this->userService->getAll();

      return response()->json([
        'success' => true,
        'message' => 'User retrieved successfully',
        'user' => $user,
       ]);
    }

    /**
     * Create new user
     */
    public function createUser(Request $request){
      
      // Validation
      $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'middle_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8'
      ]);
      
      try {
        $user = $this->userService->create($validated);

        return response()->json([
          'success' => true,
          'message' => 'User created successfully',
          'data' => $user
        ], 201);
      } catch (\Exception $e) {
        Log::error("User Creation Error: ". $e->getMessage());

        return response()->json([
          'success' => false,
          'message' => 'Failed to create user.'
        ], 500);
      }       
    }

    /**
     * Update existing user
     */
    public function updateUser(Request $request, User $user) {
      $validated = $request->validate([
        'first_name' => 'string|max:255',
        'last_name' => 'string|max:255',
        'email' => 'email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8',
        ]);

        try {
          $updatedUser = $this->userService->update($user, $validated);

          return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $updatedUser
          ], 200);

        } catch (\Exception $e) {
          Log::error("User Update Error: " . $e->getMessage());
            
          return response()->json([
            'success' => $e->getMessage(),
            'message' => $e->getLine()
          ], 400);
        }
    }

    public function deleteUser(User $user) {
    $this->userService->delete($user);

    return response()->json([
        'success' => true,
        'message' => 'User deleted successfully'
    ]);
}
  
}
