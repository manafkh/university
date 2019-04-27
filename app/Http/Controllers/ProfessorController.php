<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Models\Professor;
use App\Models\Role;
use App\Repositories\ProfessorRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Response;

class ProfessorController extends AppBaseController
{
    /** @var  ProfessorRepository */
    private $professorRepository;

    public function __construct(ProfessorRepository $professorRepo)
    {
        $this->professorRepository = $professorRepo;
    }

    /**
     * Display a listing of the Professor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $professors = $this->professorRepository->all();

        return view('professors.index')
            ->with('professors', $professors);
    }

    /**
     * Show the form for creating a new Professor.
     *
     * @return Response
     */
    public function create()
    {
        return view('professors.create');
    }

    /**
     * Store a newly created Professor in storage.
     *
     * @param CreateProfessorRequest $request
     *
     * @return Response
     */
    public function store(CreateProfessorRequest $request)
    {
        $input = $request->all();

        $student = $this->professorRepository->create($input);

        Mail::send('mailer',array('student'=>$student), function($message) use ($student)
        {
            $message->from('no-reply@site.com', "Site name");
            $message->subject("Welcome to site name");
            $message->to($student['email']);
        });

        Flash::success('Professor saved successfully.');

        return redirect(route('professors.index'));
    }

    /**
     * Display the specified Professor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            Flash::error('Professor not found');

            return redirect(route('professors.index'));
        }

        return view('professors.show')->with('professor', $professor);
    }

    /**
     * Show the form for editing the specified Professor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            Flash::error('Professor not found');

            return redirect(route('professors.index'));
        }

        return view('professors.edit')->with('professor', $professor);
    }

    /**
     * Update the specified Professor in storage.
     *
     * @param int $id
     * @param UpdateProfessorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProfessorRequest $request)
    {
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            Flash::error('Professor not found');

            return redirect(route('professors.index'));
        }

        $professor = $this->professorRepository->update($request->all(), $id);

        Flash::success('Professor updated successfully.');

        return redirect(route('professors.index'));
    }

    /**
     * Remove the specified Professor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $professor = $this->professorRepository->find($id);

        if (empty($professor)) {
            Flash::error('Professor not found');

            return redirect(route('professors.index'));
        }

        $this->professorRepository->delete($id);

        Flash::success('Professor deleted successfully.');

        return redirect(route('professors.index'));
    }
    public function GetConfirm($id){
        $con = Professor::find($id);
        return view('confirm')->with('con',$con);
    }
    public function PostConfirm($id ,Request $request){
        $student = Professor::find($id);
        $role = Role::find(2);
        $user = User::create([
            'role_id'=> $role['id'],
            'name' => $student->first_name,

            'email'=> $student->email,

            'password' => Hash::make($request->password),
        ]);
        return redirect('/home');
    }

    public function showProfessor(){
        $professors = Professor::all();
        return view('interface.teacher')->with('professors',$professors);
    }
}
