<?php

namespace App\Http\Controllers;

use App\Exports\CourseEnrollmentExport;
use App\Exports\MidGradeExport;
use App\Exports\ThGradeExport;
use App\Http\Requests\CreateCourseEnrollmentRequest;
use App\Http\Requests\UpdateCourseEnrollmentRequest;
use App\Imports\CourseEnrollmentImport;
use App\Imports\MidGradeImport;
use App\Imports\ThGradeImport;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Enrollment;
use App\Models\Term;
use App\Repositories\CourseEnrollmentRepository;
use App\Enums\TermCourseStatus;
use App\TermCourse;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Importable;

class CourseEnrollmentController extends AppBaseController
{
    use Importable;
    /** @var  CourseEnrollmentRepository */
    private $courseEnrollmentRepository;

    public function __construct(CourseEnrollmentRepository $courseEnrollmentRepo)
    {
        $this->courseEnrollmentRepository = $courseEnrollmentRepo;
    }

    /**
     * Display a listing of the CourseEnrollment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $courseEnrollments = $this->courseEnrollmentRepository->all();
        return view('course_enrollments.index')
            ->with('courseEnrollments', $courseEnrollments);
    }

    /**
     * Show the form for creating a new CourseEnrollment.
     *
     * @return Response
     */
    public function create()
    {
        return view('course_enrollments.create');
    }

    /**
     * Store a newly created CourseEnrollment in storage.
     *
     * @param CreateCourseEnrollmentRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseEnrollmentRequest $request)
    {
        $input = $request->all();

        $courseEnrollment = $this->courseEnrollmentRepository->create($input);

        Flash::success('Course Enrollment saved successfully.');

        return redirect(route('courseEnrollments.index'));
    }

    /**
     * Display the specified CourseEnrollment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            Flash::error('Course Enrollment not found');

            return redirect(route('courseEnrollments.index'));
        }

        return view('course_enrollments.show')->with('courseEnrollment', $courseEnrollment);
    }

    /**
     * Show the form for editing the specified CourseEnrollment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            Flash::error('Course Enrollment not found');

            return redirect(route('courseEnrollments.index'));
        }

        return view('course_enrollments.edit')->with('courseEnrollment', $courseEnrollment);
    }

    /**
     * Update the specified CourseEnrollment in storage.
     *
     * @param int $id
     * @param UpdateCourseEnrollmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseEnrollmentRequest $request)
    {
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            Flash::error('Course Enrollment not found');

            return redirect(route('courseEnrollments.index'));
        }

        $courseEnrollment = $this->courseEnrollmentRepository->update($request->all(), $id);

        Flash::success('Course Enrollment updated successfully.');

        return redirect(route('courseEnrollments.index'));
    }

    /**
     * Remove the specified CourseEnrollment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            Flash::error('Course Enrollment not found');

            return redirect(route('courseEnrollments.index'));
        }

        $this->courseEnrollmentRepository->delete($id);

        Flash::success('Course Enrollment deleted successfully.');

        return redirect(route('courseEnrollments.index'));
    }

    public function select_course(){
        $currentTerm = Term::currentTerm();
        $courses = null;
        if ($currentTerm->is_strict) {
            $courses = Course::where('term_id', $currentTerm->id)->get();
        } else {
            $courses = Course::all();
        }
        return view('course_enrollments.select_course')->with('courses', $courses);
    }

    public function exam($id){

        $courseEnrollments = CourseEnrollment::
        where('course_id','=',$id)->
        where('final_Grade','<',60)->
        orwhere('final_Grade','=',null)->
        get();

        return view('course_enrollments.exam')->with('courseEnrollments',$courseEnrollments);

    }
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export($id){
        $course = Course::find($id);
        $currentTerm = Term::currentTerm();
        $termCourse = $course->getTermCourse($currentTerm);

        $file = $course->title;
        return Excel::download(new CourseEnrollmentExport($id, $termCourse->status),
            $file .'.xlsx');
    }
    public function exportMid($id){
        $course = Course::find($id);
        $file = $course->title;
        return Excel::download(new MidGradeExport($id), $file.'.xlsx');
    }
    public function exportTh($id){
        $course = Course::find($id);
        $file = $course->title;

        return Excel::download(new ThGradeExport($id), $file .'.xlsx');
    }

    public function import($id)
    {
        $course = Course::find($id);
        $currentTerm = Term::currentTerm();
        $termCourse = $course->getTermCourse($currentTerm);
        if ($termCourse->status == $currentTerm->status
            && $termCourse->status != TermCourseStatus::FINAL) {
            $nextStatus = $termCourse->status + 1;
            Excel::import(new CourseEnrollmentImport($course, $termCourse,
                $currentTerm, $nextStatus),
                request()->file('file'));
        } else {
            Flash::error('Course grades cant be updated');
        }
        return redirect('course_enrollments.select_course');

    }
    public function importMid()
    {
        $data = Excel::toArray(new MidGradeImport, request()->file('file'));

        return collect(head($data))
            ->each(function ($row)  {

                DB::table('course_enrollment')
                    ->where('enrollment_id', $row[0])
                    ->where('course_id',$row[1])
                    ->update(['mid_grade' => $row[3]]);
            });
    }
    public function importTh()
    {
        $data = Excel::toArray(new ThGradeImport, request()->file('file'));

        return collect(head($data))
            ->each(function ($row)  {

                DB::table('course_enrollment')
                    ->where('enrollment_id', $row[0])
                    ->where('course_id',$row[1])
                    ->update(['th_Grade' => $row[3]]);
            });
    }
    public function giveSuccess(){

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
    }



}

