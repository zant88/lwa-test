<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create a new admin user';

    public function handle()
    {
        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');
        $passwordConfirmation = $this->secret('Confirm admin password');

        if ($password !== $passwordConfirmation) {
            $this->error('Passwords do not match!');
            return 1;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists!');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Admin user created successfully!');
        $this->table(
            ['Name', 'Email', 'Role'],
            [[$user->name, $user->email, $user->role]]
        );

        return 0;
    }
}
