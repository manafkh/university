<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class AttendanceController extends AppBaseController
{
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the Attendance.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attendances = $this->attendanceRepository->all();

        return view('attendances.index')
            ->with('attendances', $attendances);
    }

    /**
     * Show the form for creating a new Attendance.
     *
     * @return Response
     */
    public function create()
    {
        return view('attendances.create');
    }

    /**
     * Store a newly created Attendance in storage.
     *
     * @param CreateAttendanceRequest $request
     *
     * @return Response
     */
    public function store($id , CreateAttendanceRequest $request)
    {

        $input = $request->all();
        $input['lecture_id'] = $id ;
        $attendance = $this->attendanceRepository->create($input);

        Flash::success('Attendance saved successfully.');

        return redirect(route('attendances.index'));
    }

    /**
     * Display the specified Attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.show')->with('attendance', $attendance);
    }

    /**
     * Show the form for editing the specified Attendance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        return view('attendances.edit')->with('attendance', $attendance);
    }

    /**
     * Update the specified Attendance in storage.
     *
     * @param int $id
     * @param UpdateAttendanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttendanceRequest $request)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $attendance = $this->attendanceRepository->update($request->all(), $id);

        Flash::success('Attendance updated successfully.');

        return redirect(route('attendances.index'));
    }

    /**
     * Remove the specified Attendance from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            Flash::error('Attendance not found');

            return redirect(route('attendances.index'));
        }

        $this->attendanceRepository->delete($id);

        Flash::success('Attendance deleted successfully.');

        return redirect(route('attendances.index'));
    }
    public function attendances($id){

           $attendances = DB::table('lectures as L')
            ->selectRaw('E.ExamNumber, CONCAT(T.first_name," ",T.last_name) as full_name')
            ->join('sections as S','L.section_id','=','S.id')
            ->join('attendances as A','A.lecture_id','=','L.id')
            ->join('enrollments as E','E.id','=','A.enrollment_id')
            ->join('students as T','T.id','=','E.student_id')
            ->where('L.id','=', $id)->get();

        return view('attendances.showAttendance')->with('attendances',$attendances);
    }
}
