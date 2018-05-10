<?php
use League\Csv\Reader;
use League\Csv\Statement;

use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $csv = Reader::createFromPath('csv/members.csv', 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset

        //get 25 records starting from the 11th row
        $stmt = (new Statement())
            ->offset(0)
            ->limit(26)
        ;

        $records = $stmt->process($csv);
        foreach ($records as $row) {
             \DB::table('members')->insert(
                array(
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'is_active' => $row['is_active'],
                    // 'amount' => $row['amount'],
                    'shares' => $row['shares'],
                    'user_id' => $row['user_id'],
                ));
        }
    }


    
}
