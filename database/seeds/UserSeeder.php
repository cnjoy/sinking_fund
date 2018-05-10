<?php
use League\Csv\Reader;
use League\Csv\Statement;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $csv = Reader::createFromPath('csv/users.csv', 'r');
        $csv->setHeaderOffset(0); //set the CSV header offset

        //get 25 records starting from the 11th row
        $stmt = (new Statement())
            ->offset(0)
            ->limit(26)
        ;

        $records = $stmt->process($csv);
        foreach ($records as $row) {
             \DB::table('users')->insert(
                array(
                    'name' => $row['name'],
                    // 'active' => $row['active'],
                    // 'amount' => $row['amount'],
                    // 'shares' => $row['shares'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                ));
        }
    }


    
}
