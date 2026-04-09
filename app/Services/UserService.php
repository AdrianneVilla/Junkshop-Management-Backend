<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Services\ActivityLogService;

class UserService
{
  /**
   * Handle to get all user
   */
  public function getAll() {

    // Get first the newest created
    return User::latest()->get();
  }

  /**
   * Create new user
   */
  public function create(array $data) {

    // Hash password
    $data['password'] = Hash::make($data['password']);

    return User::create($data);

    $fullName = "$user->first_name $user->middle_name $user->last_name";

    ActivityLogService::log(
      'User Management',
      'CREATE',
      "Created new user: {$full_name}",
      null,
      $user->toArray()
    );

  }

  /**
   * Find a user by their email or a partial name match.
   */
  public function search($query) {
    return User::where('email', $query)
      ->orWhere('first_name', 'LIKE', "%{$query}%")
      ->orWhere('last_name', 'LIKE', "%{$query}%")
      ->get();
  }

  /**
   * Update existing user
   */
  public function update(User $user, array $data) {

    $oldData = $user->toArray();

    // Hash password if being changed
    if(isset($data['password']) && !empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    } else {
      unset($data['password']);
    }

    $user->update($data);

    ActivityLogService::log(
      'User Management',
      'UPDATE',
      "Updated user ID: {$user->email}",
      $oldData,
      $user->fresh()->toArray()
    );

    return $user;
  }

  /**
   * Delete user
   */
  public function delete(User $user) {

    $fullName = "$user->first_name $user->middle_name $user->last_name";
    
    ActivityLogService::log(
      'User Management',
      'DELETE',
      "Deleted user: {$fullName}",
      $user->toArray(),
      null
    );

    return $user->delete();
  }

}