<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [
            array(
                "id" => 1,
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("12345"),
                "role_id" => 1  
            ),
            array(
                "id" => 2,
                "name" => "Medical Sale",
                "email" => "medical@gmail.com",
                "password" => Hash::make("12345"),
                "role_id" => 2 
            ),
            array(
                "id" => 3,
                "name" => "Service Sale",
                "email" => "service@gmail.com",
                "password" => Hash::make("12345"),
                "role_id" => 3 
            ),
        ];
        foreach($users as $user)
        {
            $count = User::where("id",$user["id"])->count();
            if($count < 1)
            {
                User::create([
                    "id" => $user["id"],
                    "name" => $user["name"],
                    "email" => $user["email"],
                    "password" => $user["password"],
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}
