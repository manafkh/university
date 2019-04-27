<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEnrollmentAPIRequest;
use App\Http\Requests\API\UpdateEnrollmentAPIRequest;
use App\Models\Enrollment;
use App\Repositories\EnrollmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EnrollmentController
 * @package App\Http\Controllers\API
 */

class EnrollmentAPIController extends AppBaseController
{
    /** @var  EnrollmentRepository */
    private $enrollmentRepository;

    public function __construct(EnrollmentRepository $enrollmentRepo)
    {
        $this->enrollmentRepository = $enrollmentRepo;
    }

    /**
     * Display a listing of the Enrollment.
     * GET|HEAD /enrollments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $enrollments = $this->enrollmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($enrollments->toArray(), 'Enrollments retrieved successfully');
    }

    /**
     * Store a newly created Enrollment in storage.
     * POST /enrollments
     *
     * @param CreateEnrollmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEnrollmentAPIRequest $request)
    {
        $input = $request->all();

        $enrollments = $this->enrollmentRepository->create($input);

        return $this->sendResponse($enrollments->toArray(), 'Enrollment saved successfully');
    }

    /**
     * Display the specified Enrollment.
     * GET|HEAD /enrollments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Enrollment $enrollment */
        $enrollment = $this->enrollmentRepository->find($id);

        if (empty($enrollment)) {
            return $this->sendError('Enrollment not found');
        }

        return $this->sendResponse($enrollment->toArray(), 'Enrollment retrieved successfully');
    }

    /**
     * Update the specified Enrollment in storage.
     * PUT/PATCH /enrollments/{id}
     *
     * @param int $id
     * @param UpdateEnrollmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnrollmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Enrollment $enrollment */
        $enrollment = $this->enrollmentRepository->find($id);

        if (empty($enrollment)) {
            return $this->sendError('Enrollment not found');
        }

        $enrollment = $this->enrollmentRepository->update($input, $id);

        return $this->sendResponse($enrollment->toArray(), 'Enrollment updated successfully');
    }

    /**
     * Remove the specified Enrollment from storage.
     * DELETE /enrollments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Enrollment $enrollment */
        $enrollment = $this->enrollmentRepository->find($id);

        if (empty($enrollment)) {
            return $this->sendError('Enrollment not found');
        }

        $enrollment->delete();

        return $this->sendResponse($id, 'Enrollment deleted successfully');
    }
}
