<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class EnsureAdminCommand extends Command
{
    protected $signature = 'admin:ensure';

    protected $description = 'Create or update the bootstrap admin user from config (ADMIN_* env vars).';

    public function handle(): int
    {
        $email = config('admin.email');
        $plainPassword = config('admin.password');
        $name = config('admin.name', 'Admin');
        $role = config('admin.role', 'admin');

        if (! is_string($email) || $email === '') {
            $this->error('ADMIN_EMAIL is required (set in environment / config).');

            return self::FAILURE;
        }

        if (! is_string($plainPassword) || $plainPassword === '') {
            $this->error('ADMIN_PASSWORD is required (set in environment / config).');

            return self::FAILURE;
        }

        if ($role !== 'admin') {
            $this->warn('ADMIN_ROLE is not "admin"; the ensured user will still receive panel access (is_admin = true) because this command manages the bootstrap administrator.');
        }

        $user = User::query()->firstOrNew(['email' => $email]);
        $isNew = ! $user->exists;

        $user->name = is_string($name) && $name !== '' ? $name : 'Admin';
        $user->is_admin = true;

        if ($isNew) {
            $user->password = $plainPassword;
        } elseif (! Hash::check($plainPassword, $user->password)) {
            $user->password = $plainPassword;
        }

        $user->save();

        if ($isNew) {
            $this->info("Admin user created for [{$email}].");
        } else {
            $this->info("Admin user updated for [{$email}].");
        }

        return self::SUCCESS;
    }
}
