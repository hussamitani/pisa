<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\Setup\CreateAdminUser;
use Illuminate\Console\Command;

final class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dispatch_sync(new CreateAdminUser);
        $this->info('Created Admin Users');
    }
}
