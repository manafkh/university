<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEnrollmentRequest;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Enrollment;
use App\Models\Role;
use App\Models\Student;
use App\Models\Year;
use App\Repositories\EnrollmentRepository;
use App\Repositories\StudentRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

use Illuminate\Validation\Rule;
use Response;

class EnrollmentController extends AppBaseController
{
    /** @var  EnrollmentRepository */
    private $enrollmentRepository;
    private $studentRepository;

    public function __construct(EnrollmentRepository $enrollmentRepo, StudentRepository $studentRepo)
    {
        $this->enrollmentRepository = $enrollmentRepo;
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the Enrollment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $enrollments = $this->enrollmentRepository->all();

        return view('enrollments.index')
            ->with('enrollments', $enrollments);
    }

    /**
     * Show the form for creating a new Enrollment.
     *
     * @return Response
     */
    public function enroll()
    {

      return view('enrollments.enroll');
    }

    /**
     * Show the form for creating a new Enrollment.
     *
     * @return Response
     */
    public function create()
    {
        $year = Year::pluck('name', 'id')->all();
        return view('enrollments.create', compact('year'));
    }

    /**
     * Store a newly created Enrollment in storage.
     *
     * @param CreateEnrollmentRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'first_name' => 'required |max:150',
            'last_name' => 'required |max:150',
            'father_name' => 'required | max:150',
            'phone' => 'required|regex:/(09)[0-9]{8}/|unique:students',
            'email' => 'email',
            'mother_name' => [
                'required',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query
                        ->whereFirstName($request->first_name)
                        ->whereLastName($request->last_name)
                        ->whereFatherName($request->father_name)
                        ->whereMotherName($request->mother_name);

                }),
            ],
        ]);
        $input = $request->all();
        $student = $this->studentRepository->create($input);
        $input['student_id'] = $student['id'];
        $enrollment = $this->enrollmentRepository->create($input);
        $course = Course::where('year_id', '=', $enrollment->year_id)->get();




        $enrollment->courses()->attach($course);

        $courseEnrollments = CourseEnrollment::all();

        foreach ($courseEnrollments as $courseEnrollment) {

            $courseEnrollment->term_id = $courseEnrollment->course->term_id;
            $courseEnrollment->save();
        }



        Mail::send('mailer',array('student'=>$student), function($message) use ($student)
        {
            $message->from('no-reply@site.com', "Site name");
            $message->subject("Welcome to site name");
            $message->to($student['email']);
        });


        Flash::success('Enrollment saved successfully.');

        return redirect(route('enrollments.index'));

    }

    /**
     * Display the specified Enrollment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enrollment = $this->enrollmentRepository->find($id);

        if (empty($enrollment)) {
            Flash::error('Enrollment not found');

            return redirect(route('enrollments.index'));
        }

        return view('enrollments.show')->with('enrollment', $enrollment);
    }

    /**
     * Show the form for editing the specified Enrollment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $year = Year::pluck('name', 'id')->all();

        $enrollment = $this->enrollmentRepository->find($id);
        $student = $this->studentRepository->find($id);

        if (empty($enrollment)) {
            Flash::error('Enrollment not found');

            return redirect(route('enrollments.index'));
        }

        return view('enrollments.edit')
            ->with('student', $student)
            ->with('year', $year);
    }

    /**
     * Update the specified Enrollment in storage.
     *
     * @param int $id
     * @param UpdateEnrollmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnrollmentRequest $request)
    {
        request()->validate([
            'enroll_year',
            'student_id' => [
                'required',
                Rule::unique('enrollments')->where(function ($query) use ($request) {
                    return $query
                        ->whereEnrollYear($request->enroll_year)
                        ->whereStudentId($request->student_id);
                }),
            ],
        ]);
        $enrollment = $request->all();
        $student = $this->studentRepository->find($id);
        $enrollment['student_id'] = $student['id'];
        if (empty($enrollment)) {
            Flash::error('Enrollment not found');
            return redirect(route('enrollments.index'));
        }
        $enrollment = $this->enrollmentRepository->create($enrollment);
        $course = Course::where('year_id', '=', $enrollment->year_id)->get();
        $enrollment->courses()->attach($course);
        $courseEnrollments = CourseEnrollment::all();
        foreach ($courseEnrollments as $courseEnrollment) {
            $courseEnrollment->term_id = $courseEnrollment->course->term_id;
            $courseEnrollment->save();
        }
        Flash::success('Enrollment updated successfully.');
        return redirect(route('enrollments.index'));
    }

    /**
     * Remove the specified Enrollment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $enrollment = $this->enrollmentRepository->find($id);

        if (empty($enrollment)) {
            Flash::error('Enrollment not found');

            return redirect(route('enrollments.index'));
        }

        $this->enrollmentRepository->delete($id);

        Flash::success('Enrollment deleted successfully.');

        return redirect(route('enrollments.index'));
    }

    /**
     * Remove the specified Enrollment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function give()
    {
        $enrollments = $this->enrollmentRepository->all();

        foreach ($enrollments as $enrollment) {
            static $i, $s, $t, $f, $fo;
            switch ($enrollment->year_id) {
                case 1:
                    $enrollment['ExamNumber'] = $enrollment->year_id * 10000 + $i++;
                    $enrollment->save();
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

            return view('enrollments.index');
        }

    }
    public function getCoursesStudent($id){

        return   $count = DB::table('enrollments as E')
            ->selectRaw('C.course_id , S.id')
            ->join('students as S','E.student_id','=','S.id')
            ->join('course_enrollment as C','C.enrollment_id','=','E.id')
            ->where('S.id','=',$id)
            ->get();
    }
    public function  getStudentsCourse($id){
        return   $count = DB::table('enrollments as E')
            ->selectRaw('C.course_id , S.id')
            ->join('students as S','E.student_id','=','S.id')
            ->join('course_enrollment as C','C.enrollment_id','=','E.id')
            ->where('C.course_id','=',$id)
            ->get();
    }
    public function GetConfirm($id){
        $con = Student::find($id);
        return view('confirm')->with('con',$con);
    }
    public function PostConfirm($id ,Request $request){
        $student = Student::find($id);
        $role = Role::find(3);
        $user = User::create([
            'role_id'=> $role->id,
            'name' => $student->first_name,
            'email'=> $student->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/home');
    }
}