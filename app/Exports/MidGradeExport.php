<?php

namespace App\Exports;

use App\Models\CourseEnrollment;
use function Complex\theta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class MidGradeExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id ;
    }

    public function view():View
    {


        return view('course_enrollments.exportMid', [
            'courseEnrollments'=> DB::table('course_enrollment as C')
                ->join('courses as O','C.course_id','=','O.id')
                ->join('enrollments as E','E.id','=','C.enrollment_id')
                ->join('students as S','S.id','=','E.student_id')
                ->select(['E.ExamNumber' ,'S.first_name' ,'S.last_name' , 'S.father_name' ,'C.mid_grade'])
                ->where('O.id','=',$this->id)
                ->where('E.enroll_year','=',date('Y'))
                ->get()
//                CourseEnrollment::select(['enrollment_id','course_id','mid_grade'])->where('course_id',$this->id)->get()
        ]);
    }
}
