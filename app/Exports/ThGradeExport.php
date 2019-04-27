<?php

namespace App\Exports;

use App\Models\CourseEnrollment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ThGradeExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('course_enrollments.exportTh', [
            'courseEnrollments' =>DB::table('course_enrollment as C')
        ->join('courses as O','C.course_id','=','O.id')
        ->join('enrollments as E','E.id','=','C.enrollment_id')
        ->join('students as S','S.id','=','E.student_id')
        ->select(['E.ExamNumber' ,'S.first_name' ,'S.last_name' , 'S.father_name' ,'C.th_Grade'])
        ->where('O.id','=',$this->id)
        ->where('E.enroll_year','=',date('Y'))
        ->get()

//                CourseEnrollment::select(['enrollment_id', 'course_id', 'th_Grade'])->where('course_id', $this->id)->get()
        ]);
    }
}