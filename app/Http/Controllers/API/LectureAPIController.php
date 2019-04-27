<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLectureAPIRequest;
use App\Http\Requests\API\UpdateLectureAPIRequest;
use App\Models\Lecture;
use App\Repositories\LectureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LectureController
 * @package App\Http\Controllers\API
 */

class LectureAPIController extends AppBaseController
{
    /** @var  LectureRepository */
    private $lectureRepository;

    public function __construct(LectureRepository $lectureRepo)
    {
        $this->lectureRepository = $lectureRepo;
    }

    /**
     * Display a listing of the Lecture.
     * GET|HEAD /lectures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $lectures = $this->lectureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($lectures->toArray(), 'Lectures retrieved successfully');
    }

    /**
     * Store a newly created Lecture in storage.
     * POST /lectures
     *
     * @param CreateLectureAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLectureAPIRequest $request)
    {
        $input = $request->all();

        $lectures = $this->lectureRepository->create($input);

        return $this->sendResponse($lectures->toArray(), 'Lecture saved successfully');
    }

    /**
     * Display the specified Lecture.
     * GET|HEAD /lectures/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Lecture $lecture */
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            return $this->sendError('Lecture not found');
        }

        return $this->sendResponse($lecture->toArray(), 'Lecture retrieved successfully');
    }

    /**
     * Update the specified Lecture in storage.
     * PUT/PATCH /lectures/{id}
     *
     * @param int $id
     * @param UpdateLectureAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLectureAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lecture $lecture */
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            return $this->sendError('Lecture not found');
        }

        $lecture = $this->lectureRepository->update($input, $id);

        return $this->sendResponse($lecture->toArray(), 'Lecture updated successfully');
    }

    /**
     * Remove the specified Lecture from storage.
     * DELETE /lectures/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Lecture $lecture */
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            return $this->sendError('Lecture not found');
        }

        $lecture->delete();

        return $this->sendResponse($id, 'Lecture deleted successfully');
    }
}
