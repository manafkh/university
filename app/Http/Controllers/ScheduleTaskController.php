<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateScheduleTaskRequest;
use App\Http\Requests\UpdateScheduleTaskRequest;
use App\Repositories\ScheduleTaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ScheduleTaskController extends AppBaseController
{
    /** @var  ScheduleTaskRepository */
    private $scheduleTaskRepository;

    public function __construct(ScheduleTaskRepository $scheduleTaskRepo)
    {
        $this->scheduleTaskRepository = $scheduleTaskRepo;
    }

    /**
     * Display a listing of the ScheduleTask.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $scheduleTasks = $this->scheduleTaskRepository->all();

        return view('schedule_tasks.index')
            ->with('scheduleTasks', $scheduleTasks);
    }

    /**
     * Show the form for creating a new ScheduleTask.
     *
     * @return Response
     */
    public function create()
    {
        return view('schedule_tasks.create');
    }

    /**
     * Store a newly created ScheduleTask in storage.
     *
     * @param CreateScheduleTaskRequest $request
     *
     * @return Response
     */
    public function store(CreateScheduleTaskRequest $request)
    {
        $input = $request->all();

        $scheduleTask = $this->scheduleTaskRepository->create($input);

        Flash::success('Schedule Task saved successfully.');

        return redirect(route('scheduleTasks.index'));
    }

    /**
     * Display the specified ScheduleTask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $scheduleTask = $this->scheduleTaskRepository->find($id);

        if (empty($scheduleTask)) {
            Flash::error('Schedule Task not found');

            return redirect(route('scheduleTasks.index'));
        }

        return view('schedule_tasks.show')->with('scheduleTask', $scheduleTask);
    }

    /**
     * Show the form for editing the specified ScheduleTask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $scheduleTask = $this->scheduleTaskRepository->find($id);

        if (empty($scheduleTask)) {
            Flash::error('Schedule Task not found');

            return redirect(route('scheduleTasks.index'));
        }

        return view('schedule_tasks.edit')->with('scheduleTask', $scheduleTask);
    }

    /**
     * Update the specified ScheduleTask in storage.
     *
     * @param int $id
     * @param UpdateScheduleTaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateScheduleTaskRequest $request)
    {
        $scheduleTask = $this->scheduleTaskRepository->find($id);

        if (empty($scheduleTask)) {
            Flash::error('Schedule Task not found');

            return redirect(route('scheduleTasks.index'));
        }

        $scheduleTask = $this->scheduleTaskRepository->update($request->all(), $id);

        Flash::success('Schedule Task updated successfully.');

        return redirect(route('scheduleTasks.index'));
    }

    /**
     * Remove the specified ScheduleTask from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $scheduleTask = $this->scheduleTaskRepository->find($id);

        if (empty($scheduleTask)) {
            Flash::error('Schedule Task not found');

            return redirect(route('scheduleTasks.index'));
        }

        $this->scheduleTaskRepository->delete($id);

        Flash::success('Schedule Task deleted successfully.');

        return redirect(route('scheduleTasks.index'));
    }
}
