<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Logger\CustomLogger;

class FirstCommandLine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:first-command-line';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('This is the first command line');
        Log::info('This is the first command line to learn');
        Log::channel('custom_log')->info('This is the first command line to learn');
        CustomLogger::info('Start Log');
        CustomLogger::info('This is the first command line to learn');
        CustomLogger::debug('This is the first command line to learn');
        CustomLogger::error('This is the first command line to learn');
        CustomLogger::notice('This is the first command line to learn');
        CustomLogger::warning('This is the first command line to learn');
        CustomLogger::alert('This is the first command line to learn');
        CustomLogger::critical('This is the first command line to learn');
        CustomLogger::emergency('This is the first command line to learn');

        $this->info('Execution end');
        return 0;
    }
}
