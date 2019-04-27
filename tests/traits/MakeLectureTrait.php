<?php

use Faker\Factory as Faker;
use App\Models\Lecture;
use App\Repositories\LectureRepository;

trait MakeLectureTrait
{
    /**
     * Create fake instance of Lecture and save it in database
     *
     * @param array $lectureFields
     * @return Lecture
     */
    public function makeLecture($lectureFields = [])
    {
        /** @var LectureRepository $lectureRepo */
        $lectureRepo = App::make(LectureRepository::class);
        $theme = $this->fakeLectureData($lectureFields);
        return $lectureRepo->create($theme);
    }

    /**
     * Get fake instance of Lecture
     *
     * @param array $lectureFields
     * @return Lecture
     */
    public function fakeLecture($lectureFields = [])
    {
        return new Lecture($this->fakeLectureData($lectureFields));
    }

    /**
     * Get fake data of Lecture
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLectureData($lectureFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'subject' => $fake->word,
            'section_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $lectureFields);
    }
}
