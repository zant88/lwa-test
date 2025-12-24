<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    public function toArray($request): array 
    {
        $canEdit = false;
        $currentUser = Auth::user();

        if ($currentUser) {
            if ($currentUser->role === 'admin') {
                $canEdit = true;
            }elseif ($currentUser->role === 'manager') {
                $canEdit = true;
            }elseif ($currentUser->role == $this->id) {
                $canEdit = true;
            }
        }

        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'role' => $this->role,
            'created_at' => $this->created_at->toIso8601String(),
            'orders_count' => (int) $this->ordersd_count,
            'can_edit' => $canEdit
        ];
    }
}