<?php

namespace App\Jobs;

use App\Http\Controllers\EnrollmentController;
use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * @property  enrollmentRepository
 */
class GiveExamNumber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $enrollment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {


        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enrollments = Enrollment::where('enroll_year',date('Y'))->get();

        foreach ($enrollments as $enrollment) {
            static $i, $s, $t, $f, $fo;
            switch ($enrollment->year_id) {
                case 1:
                    $enrollment['ExamNumber'] = $enrollment->year_id * 10000 + $i++;

                    break;
                case 2:
                    $enrollment['ExamNumber'] = $enrollment->year_id * 10000 + $s++;
                    break;
                case 3 :
                    $enrolment['ExamNumber'] = $enrollment->year_id * 10000 + $t++;
                    break;
                case 4:
                    $enrollment['ExamNumber'] = $enrollment->year_id * 10000 + $fo++;
                    break;
                case 5:
                    $enrollment['ExamNumber'] = $enrollment->year_id * 10000 + $f++;
                    break;

            }
            $enrollment->save();

        }
    }
}
