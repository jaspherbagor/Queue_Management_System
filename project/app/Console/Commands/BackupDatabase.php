<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the database';

    public function handle()
    {
        // Get DB credentials from .env
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Define the backup file name with timestamp
        $fileName = 'database-backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/backups/' . $fileName);

        // Command to back up the database using mysqldump
        $command = "mysqldump --user={$dbUser} --password={$dbPassword} --host={$dbHost} {$dbName} > {$filePath}";

        // Execute the command
        $result = null;
        $output = [];
        exec($command, $output, $result);

        // Check if backup was successful
        if ($result === 0) {
            $this->info('Database backup completed successfully.');
        } else {
            $this->error('Database backup failed.');
        }
    }
}
