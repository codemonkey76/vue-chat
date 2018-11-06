<?php

use App\SmsMessage;
use Illuminate\Database\Seeder;

class SmsMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<30;$i++)
        {
            factory(SmsMessage::class, 10)->create(['number' => $this->generateNumber()]);
        }
    }
    public function generateNumber($countryCode = '61')
    {
        $ret = $countryCode;

        for ($i=0;$i<10;$i++)
        {
            $ret .= mt_rand(0, 9);
        }

        return $ret;
    }
}
