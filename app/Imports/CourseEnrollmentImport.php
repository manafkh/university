<?php

namespace App\Imports;

use App\Models\CourseEnrollment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseEnrollmentImport implements ToCollection, WithHeadingRow
{
    private $course_id;

    /**
     * @param $course_id
     */
    public function __construct($course_id)
    {
     $this->course_id =$course_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
            DB::table('course_enrollment as C')
                ->join('courses as O','C.course_id','=','O.id')
                ->join('enrollments as E','E.id','=','C.enrollment_id')
                ->join('students as S','S.id','=','E.student_id')
                ->select(['E.ExamNumber' ,'S.first_name' ,'S.last_name' , 'S.father_name' ,'C.mid_grade'])
                ->where('E.ExamNumber','=',$row['exam_number'])
                ->where('C.course_id','=',$this->course_id)
                ->where('E.enroll_year','=',date('Y'))
                ->update(['C.mid_grade' => $row['mid_grade'],
                        'C.th_Grade' => $row['th_grade'],
                        'C.final_Grade'=> $row['final_grade']]);
    }
}
