<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCourseEnrollmentAPIRequest;
use App\Http\Requests\API\UpdateCourseEnrollmentAPIRequest;
use App\Models\CourseEnrollment;
use App\Models\Student;
use App\Repositories\CourseEnrollmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class CourseEnrollmentController
 * @package App\Http\Controllers\API
 */

class CourseEnrollmentAPIController extends AppBaseController
{
    /** @var  CourseEnrollmentRepository */
    private $courseEnrollmentRepository;

    public function __construct(CourseEnrollmentRepository $courseEnrollmentRepo)
    {
        $this->courseEnrollmentRepository = $courseEnrollmentRepo;
    }

    /**
     * Display a listing of the CourseEnrollment.
     * GET|HEAD /courseEnrollments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $courseEnrollments = $this->courseEnrollmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($courseEnrollments->toArray(), 'Course Enrollments retrieved successfully');
    }

    /**
     * Store a newly created CourseEnrollment in storage.
     * POST /courseEnrollments
     *
     * @param CreateCourseEnrollmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseEnrollmentAPIRequest $request)
    {
        $input = $request->all();

        $courseEnrollments = $this->courseEnrollmentRepository->create($input);

        return $this->sendResponse($courseEnrollments->toArray(), 'Course Enrollment saved successfully');
    }

    /**
     * Display the specified CourseEnrollment.
     * GET|HEAD /courseEnrollments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var CourseEnrollment $courseEnrollment */
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            return $this->sendError('Course Enrollment not found');
        }

        return $this->sendResponse($courseEnrollment->toArray(), 'Course Enrollment retrieved successfully');
    }

    /**
     * Update the specified CourseEnrollment in storage.
     * PUT/PATCH /courseEnrollments/{id}
     *
     * @param int $id
     * @param UpdateCourseEnrollmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseEnrollmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var CourseEnrollment $courseEnrollment */
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            return $this->sendError('Course Enrollment not found');
        }

        $courseEnrollment = $this->courseEnrollmentRepository->update($input, $id);

        return $this->sendResponse($courseEnrollment->toArray(), 'CourseEnrollment updated successfully');
    }
    /**
     * Get Grade Course the specified CourseEnrollment in storage.
     * GET /courseEnrollments/{StudentId}
     *
     * @param $studentId
     * @return Response
     */
    public function getGradeCourse($studentId)
    {
        $student = Student::find($studentId);
        if($student){
            $Grade = DB::table('course_enrollment as C')
                ->selectRaw('S.id ,C.enrollment_id,E.year_id , O.title , C.mid_grade , C.th_Grade , C.final_Grade')
                ->join('enrollments as E','E.id','=','C.enrollment_id')
                ->join('students as S','S.id','=','E.student_id')
                ->join('courses as O','O.id','=','C.course_id')
                ->where('S.id','=',$studentId)
                ->get();
            return $this->sendResponse($Grade->toArray(), 'successfully');
        }
        return $this->sendResponse($studentId, 'student not found in System !');
    }

    /**
     * Remove the specified CourseEnrollment from storage.
     * DELETE /courseEnrollments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var CourseEnrollment $courseEnrollment */
        $courseEnrollment = $this->courseEnrollmentRepository->find($id);

        if (empty($courseEnrollment)) {
            return $this->sendError('Course Enrollment not found');
        }

        $courseEnrollment->delete();

        return $this->sendResponse($id, 'Course Enrollment deleted successfully');
    }
}
