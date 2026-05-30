<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'Buat user baru';

    public function handle(): void
    {
        $name     = $this->ask('Nama');
        $email    = $this->ask('Email');
        $password = $this->secret('Password');

        if (User::where('email', $email)->exists()) {
            $this->error("Email '{$email}' sudah terdaftar!");
            return;
        }

        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => $password,
        ]);

        $this->info("User '{$name}' berhasil dibuat.");
    }
}