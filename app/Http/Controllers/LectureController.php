<?php

namespace App\Http\Controllers;

use App\ActiveLecture;
use App\Broadcasting\QRScanned;
use App\Http\Requests\CreateLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Section;
use App\Repositories\LectureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use QRCode;
use QR_Code;
use App\Models\Lecture as LectureModel ;
use QR_Code\Types\QR_Url;
use Response;

class LectureController extends AppBaseController
{
    /** @var  LectureRepository */
    private $lectureRepository;

    public function __construct(LectureRepository $lectureRepo)
    {
        $this->lectureRepository = $lectureRepo;
    }


    /**
     * Display a listing of the Lecture.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $lectures = DB::table('sections as S')
            ->selectRaw('C.id ,C.title , CONCAT(day," - ",start_time," - ",end_time) as full_time')
            ->join('schedules as H','H.id','=','S.schedule_id')
            ->join('courses as C','S.course_id','=','C.id')
            ->join('professors as P','S.professor_id','=','P.id')
            ->where('p.first_name','=',Auth::user()->name)

            ->get();

//        $lectures = $this->lectureRepository->all();
//
        return view('lectures.index')
            ->with('lectures', $lectures);
    }

    /**
     *
     */
    public function coursesProfessor(){
        $select = DB::table('sections as S')
            ->selectRaw('C.id,C.title ')
            ->join('courses as C','S.course_id','=','C.id')
            ->join('professors as P','S.professor_id','=','P.id')
            ->where('p.first_name','=',Auth::user()->name)
            ->pluck('C.title','C.id')->all();
    }

    /**
     * Show the form for creating a new Lecture.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function create()
    {
        $select = DB::table('sections as S')
            ->selectRaw('C.id,C.title ')
            ->join('courses as C','S.course_id','=','C.id')
            ->join('professors as P','S.professor_id','=','P.id')
            ->where('p.first_name','=',Auth::user()->name)
            ->pluck('C.title','S.id')->all();
       return view('lectures.create')->with('select',$select);
    }

    /**
     * Store a newly created Lecture in storage.
     *
     * @param CreateLectureRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function store(CreateLectureRequest $request)
    {
        $input = $request->all();

        $lecture = $this->lectureRepository->create($input);

        $next_scan_id = random_int(0, 50000);
         ActiveLecture::create([
            'lecture_id' => $lecture['id'],
            'next_scan_id' => $next_scan_id,
            ]);

        Flash::success('Lecture saved successfully.');

        return view('attendances.registared')
            ->with('lecture',$lecture)
            ->with('next_scan_id',$next_scan_id);
    }

    /**
     * Display the specified Lecture.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            Flash::error('Lecture not found');

            return redirect(route('lectures.index'));
        }

        return view('lectures.show')->with('lecture', $lecture);
    }

    /**
     * Show the form for editing the specified Lecture.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            Flash::error('Lecture not found');

            return redirect(route('lectures.index'));
        }

        return view('lectures.edit')->with('lecture', $lecture);
    }

    /**
     * Update the specified Lecture in storage.
     *
     * @param int $id
     * @param UpdateLectureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLectureRequest $request)
    {
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            Flash::error('Lecture not found');

            return redirect(route('lectures.index'));
        }

        $lecture = $this->lectureRepository->update($request->all(), $id);

        Flash::success('Lecture updated successfully.');

        return redirect(route('lectures.index'));
    }

    /**
     * Remove the specified Lecture from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lecture = $this->lectureRepository->find($id);

        if (empty($lecture)) {
            Flash::error('Lecture not found');

            return redirect(route('lectures.index'));
        }

        $this->lectureRepository->delete($id);

        Flash::success('Lecture deleted successfully.');

        return redirect(route('lectures.index'));
    }
    /**
     * Remove the specified Lecture from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

    public function selectLecturesCourse($id){

        $lectures = DB::table('lectures as L')
            ->selectRaw('L.id , S.course_id , L.subject')
            ->join('sections as S','L.section_id','=','S.id')
            ->where('S.course_id','=',$id)->get();
       return view('lectures.selectLecturesCourse')->with('lectures',$lectures);

    }


}
