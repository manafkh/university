<?php

namespace App\Jobs;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class Registrarsuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $successes = DB::table('course_enrollment as C')
            ->join('enrollments as E','C.enrollment_id','=','E.id')
            ->selectRaw('E.id , COUNT(case when C.final_Grade  < 60 or C.final_Grade is null then 1 end) as t ,COUNT(C.course_id) as s ')
            ->groupBy('E.id')
            ->havingRaw('COUNT(case when C.final_Grade < 60 or C.final_Grade is null then 1 end) < 4 ')
            ->get();
        foreach ($successes as $success){
            $s[] = Enrollment::find($success->id);
        }
        $enrollments = $s;
        return view('enrollments.giveSuccess')->with('enrollments',$enrollments);


        //
    }
}
