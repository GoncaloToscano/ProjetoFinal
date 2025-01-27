<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TestDrive;

class CleanUpExpiredTestDrives extends Command
{
    /**
     * O nome e a assinatura do comando.
     *
     * @var string
     */
    protected $signature = 'testdrives:cleanup';

    /**
     * A descrição do comando.
     *
     * @var string
     */
    protected $description = 'Remove todos os Test Drives cuja data e hora já passaram.';

    /**
     * Executa o comando.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();

        // Busca e deleta todos os Test Drives com data e hora já expiradas
        $deletedCount = TestDrive::where(function ($query) use ($now) {
            $query->where('preferred_date', '<', $now->toDateString())
                  ->orWhere(function ($q) use ($now) {
                      $q->where('preferred_date', '=', $now->toDateString())
                        ->where('preferred_time', '<', $now->format('H:i'));
                  });
        })->delete();

        $this->info("Test Drives expirados removidos: {$deletedCount}");
        \Log::info("Test Drives expirados removidos: {$deletedCount}");

        return Command::SUCCESS;
    }
}
