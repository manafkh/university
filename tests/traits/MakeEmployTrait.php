<?php

use Faker\Factory as Faker;
use App\Models\Employ;
use App\Repositories\EmployRepository;

trait MakeEmployTrait
{
    /**
     * Create fake instance of Employ and save it in database
     *
     * @param array $employFields
     * @return Employ
     */
    public function makeEmploy($employFields = [])
    {
        /** @var EmployRepository $employRepo */
        $employRepo = App::make(EmployRepository::class);
        $theme = $this->fakeEmployData($employFields);
        return $employRepo->create($theme);
    }

    /**
     * Get fake instance of Employ
     *
     * @param array $employFields
     * @return Employ
     */
    public function fakeEmploy($employFields = [])
    {
        return new Employ($this->fakeEmployData($employFields));
    }

    /**
     * Get fake data of Employ
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEmployData($employFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'first_name' => $fake->word,
            'last_name' => $fake->word,
            'phone' => $fake->randomDigitNotNull,
            'email' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $employFields);
    }
}
