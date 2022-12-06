<?php

namespace App\Console\Commands\Grade;

use App\Models\Grades\Grade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class AddDefaultGrade extends Command
{
    protected $signature = 'grade:import-default-grade';

    protected $description = 'Add Default Grade';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() : bool
    {
        try {
            $grade = [10,11,12];
            $this->output->title('Starting import Default Grade');
            DB::beginTransaction();
            foreach ($grade as $g)
            {
                $param = ['name' => $g];
                Grade::query()->firstOrCreate($param);
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
