<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'phone'    => '081234567890',
                'role'     => 'admin',
                'admin_id' => 'ADM-001',
            ]
        );

        $alatTulis = Category::create(['name' => 'Alat Tulis']);
        Item::insert([
            ['category_id' => $alatTulis->id, 'name' => 'Pulpen Pilot BPS-GP',     'price' => 8000,  'quantity' => 150, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $alatTulis->id, 'name' => 'Pensil 2B Staedtler',      'price' => 5000,  'quantity' => 200, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $alatTulis->id, 'name' => 'Penghapus Faber Castell',  'price' => 3000,  'quantity' => 100, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $alatTulis->id, 'name' => 'Stabilo Boss Highlighter', 'price' => 12000, 'quantity' => 80,  'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $bukuKertas = Category::create(['name' => 'Buku & Kertas']);
        Item::insert([
            ['category_id' => $bukuKertas->id, 'name' => 'Buku Tulis Sinar Dunia 58 Lembar', 'price' => 7500,  'quantity' => 300, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $bukuKertas->id, 'name' => 'Kertas HVS A4 70gr 500 Lembar',    'price' => 50000, 'quantity' => 50,  'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $bukuKertas->id, 'name' => 'Block Note Spiral A5',              'price' => 15000, 'quantity' => 120, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $kantorTools = Category::create(['name' => 'Peralatan Kantor']);
        Item::insert([
            ['category_id' => $kantorTools->id, 'name' => 'Stapler Max HD-10',         'price' => 35000, 'quantity' => 40, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $kantorTools->id, 'name' => 'Gunting Kenko 7 inci',       'price' => 20000, 'quantity' => 60, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $kantorTools->id, 'name' => 'Selotip Transparan 12mm',    'price' => 5000,  'quantity' => 0,  'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $elektronik = Category::create(['name' => 'Elektronik & Aksesoris']);
        Item::insert([
            ['category_id' => $elektronik->id, 'name' => 'Baterai AA Alkaline Panasonic', 'price' => 18000,  'quantity' => 90, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $elektronik->id, 'name' => 'Kabel USB Type-C 1 Meter',      'price' => 25000,  'quantity' => 55, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $elektronik->id, 'name' => 'Mouse Wireless Logitech M170',  'price' => 150000, 'quantity' => 20, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $baju = Category::create(['name' => 'Baju']);
        Item::insert([
            ['category_id' => $baju->id, 'name' => 'Kaos Polos Katun Premium',      'price' => 75000,  'quantity' => 50, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $baju->id, 'name' => 'Kemeja Lengan Panjang Formal',   'price' => 120000, 'quantity' => 35, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $jasa = Category::create(['name' => 'Jasa']);
        Item::insert([
            ['category_id' => $jasa->id, 'name' => 'Jasa Desain Grafis',            'price' => 200000, 'quantity' => 10, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $jasa->id, 'name' => 'Jasa Pengetikan Dokumen',       'price' => 50000,  'quantity' => 20, 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $this->command->info('Admin: admin@gmail.com / admin123');
    }
}
