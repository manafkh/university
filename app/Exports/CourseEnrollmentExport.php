<?php

namespace App\Exports;


use App\Models\CourseEnrollment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
class CourseEnrollmentExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($id)
    {
        $this->id = $id ;
    }

    public function view(): View
    {
        return view('course_enrollments.export', [
            'courseEnrollments' =>DB::table('course_enrollment as C')
                ->join('courses as O','C.course_id','=','O.id')
                ->join('enrollments as E','E.id','=','C.enrollment_id')
                ->join('students as S','S.id','=','E.student_id')
                ->select(['E.ExamNumber' ,'S.first_name' ,'S.last_name' , 'S.father_name','O.term_id' ,'mid_grade','C.th_Grade','C.final_Grade'])
                ->where('O.id','=',$this->id)
                ->where('E.enroll_year','=',date('Y'))
                ->get()
        ]);
    }
}
