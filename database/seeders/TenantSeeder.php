<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insere dados de exemplo na tabela `tenants`
        DB::table('tenants')->insert([
            [
                'name' => 'Tenant 1',
                'logo' => 'logos/tenant1.png', // Caminho para o logo (opcional)
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
