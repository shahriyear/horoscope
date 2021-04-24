<?php

namespace Database\Seeders;

use App\Models\Zodiac;
use Illuminate\Database\Seeder;

class ZodiacSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'name'=>'Aries',
                'start_day'=>'21',
                'start_month'=>'3',
                'end_day'=>'20',
                'end_month'=>'4',
            ],
            [
                'name'=>'Taurus',
                'start_day'=>'21',
                'start_month'=>'4',
                'end_day'=>'20',
                'end_month'=>'5',
            ],
            [
                'name'=>'Gemini',
                'start_day'=>'21',
                'start_month'=>'5',
                'end_day'=>'21',
                'end_month'=>'6',
            ],
            [
                'name'=>'Cancer',
                'start_day'=>'22',
                'start_month'=>'6',
                'end_day'=>'22',
                'end_month'=>'7',
            ],
            [
                'name'=>'Leo',
                'start_day'=>'23',
                'start_month'=>'7',
                'end_day'=>'23',
                'end_month'=>'8',
            ],
            [
                'name'=>'Virgo',
                'start_day'=>'24',
                'start_month'=>'8',
                'end_day'=>'23',
                'end_month'=>'9',
            ],
            [
                'name'=>'Libra',
                'start_day'=>'24',
                'start_month'=>'9',
                'end_day'=>'23',
                'end_month'=>'10',
            ],
            [
                'name'=>'Scorpio',
                'start_day'=>'24',
                'start_month'=>'10',
                'end_day'=>'22',
                'end_month'=>'11',
            ],
            [
                'name'=>'Sagittarius',
                'start_day'=>'23',
                'start_month'=>'11',
                'end_day'=>'21',
                'end_month'=>'12',
            ],
            [
                'name'=>'Capricorn',
                'start_day'=>'22',
                'start_month'=>'12',
                'end_day'=>'20',
                'end_month'=>'1',
            ],
            [
                'name'=>'Aquarius',
                'start_day'=>'21',
                'start_month'=>'1',
                'end_day'=>'18',
                'end_month'=>'2',
            ],
            [
                'name'=>'Pisces',
                'start_day'=>'19',
                'start_month'=>'2',
                'end_day'=>'20',
                'end_month'=>'3',
            ],
        ];

        Zodiac::insert($rows);
    }
}
