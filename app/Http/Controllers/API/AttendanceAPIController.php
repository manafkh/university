<?php

namespace App\Http\Controllers\API;

use App\ActiveLecture;
use App\Events\QRScanned;
use App\Http\Requests\API\CreateAttendanceAPIRequest;
use App\Http\Requests\API\UpdateAttendanceAPIRequest;
use App\Models\Attendance;
use App\Models\Lecture;
use App\Repositories\AttendanceRepository;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AttendanceController
 * @package App\Http\Controllers\API
 */

class AttendanceAPIController extends AppBaseController
{
    /** @var  AttendanceRepository */
    private $attendanceRepository;

    public function __construct(AttendanceRepository $attendanceRepo)
    {
        $this->attendanceRepository = $attendanceRepo;
    }

    /**
     * Display a listing of the Attendance.
     * GET|HEAD /attendances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $attendances = $this->attendanceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($attendances->toArray(), 'Attendances retrieved successfully');
    }


    /**
     * Store a newly created Attendance in storage.
     * POST /attendances
     *
     * @param CreateAttendanceAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request )
    {
        $input = $request->all();
        $attendances = $this->attendanceRepository->create($input);

        return $this->sendResponse($attendances->toArray(), 'Attendance saved successfully');
    }


    public function test($enrollmentId, $lectureId ,$scanId) {
        $lecture = Lecture::find($lectureId);
        if ($lecture) {
            $activeLecture = ActiveLecture::where('lecture_id', $lecture->id)->first();
            if ($activeLecture) {
                if ($activeLecture->next_scan_id == $scanId) {
                    $input['enrollment_id'] = $enrollmentId;
                    $input['lecture_id'] = $lectureId;
                    $attendances = $this->attendanceRepository->create($input);
                    $nextScanId = random_int(0, 50000);
                    $activeLecture->update(['next_scan_id' => $nextScanId]);

                    event(new QRScanned($lectureId, $nextScanId));

                    return $this->sendResponse($attendances->toArray(), 'Attendance saved successfully');
                }
                return $this->sendResponse($lecture->id, 'scan id is not valid');
            }
            return $this->sendResponse($lecture->id, "lecture is not active");
        }
        return $this->sendResponse($lecture->id, "lecture not found");
    }

    /**
     * Display the specified Attendance.
     * GET|HEAD /attendances/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        return $this->sendResponse($attendance->toArray(), 'Attendance retrieved successfully');
    }

    /**
     * Update the specified Attendance in storage.
     * PUT/PATCH /attendances/{id}
     *
     * @param int $id
     * @param UpdateAttendanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttendanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        $attendance = $this->attendanceRepository->update($input, $id);

        return $this->sendResponse($attendance->toArray(), 'Attendance updated successfully');
    }

    /**
     * Remove the specified Attendance from storage.
     * DELETE /attendances/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Attendance $attendance */
        $attendance = $this->attendanceRepository->find($id);

        if (empty($attendance)) {
            return $this->sendError('Attendance not found');
        }

        $attendance->delete();

        return $this->sendResponse($id, 'Attendance deleted successfully');
    }
}
