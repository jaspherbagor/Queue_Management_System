<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;
use Illuminate\Support\Carbon;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This backups the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get DB credentials from .env
        $dbHost = env('DB_HOST');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');

        // Define the backup file name with timestamp
        $fileName = 'db-backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = storage_path('app/backup-temp/' . $fileName);

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
