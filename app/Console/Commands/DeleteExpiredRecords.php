<?php

namespace App\Console\Commands;

use App\Models\Career;
use Illuminate\Console\Command;

class DeleteExpiredRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'records:delete-expired-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records with lastDate matching the current date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Career::deleteRecordsWithCurrentDate();
        $this->info('Expired records deleted successfully');
    }
}
