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
                4 => ['start' => '9:45', 'end' => '10:30'],
                5 => ['start' => '10:30', 'end' => '11:15'],
                6 => ['start' => '12:30', 'end' => '13:15'],
                7 => ['start' => '13:15', 'end' => '14:00'],
                8 => ['start' => '14:30', 'end' => '15:15'],
                9 => ['start' => '16:00', 'end' => '16:45'],
            ];
            $this->output->title('Starting import Class Time Regulations');
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
