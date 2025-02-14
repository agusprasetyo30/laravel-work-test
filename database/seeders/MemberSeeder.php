<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'email' => 'andi@example.com', 
            'name'  => 'Andi'
        ]);

        Member::create([
            'email' => 'budi@example.com',
            'name'  => 'Budi'
        ]);

        Member::create([
            'email' => 'citra@example.com',
            'name'  =>'Citra'
        ]);
    }
}
