<?php

namespace App\Imports;

use App\Models\CourseEnrollment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ThGradeImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($course_id)
    {
        $this->id =$course_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
            DB::table('course_enrollment as C')
                ->join('courses as O','C.course_id','=','O.id')
                ->join('enrollments as E','E.id','=','C.enrollment_id')
                ->join('students as S','S.id','=','E.student_id')
                ->select(['E.ExamNumber' ,'S.first_name' ,'S.last_name' , 'S.father_name' ,'C.mid_grade'])
                ->where('E.ExamNumber','=',$row[0])
                ->where('C.course_id','=',$this->id)
                ->where('E.enroll_year','=',date('Y'))
                ->update([
                    'C.th_Grade' => $row[4]
                   ]);
    }
}
