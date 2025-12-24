<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\NotificationService;

class UserService 
{
    public function __construct(
        private NotificationService $notificationService
    )
    {
        
    }
    public function createUser(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        // Send registration notifications
        $this->notificationService->sendUserRegistrationNotification($user);

        return $user;
    }

    public function getUsers(array $filters): LengthAwarePaginator
    {
        $query = User::query()
            ->where('active', true)
            ->withCount('orders');
        
        if (!empty($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        $sortBy = $filters['sortBy'] ?? 'created_at';
        $query->orderBy($sortBy, 'desc');

        return $query->paginate(config('pagination.per_page', 15));
    }
}