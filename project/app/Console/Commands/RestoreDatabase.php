<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RestoreDatabase extends Command
{
    protected $signature = 'restore:database {file}';
    protected $description = 'Restore the database from a backup file';

    public function handle()
    {
        // Get DB credentials from .env
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Get the backup file from the command argument
        $fileName = $this->argument('file');
        $filePath = storage_path('app/backup/' . $fileName);

        // Check if the file exists
        if (!file_exists($filePath)) {
            $this->error("Backup file {$fileName} not found.");
            return;
        }

        // Command to restore the database
        $command = "mysql --user={$dbUser} --password={$dbPassword} --host={$dbHost} {$dbName} < {$filePath}";

        // Execute the command
        $result = null;
        $output = [];
        exec($command, $output, $result);

        // Check if restore was successful
        if ($result === 0) {
            $this->info('Database restored successfully.');
        } else {
            $this->error('Database restore failed.');
        }
    }
}
