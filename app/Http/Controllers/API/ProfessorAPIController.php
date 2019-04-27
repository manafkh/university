<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProfessorAPIRequest;
use App\Http\Requests\API\UpdateProfessorAPIRequest;
use App\Models\Professor;
use App\Repositories\ProfessorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProfessorController
 * @package App\Http\Controllers\API
 */

class ProfessorAPIController extends AppBaseController
{
    /** @var  ProfessorRepository */
    private $professorRepository;

    public function __construct(ProfessorRepository $professorRepo)
    {
        $this->professorRepository = $professorRepo;
    }

    /**
     * Display a listing of the Professor.
     * GET|HEAD /professors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $professors = $this->professorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($professors->toArray(), 'Professors retrieved successfully');
    }

    /**
     * Store a newly created Professor in storage.
     * POST /professors
     *
     * @param CreateProfessorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProfessorAPIRequest $request)
    {
        $input = $request->all();

        $professors = $this->professorRepository->create($input);

        return $this->sendResponse($professors->toArray(), 'Professor saved successfully');
    }

    /**
     * Display the specified Professor.
     * GET|HEAD /professors/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Professor $professor */
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            return $this->sendError('Professor not found');
        }

        return $this->sendResponse($professor->toArray(), 'Professor retrieved successfully');
    }

    /**
     * Update the specified Professor in storage.
     * PUT/PATCH /professors/{id}
     *
     * @param int $id
     * @param UpdateProfessorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfessorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Professor $professor */
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            return $this->sendError('Professor not found');
        }

        $professor = $this->professorRepository->update($input, $id);

        return $this->sendResponse($professor->toArray(), 'Professor updated successfully');
    }

    /**
     * Remove the specified Professor from storage.
     * DELETE /professors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Professor $professor */
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            return $this->sendError('Professor not found');
        }

        $professor->delete();

        return $this->sendResponse($id, 'Professor deleted successfully');
    }
}
