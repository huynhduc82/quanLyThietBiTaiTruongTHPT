<?php

namespace App\Console\Commands\Courses;

use App\Models\Courses\Courses;
use App\Models\Grades\Grade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class AddDefaultCourse extends Command
{
    protected $signature = 'course:import-course-default';

    protected $description = 'Add Default Course';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle() : bool
    {
        try {
            $grades = Grade::get()->pluck('id');
            $courseDefault = [
                'Toán',
                'Vật Lý',
                'Hóa Học',
                'Ngữ Văn',
                'Lịch Sử',
                'Địa Lí',
                'Sinh Học',
                'Tiếng Anh',
                'Giáo Dục Công Dân',
                'Công Nghệ',
                'Giáo Dục Quốc Phòng',
                'Giáo Dục Thể Chất',
                'Tin Học',
            ];
            $result = [];
            foreach ($courseDefault as $cour)
            {
                foreach ($grades as $grade)
                {
                    $result[] = ['name' => $cour, 'grade_id' => $grade];
                }
            }
            $this->output->title('Starting import Default Course');
            DB::beginTransaction();
            Courses::insert($result);
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

