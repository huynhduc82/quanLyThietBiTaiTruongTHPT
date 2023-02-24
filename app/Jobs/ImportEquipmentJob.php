<?php

namespace App\Jobs;

use App\Imports\EquipmentImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;;

class ImportEquipmentJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    private $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        Excel::import(new EquipmentImport(), $this->input);
        Storage::delete($this->input);
    }
}
