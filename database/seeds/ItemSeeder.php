<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => 'Oculus Quest 128GB',
            'description' => 'The Oculus Quest 128GB are the first active VR-glasses of Oculus for which you don\'t need a laptop. The only thing you need is the mobile app to use the Oculus Quest everywhere you want.',
            'image' => 'storage\images\oculusQuest.jpg',
            'manual' => 'storage\manuals\oculusQuest.pdf'
        ]);

        DB::table('items')->insert([
            'name' => 'Alienware Gaming Laptop',
            'description' => 'Alienware laptops are engineered with copper cooling, Quad HD+ displays, high-performance CPUs and the latest Intel® Core processors, for an impressive unified experience that brings your games to life.',
            'image' => 'storage\images\alienwareLaptop.jpg',
            'manual' => 'storage\manuals\alienwareLaptop.pdf'
        ]);

        DB::table('items')->insert([
            'name' => 'Playstation 4',
            'description' => 'The PlayStation 4 (PS4) is an eighth-generation home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 in February 2013, it was launched on November 15 in North America, November 29 in Europe, South America and Australia, and on February 22, 2014 in Japan. It competes with Microsoft\'s Xbox One and Nintendo\'s Wii U and Switch.',
            'image' => 'storage\images\playstation4.jpg',
            'manual' => 'storage\manuals\playstation4.pdf'
        ]);

        DB::table('items')->insert([
            'name' => 'Creality Ender 3 Pro',
            'description' => 'The Creality Ender 3 Pro is a 3D-printer with a strong orice-quality ratio. The Ender 3 Pro is suitable whether you\'re at home, at the office or at work. The Pro version is an improved version of the popular Ender 3.',
            'image' => 'storage\images\3dPrinter.jpg',
            'manual' => 'storage\manuals\3dPrinter.pdf'
        ]);

    }
}
