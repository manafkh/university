<?php

use App\Models\Lecture;
use App\Repositories\LectureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LectureRepositoryTest extends TestCase
{
    use MakeLectureTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LectureRepository
     */
    protected $lectureRepo;

    public function setUp()
    {
        parent::setUp();
        $this->lectureRepo = App::make(LectureRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLecture()
    {
        $lecture = $this->fakeLectureData();
        $createdLecture = $this->lectureRepo->create($lecture);
        $createdLecture = $createdLecture->toArray();
        $this->assertArrayHasKey('id', $createdLecture);
        $this->assertNotNull($createdLecture['id'], 'Created Lecture must have id specified');
        $this->assertNotNull(Lecture::find($createdLecture['id']), 'Lecture with given id must be in DB');
        $this->assertModelData($lecture, $createdLecture);
    }

    /**
     * @test read
     */
    public function testReadLecture()
    {
        $lecture = $this->makeLecture();
        $dbLecture = $this->lectureRepo->find($lecture->id);
        $dbLecture = $dbLecture->toArray();
        $this->assertModelData($lecture->toArray(), $dbLecture);
    }

    /**
     * @test update
     */
    public function testUpdateLecture()
    {
        $lecture = $this->makeLecture();
        $fakeLecture = $this->fakeLectureData();
        $updatedLecture = $this->lectureRepo->update($fakeLecture, $lecture->id);
        $this->assertModelData($fakeLecture, $updatedLecture->toArray());
        $dbLecture = $this->lectureRepo->find($lecture->id);
        $this->assertModelData($fakeLecture, $dbLecture->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLecture()
    {
        $lecture = $this->makeLecture();
        $resp = $this->lectureRepo->delete($lecture->id);
        $this->assertTrue($resp);
        $this->assertNull(Lecture::find($lecture->id), 'Lecture should not exist in DB');
    }
}
