<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Branch;
use App\Models\User;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Companies
        $companies = [
            [
                'name' => 'Clínica San Miguel',
                'domain' => 'sanmiguel',
                'subscription_status' => 'active',
                'trial_ends_at' => now()->addMonths(1),
                'settings' => json_encode(['timezone' => 'America/Santiago']),
                'status' => true
            ],
            [
                'name' => 'Centro Médico Aurora',
                'domain' => 'aurora',
                'subscription_status' => 'active',
                'trial_ends_at' => now()->addMonths(1),
                'settings' => json_encode(['timezone' => 'America/Santiago']),
                'status' => true
            ],
            [
                'name' => 'Clínica Providencia',
                'domain' => 'providencia',
                'subscription_status' => 'trial',
                'trial_ends_at' => now()->addDays(15),
                'settings' => json_encode(['timezone' => 'America/Santiago']),
                'status' => true
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }

        // Branches
        $branches = [
            // San Miguel branches
            [
                'company_id' => 1,
                'name' => 'Sucursal Central',
                'address' => 'Av. Principal 123, San Miguel',
                'phone' => '+56912345678',
                'status' => true
            ],
            [
                'company_id' => 1,
                'name' => 'Sucursal Norte',
                'address' => 'Calle Norte 456, San Miguel',
                'phone' => '+56912345679',
                'status' => true
            ],
            // Aurora branches
            [
                'company_id' => 2,
                'name' => 'Sede Principal',
                'address' => 'Av. Aurora 789, Providencia',
                'phone' => '+56912345680',
                'status' => true
            ],
            // Providencia branches
            [
                'company_id' => 3,
                'name' => 'Providencia Centro',
                'address' => 'Av. Providencia 1234',
                'phone' => '+56912345681',
                'status' => true
            ]
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }

        // Roles and Permissions
        $roles = ['admin', 'doctor', 'staff', 'patient'];
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName, 'guard_name' => 'web']);
        }

        $permissions = [
            'view_appointments',
            'create_appointments',
            'edit_appointments',
            'delete_appointments',
            'manage_doctors',
            'manage_schedules',
            'manage_users',
            'manage_company'
        ];

        foreach ($permissions as $permName) {
            Permission::create(['name' => $permName, 'guard_name' => 'web']);
        }

        // Users
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Doctor Smith',
                'email' => 'smith@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Patient One',
                'email' => 'patient1@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Doctors
        $doctors = [
            [
                'branch_id' => 1,
                'name' => 'Dr. Juan Pérez',
                'email' => 'juan.perez@clinica.com',
                'phone' => '+56912345682',
                'status' => true
            ],
            [
                'branch_id' => 1,
                'name' => 'Dra. María González',
                'email' => 'maria.gonzalez@clinica.com',
                'phone' => '+56912345683',
                'status' => true
            ],
            [
                'branch_id' => 2,
                'name' => 'Dr. Carlos Rodríguez',
                'email' => 'carlos.rodriguez@clinica.com',
                'phone' => '+56912345684',
                'status' => true
            ],
            [
                'branch_id' => 3,
                'name' => 'Dra. Ana Martínez',
                'email' => 'ana.martinez@clinica.com',
                'phone' => '+56912345685',
                'status' => true
            ]
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }

        // Doctor Schedules
        foreach (range(1, 4) as $doctorId) {
            foreach (range(1, 5) as $dayOfWeek) { // Monday to Friday
                DoctorSchedule::create([
                    'doctor_id' => $doctorId,
                    'day_of_week' => $dayOfWeek,
                    'start_time' => '09:00:00',
                    'end_time' => '18:00:00',
                    'appointment_duration' => 45
                ]);
            }
        }

        // Appointments
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        foreach (range(1, 20) as $index) {
            Appointment::create([
                'doctor_id' => rand(1, 4),
                'user_id' => rand(1, 3),
                'date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'start_time' => '09:00:00',
                'end_time' => '09:45:00',
                'status' => $statuses[array_rand($statuses)],
                'notes' => 'Consulta de rutina #' . $index
            ]);
        }

        // Guest appointments
        foreach (range(1, 5) as $index) {
            Appointment::create([
                'doctor_id' => rand(1, 4),
                'guest_name' => 'Invitado ' . $index,
                'guest_email' => 'guest' . $index . '@example.com',
                'guest_phone' => '+569' . rand(10000000, 99999999),
                'date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'start_time' => '10:00:00',
                'end_time' => '10:45:00',
                'status' => $statuses[array_rand($statuses)],
                'notes' => 'Consulta invitado #' . $index
            ]);
        }
    }
}
