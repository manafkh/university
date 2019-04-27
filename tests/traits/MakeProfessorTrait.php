<?php

use Faker\Factory as Faker;
use App\Models\Professor;
use App\Repositories\ProfessorRepository;

trait MakeProfessorTrait
{
    /**
     * Create fake instance of Professor and save it in database
     *
     * @param array $professorFields
     * @return Professor
     */
    public function makeProfessor($professorFields = [])
    {
        /** @var ProfessorRepository $professorRepo */
        $professorRepo = App::make(ProfessorRepository::class);
        $theme = $this->fakeProfessorData($professorFields);
        return $professorRepo->create($theme);
    }

    /**
     * Get fake instance of Professor
     *
     * @param array $professorFields
     * @return Professor
     */
    public function fakeProfessor($professorFields = [])
    {
        return new Professor($this->fakeProfessorData($professorFields));
    }

    /**
     * Get fake data of Professor
     *
     * @param array $postFields
     * @return array
     */
    public function fakeProfessorData($professorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'first_name' => $fake->word,
            'last_name' => $fake->word,
            'phone' => $fake->randomDigitNotNull,
            'email' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $professorFields);
    }
}
