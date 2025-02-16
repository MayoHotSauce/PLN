<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
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
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Masukkan nama user:');
        $email = $this->ask('Masukkan email:');
        $password = $this->secret('Masukkan password:');
        $role = $this->choice(
            'Pilih role user:',
            ['admin', 'petugas'],
            'petugas'
        );

        // Validasi input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Buat user baru
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role
            ]);

            $this->info('User berhasil dibuat!');
            $this->table(
                ['Name', 'Email', 'Role'],
                [[$name, $email, $role]]
            );
        } catch (\Exception $e) {
            $this->error('Terjadi kesalahan saat membuat user!');
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
