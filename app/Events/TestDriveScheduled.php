<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestDriveScheduled
{
    use Dispatchable, SerializesModels;

    public $testDrive;

    /**
     * Crie uma nova instância do evento.
     *
     * @param $testDrive
     */
    public function __construct($testDrive)
    {
        $this->testDrive = $testDrive;
    }
}
