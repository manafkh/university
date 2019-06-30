<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Repositories\ScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Validation\Rule;
use Response;

class ScheduleController extends AppBaseController
{
    /** @var  ScheduleRepository */
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Display a listing of the Schedule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $schedules = $this->scheduleRepository->all();

        return view('schedules.index')
            ->with('schedules', $schedules);
    }

    /**
     * Show the form for creating a new Schedule.
     *
     * @return Response
     */
    public function create()
    {
        $days = Schedule::$day;
        return view('schedules.create',compact('days'));
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param CreateScheduleRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'day'=> 'required',
            'start_time' => 'required',
            'end_time'=> [
                'required',
                function($attribute, $value, $fail) use($request) {
                    if (Carbon::parse($value)
                        ->lessThan(Carbon::parse($request->start_time)->addHour())) {
                        $fail('End time must be at least 1 hour after start time');
                    }
                },
//                Rule::unique('schedules')->where(function ($query) use ($request) {
//                    return $query
//                        ->whereDay($request->day)
//                        ->whereStartTime($request->start_time)
//                        ->whereEndTime($request->end_time);
//                }),
            ],
        ]);
        $input = $request->all();

        $schedule = $this->scheduleRepository->create($input);
        Flash::success('Schedule saved successfully.');
        return redirect(route('schedules.index'));
    }

    /**
     * Display the specified Schedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedules.index'));
        }

        return view('schedules.show')->with('schedule', $schedule);
    }

    /**
     * Show the form for editing the specified Schedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedules.index'));
        }

        return view('schedules.edit')->with('schedule', $schedule);
    }

    /**
     * Update the specified Schedule in storage.
     *
     * @param int $id
     * @param UpdateScheduleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateScheduleRequest $request)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedules.index'));
        }

        $schedule = $this->scheduleRepository->update($request->all(), $id);

        Flash::success('Schedule updated successfully.');

        return redirect(route('schedules.index'));
    }

    /**
     * Remove the specified Schedule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $schedule = $this->scheduleRepository->find($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('schedules.index'));
        }

        $this->scheduleRepository->delete($id);

        Flash::success('Schedule deleted successfully.');

        return redirect(route('schedules.index'));
    }
}
