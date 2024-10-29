<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'This command backs up the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Database credentials
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Define backup file name and path
        $fileName = 'db-backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/backup-temp/' . $fileName);

        // MySQL dump command
        $command = "mysqldump --user={$dbUser} --password={$dbPassword} --host={$dbHost} {$dbName} > {$filePath}";

        // Execute command
        $result = null;
        exec($command, $output, $result);

        // Confirm backup success or failure
        if ($result === 0) {
            $this->info('Database backup completed successfully.');
            return $filePath; // Optional for debugging
        } else {
            $this->error('Database backup failed.');
            return false;
        }
    }
}
