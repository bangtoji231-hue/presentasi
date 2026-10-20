<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MakeUserAdmin extends Command
{
    protected $signature = 'users:make-admin {email : Email akun yang akan dijadikan admin}';

    protected $description = 'Memberikan akses admin kepada akun yang sudah terdaftar';

    public function handle(): int
    {
        $email = $this->argument('email');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Format email tidak valid.');

            return self::FAILURE;
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            if (! $this->confirm('User belum ada. Buat akun admin baru?', false)) {
                $this->error('User dengan email tersebut tidak ditemukan.');

                return self::FAILURE;
            }

            $name = trim((string) $this->ask('Nama admin'));
            $password = (string) $this->secret('Password admin (minimal 8 karakter)');
            $passwordConfirmation = (string) $this->secret('Konfirmasi password');
            $passwordValidator = Validator::make([
                'password' => $password,
                'password_confirmation' => $passwordConfirmation,
            ], [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if (blank($name) || $passwordValidator->fails()) {
                $this->error(blank($name) ? 'Nama admin wajib diisi.' : $passwordValidator->errors()->first('password'));

                return self::FAILURE;
            }

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
        }

        $user->is_admin = true;
        $user->save();

        $this->info("{$user->email} sekarang memiliki akses admin.");

        return self::SUCCESS;
    }
}
