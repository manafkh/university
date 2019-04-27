<?php

use App\Models\Professor;
use App\Repositories\ProfessorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfessorRepositoryTest extends TestCase
{
    use MakeProfessorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProfessorRepository
     */
    protected $professorRepo;

    public function setUp()
    {
        parent::setUp();
        $this->professorRepo = App::make(ProfessorRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProfessor()
    {
        $professor = $this->fakeProfessorData();
        $createdProfessor = $this->professorRepo->create($professor);
        $createdProfessor = $createdProfessor->toArray();
        $this->assertArrayHasKey('id', $createdProfessor);
        $this->assertNotNull($createdProfessor['id'], 'Created Professor must have id specified');
        $this->assertNotNull(Professor::find($createdProfessor['id']), 'Professor with given id must be in DB');
        $this->assertModelData($professor, $createdProfessor);
    }

    /**
     * @test read
     */
    public function testReadProfessor()
    {
        $professor = $this->makeProfessor();
        $dbProfessor = $this->professorRepo->find($professor->id);
        $dbProfessor = $dbProfessor->toArray();
        $this->assertModelData($professor->toArray(), $dbProfessor);
    }

    /**
     * @test update
     */
    public function testUpdateProfessor()
    {
        $professor = $this->makeProfessor();
        $fakeProfessor = $this->fakeProfessorData();
        $updatedProfessor = $this->professorRepo->update($fakeProfessor, $professor->id);
        $this->assertModelData($fakeProfessor, $updatedProfessor->toArray());
        $dbProfessor = $this->professorRepo->find($professor->id);
        $this->assertModelData($fakeProfessor, $dbProfessor->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProfessor()
    {
        $professor = $this->makeProfessor();
        $resp = $this->professorRepo->delete($professor->id);
        $this->assertTrue($resp);
        $this->assertNull(Professor::find($professor->id), 'Professor should not exist in DB');
    }
}
