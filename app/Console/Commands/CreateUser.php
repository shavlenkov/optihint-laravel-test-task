<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user by asking for last name, first name, email, and password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastName = $this->ask('Last Name');
        $firstName = $this->ask('First Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        if (!$lastName || !$firstName || !$email || !$password) {
            $this->error('All fields are required!');
            return;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists!');
            return;
        }

        $user = User::create([
            'last_name' => $lastName,
            'first_name' => $firstName,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        if ($user->save()) {
            $this->info('User created successfully!');
        } else {
            $this->error('Failed to create user.');
        }
    }
}
