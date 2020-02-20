<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('admin123');

        App\Employee::create([
            'name'  => 'Super Admin',
            'email' =>  'superadmin@larry.co',
            'system_id' => 'ITPMY036',
            'password' => $password,
            'company_id' => 1
        ]);

        //factory(App\Employee::class, 5)->create();
    }
}
