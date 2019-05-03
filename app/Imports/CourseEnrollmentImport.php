<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Term;
use App\TermCourse;
use App\TermCourseStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseEnrollmentImport implements ToCollection, WithHeadingRow
{
    private $course;
    private $nextStatus;

    /**
     * @param $course
     * @param $nextStatus
     */
    public function __construct($course, $nextStatus)
    {
         $this->course = $course;
         $this->nextStatus = $nextStatus;
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
                ->where('C.course_id','=',$this->course->id)
                ->where('E.enroll_year','=',date('Y'))
                ->update(['C.mid_grade' => $row['mid_grade'],
                        'C.th_Grade' => $row['th_grade'],
                        'C.final_Grade'=> $row['final_grade']]);

        $currentTerm = Term::where('is_active', true)->first();
        $currentTermCourse = $this->course->GetTermCourse();
        $currentTermCourse->update(['status' => $this->nextStatus]);
        if ($this->nextStatus == TermCourseStatus::FINAL) {
            $termCourses = TermCourse::where('term_id', $currentTerm->id)
                ->where('academic_year', date('Y'))->get();
            $termEnded = true;
            foreach ($termCourses as $termCourse) {
                if ($termCourse->status != TermCourseStatus::FINAL) {
                    $termEnded = false;
                    break;
                }
            }
            if ($termEnded) {
                $currentTerm->update(['is_active'=>false]);
                $nextTerm = Term::find($currentTerm->next_term_id);
                $nextTerm->update(['is_active'=>true]);
                $courses = null;
                if ($nextTerm->is_strict) {
                    $courses = Course::where('term_id', $nextTerm->id)->get();
                } else {
                    $courses = Course::all();
                }
                foreach ($courses as $course) {
                    TermCourse::create(['course_id'=>$course->id,
                        'term_id'=>$nextTerm->id]);
                }
            }
        }
    }
}
