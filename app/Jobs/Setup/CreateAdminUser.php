<?php

declare(strict_types=1);

namespace App\Jobs\Setup;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreateAdminUser
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function beforeCommit() {}

    public function afterCommit() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var array<string, mixed> $admin */
        $admin = config('setup.admin');

        $user = User::firstOrCreate([
            'email' => $admin['email'],
        ], [
            'name' => $admin['name'],
            'password' => bcrypt($admin['password']),
        ]);

        $user->email_verified_at = now();
        $user->save();
    }
}
