<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'dimas@portofolio.test'],
            [
                'name' => 'Dimas Riyan Wirayuda',
                'password' => Hash::make('password123'),
            ]
        );

        $projects = [
            [
                'title' => 'Academic Management System Migration',
                'category' => 'Enterprise Web App',
                'description' => 'Migrasi sistem manajemen akademik dari native PHP ke framework Laravel dengan modul CRUD data master (akademik, dosen, prodi, mahasiswa, mata kuliah), presensi pertemuan AJAX auto-reload, Yajra DataTables, serta ekspor/impor PDF dan Excel.',
                'tech_stack' => ['Laravel', 'PHP', 'AJAX', 'Yajra DataTables', 'PhpSpreadsheet'],
                'github_url' => 'https://github.com/dimasriyan',
                'is_featured' => true,
            ],
            [
                'title' => 'Inventory & POS System + 58mm Thermal Print',
                'category' => 'Retail & Point of Sale',
                'description' => 'Sistem kasir (POS) dan inventori dengan cetak struk thermal 58mm, pembuatan barcode otomatis via phpqrcode, pengelolaan barang konsinyasi, serta laporan keuangan PDF.',
                'tech_stack' => ['Laravel', 'MySQL', 'phpqrcode', 'Thermal 58mm', 'PDF Export'],
                'github_url' => 'https://github.com/dimasriyan',
                'is_featured' => true,
            ],
            [
                'title' => 'Smart Inventory Forecasting (SES)',
                'category' => 'Decision Support System',
                'description' => 'Aplikasi web inventori cerdas berbasis algoritma Single Exponential Smoothing (SES) dengan automatic alpha tuning (α = 0.1 hingga 0.9) dan evaluasi error MAPE.',
                'tech_stack' => ['Laravel', 'PHP', 'SES Algorithm', 'MAPE Evaluation'],
                'github_url' => 'https://github.com/dimasriyan',
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $item) {
            Project::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
