<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Enrollment;
use App\Models\Term;
use App\TermCourse;
use App\Enums\TermCourseStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseEnrollmentImport implements ToCollection, WithHeadingRow
{
    private $course;
    private $termCourse;
    private $currentTerm;
    private $nextStatus;

    /**
     * @param $course
     * @param $termCourse
     * @param $currentTerm
     * @param $nextStatus
     */
    public function __construct($course, $termCourse, $currentTerm, $nextStatus)
    {
         $this->course = $course;
         $this->termCourse = $termCourse;
         $this->currentTerm = $currentTerm;
         $this->nextStatus = $nextStatus;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $enrollment = Enrollment::where('ExamNumber', $row['exam_number'])
                ->where('enroll_year', date('Y'))->first();

            $course_enrollment = CourseEnrollment::where('enrollment_id', $enrollment->id)
                ->where('course_id', $this->course->id)->first();

            switch ($this->nextStatus) {
                case TermCourseStatus::MID_GRADES:
                    $course_enrollment->update(['mid_grade'=>$row['mid_grade']]);
                    break;
                case TermCourseStatus::FINAL:
                    $course_enrollment->update(['th_Grade'=>$row['th_grade'],
                        'final_Grade'=>$row['th_grade'] + $course_enrollment->mid_grade]);
                    break;
            }
        }

        $this->termCourse->update(['status' => $this->nextStatus]);
        $termCourses = TermCourse::where('term_id', $this->currentTerm->id)
            ->where('academic_year', date('Y'))->get();
        $shouldChangeStatus = true;
        $nextTermStatus = $this->currentTerm->status + 1;
        foreach ($termCourses as $termCourse) {
            if ($termCourse->status != $nextTermStatus) {
                $shouldChangeStatus = false;
                break;
            }
        }

        if ($shouldChangeStatus) {
            $this->currentTerm->update(['status'=>$nextTermStatus]);
            if ($nextTermStatus == TermCourseStatus::FINAL) {
                $nextTerm = Term::find($this->currentTerm->next_term_id);
                $nextTerm->update(['status'=>TermCourseStatus::INIT]);
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
