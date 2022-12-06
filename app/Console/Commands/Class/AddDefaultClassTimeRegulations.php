<?php

namespace App\Console\Commands\Class;

use App\Models\Class\ClassTimeRegulations;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class AddDefaultClassTimeRegulations extends Command
{
    protected $signature = 'class:import-class-time-regulations';

    protected $description = 'Add Default Class Time Regulations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() : bool
    {
        try {
            $classTimeRegulations = [
                1 => ['start' => '7:00', 'end' => '7:45'],
                2 => ['start' => '7:45', 'end' => '8:30'],
                3 => ['start' => '8:30', 'end' => '9:15'],
                4 => ['start' => '9:30', 'end' => '10:15'],
                5 => ['start' => '10:15', 'end' => '11:00'],
                6 => ['start' => '11:00', 'end' => '11:45'],
                7 => ['start' => '12:30', 'end' => '13:15'],
                8 => ['start' => '13:15', 'end' => '14:00'],
                9 => ['start' => '14:00', 'end' => '14:45'],
                10 => ['start' => '15:00', 'end' => '15:45'],
                11 => ['start' => '15:45', 'end' => '16:30'],
                12 => ['start' => '16:30', 'end' => '17:15'],
            ];
            $this->output->title('Starting import');
            DB::beginTransaction();
            $lesson = 1;
            foreach ($classTimeRegulations as $classTimeRegulation)
            {
                $param = ['lesson' => $lesson, 'start' => $classTimeRegulation['start'], 'end' => $classTimeRegulation['end']];
                ClassTimeRegulations::query()->firstOrCreate($param);
                $lesson++;
            }
            DB::commit();
            $this->output->success('Import successful');
            return true;
        } catch (Exception $e)
        {
            DB::rollBack();
            $this->error('Error Exception: ' . $e->getMessage());

            return false;
        }
    }
}
