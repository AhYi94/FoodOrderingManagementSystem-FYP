<?php

use App\Model\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    protected $defaultAdmins = [
        ['name' => 'Adam', 'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'email'=>'adam@gmail.com'],
    ];
        
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->defaultAdmins)->each(function ($admin){
            factory(Admin::class)->create($admin);
        });
    }
}
