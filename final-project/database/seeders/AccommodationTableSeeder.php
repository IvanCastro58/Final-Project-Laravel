<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accommodation;

class AccommodationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Accommodation::create([
            'accommodation_name' => 'Boracay Beach House',
            'description' => 'A beachfront house on Boracay Island, offering white sand views and relaxing sea breezes.',
            'capacity' => 6,
            'price_per_night' => 8000.00,
            'availability_status' => true,
        ]);

        Accommodation::create([
            'accommodation_name' => 'Baguio Mountain Cabin',
            'description' => 'A cozy cabin in Baguio City with mountain views and a cool climate, perfect for a peaceful getaway.',
            'capacity' => 4,
            'price_per_night' => 5000.00,
            'availability_status' => true,
        ]);

        Accommodation::create([
            'accommodation_name' => 'Makati City Condo',
            'description' => 'Modern condo in the heart of Makati, ideal for business travelers with access to malls and dining.',
            'capacity' => 2,
            'price_per_night' => 4000.00,
            'availability_status' => false,
        ]);

        Accommodation::create([
            'accommodation_name' => 'Palawan Private Villa',
            'description' => 'A private villa with breathtaking ocean views in El Nido, Palawan. Perfect for families and groups.',
            'capacity' => 8,
            'price_per_night' => 12000.00,
            'availability_status' => false,
        ]);

        Accommodation::create([
            'accommodation_name' => 'Vigan Heritage Home',
            'description' => 'A charming heritage home in the historic city of Vigan, capturing old-world Filipino architecture.',
            'capacity' => 5,
            'price_per_night' => 4500.00,
            'availability_status' => true,
        ]);
    }
}