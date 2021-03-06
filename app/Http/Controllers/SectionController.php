<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Course;
use App\Models\Professor;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Term;
use App\Models\Year;
use App\Repositories\SectionRepository;
use App\Http\Controllers\AppBaseController;
use App\Room;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Response;

class SectionController extends AppBaseController
{
    /** @var  SectionRepository */
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepo)
    {
        $this->sectionRepository = $sectionRepo;
    }

    /**
     * Display a listing of the Section.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sections = $this->sectionRepository->all();

        return view('sections.index')
            ->with('sections', $sections);
    }

    /**
     * Show the form for creating a new Section.
     *
     * @return Response
     */
    public function create()
    {

       return $professor = Professor::selectRaw('id, CONCAT(first_name,"  ",last_name) as full_name')->pluck('full_name', 'id')->all();
        $schedule = Schedule::selectRaw('id, CONCAT(day," - ",start_time," - ",end_time) as full_time')->pluck('full_time', 'id')->all();
        $course = Course::pluck('title', 'id')->all();
//        return view('sections.create', compact('professor', 'schedule', 'course'));
    }

    /**
     * Store a newly created Section in storage.
     *
     * @param CreateSectionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'schedule_id' => 'required',
            'professor_id'=> [
                'required',
                Rule::unique('sections')->where(function ($query) use ($request) {
                    return $query
                        ->whereScheduleId($request->schedule_id)
                        ->whereProfessorId($request->professor_id);
                }),
            ],
            'course_id'=> [
                'required',
                function($attribute, $value, $fail) use ($request) {
                    $course = Course::find($value);
                    $found_course = DB::table('sections as S')
                        ->join('courses as C','S.course_id','=','C.id')
                        ->where('S.schedule_id', '=',
                            $request->schedule_id)
                        ->where('C.year_id', '=',
                            $course->year_id)
                        ->first();
                    if ($found_course) {
                        $fail('Students of a year can\'t be in two rooms at the same time.');
                    }
                },
            ],
            'Room' => [
                'required',
                Rule::unique('sections')->where(function ($query) use ($request) {
                    return $query
                        ->whereScheduleId($request->schedule_id)
                        ->whereRoom($request->Room);
                }),
            ],
        ]);
        $input = $request->all();

        $section = $this->sectionRepository->create($input);

        Flash::success('Section saved successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified Section.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionRepository->find($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        return view('sections.show')->with('section', $section);
    }

    /**
     * Show the form for editing the specified Section.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $professor = Professor::selectRaw('id, CONCAT(first_name,"  ",last_name) as full_name')->pluck('full_name', 'id')->all();

        $section = $this->sectionRepository->find($id);
        $schedule = Schedule::selectRaw('id, CONCAT(day," - ",start_time," - ",end_time) as full_time')->pluck('full_time', 'id')->all();
        $course = Course::pluck('title', 'id')->all();

        if (empty($section)) {
            Flash::error('Section not found');
            return redirect(route('sections.index'));
        }

        return view('sections.edit')->with('section', $section)
            ->with('schedule', $schedule)
            ->with('course', $course)
            ->with('professor', $professor);
    }

    /**
     * Update the specified Section in storage.
     *
     * @param int $id
     * @param UpdateSectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionRequest $request)
    {
        $section = $this->sectionRepository->find($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $section = $this->sectionRepository->update($request->all(), $id);

        Flash::success('Section updated successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified Section from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $section = $this->sectionRepository->find($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $this->sectionRepository->delete($id);

        Flash::success('Section deleted successfully.');

        return redirect(route('sections.index'));
    }

    public function weekly($year_id, $term_id)
    {
        $sections = Section::whereHas('course', function($q) use($year_id, $term_id) {
            $q->where('year_id', $year_id)->where('term_id', $term_id);
        })->get();
        return view('weekly.FirstYear', compact('sections'));
//        $weekly = DB::table('Sections')
//            ->join('Courses', 'Sections.id', '=', 'Courses.id')
//            ->where('Courses.year_id', '=', $year_id)
//            ->where('Courses.term_id', '=', $term_id)
//            ->selectRaw('Sections.id, Sections.');
//        return view('weekly.FirstYear')
//            ->with('Year', $Year)
//            ->with('weekly', $weekly);
    }

    public function Year()
    {

        $years = Year::all();
        $terms =  Term::where('is_strict', true)->get();
        return view('weekly.year')
            ->with('terms', $terms)
            ->with('years', $years);
    }

    public function createRoom()
    {
        return view('sections.room');
    }

    public function storeRoom(Request $request)
    {
        $input = $request->all();
        $room = Room::create($input);

    }
}