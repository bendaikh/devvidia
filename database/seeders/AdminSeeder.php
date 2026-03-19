<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Superadmin
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@devvidia.com',
            'password' => Hash::make('Devvidia@2026'),
            'role' => 'superadmin',
        ]);

        // Seed Services
        Service::create([
            'icon' => '💻',
            'title_en' => 'Web App Development',
            'title_fr' => 'Développement d\'Applications Web',
            'description_en' => 'We create custom web apps tailored to your needs, with a focus on user experience and cutting-edge technology. From concept to deployment.',
            'description_fr' => 'Nous créons des applications web personnalisées adaptées à vos besoins, en mettant l\'accent sur l\'expérience utilisateur et les technologies de pointe. Du concept au déploiement.',
            'order' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'icon' => '📱',
            'title_en' => 'Mobile App Development',
            'title_fr' => 'Développement d\'Applications Mobiles',
            'description_en' => 'Native and cross-platform mobile applications designed to engage users and deliver seamless performance across all devices.',
            'description_fr' => 'Applications mobiles natives et multiplateformes conçues pour engager les utilisateurs et offrir des performances fluides sur tous les appareils.',
            'order' => 2,
            'is_active' => true,
        ]);

        Service::create([
            'icon' => '🖥️',
            'title_en' => 'Desktop Software',
            'title_fr' => 'Logiciels de Bureau',
            'description_en' => 'Powerful desktop applications with rich functionality, optimized performance, and intuitive interfaces for productivity and efficiency.',
            'description_fr' => 'Applications de bureau puissantes avec des fonctionnalités riches, des performances optimisées et des interfaces intuitives pour la productivité et l\'efficacité.',
            'order' => 3,
            'is_active' => true,
        ]);

        // Seed Projects
        Project::create([
            'icon' => '📊',
            'name' => 'POS Event',
            'description_en' => 'A modern point-of-sale system designed specifically for event management, featuring real-time analytics and inventory tracking.',
            'description_fr' => 'Un système de point de vente moderne conçu spécifiquement pour la gestion d\'événements, avec des analyses en temps réel et un suivi des stocks.',
            'order' => 1,
            'is_active' => true,
        ]);

        Project::create([
            'icon' => '💳',
            'name' => 'eCommerce Platform',
            'description_en' => 'Full-featured online marketplace with payment integration, inventory management, and customer relationship tools.',
            'description_fr' => 'Plateforme de marché en ligne complète avec intégration de paiement, gestion des stocks et outils de relation client.',
            'order' => 2,
            'is_active' => true,
        ]);

        Project::create([
            'icon' => '🎮',
            'name' => 'Driving Messenger',
            'description_en' => 'Real-time communication platform designed for delivery and transportation services with GPS tracking and route optimization.',
            'description_fr' => 'Plateforme de communication en temps réel conçue pour les services de livraison et de transport avec suivi GPS et optimisation d\'itinéraire.',
            'order' => 3,
            'is_active' => true,
        ]);

        Project::create([
            'icon' => '⚙️',
            'name' => 'Startup API Kazon',
            'description_en' => 'Scalable API infrastructure providing robust backend services for startups, with comprehensive documentation and security.',
            'description_fr' => 'Infrastructure API évolutive fournissant des services backend robustes pour les startups, avec une documentation complète et une sécurité.',
            'order' => 4,
            'is_active' => true,
        ]);

        Project::create([
            'icon' => '🔒',
            'name' => 'cyber.blackmarket.ltd',
            'description_en' => 'Secure marketplace platform with advanced encryption and authentication systems for digital asset trading.',
            'description_fr' => 'Plateforme de marché sécurisée avec des systèmes de cryptage et d\'authentification avancés pour le commerce d\'actifs numériques.',
            'order' => 5,
            'is_active' => true,
        ]);

        Project::create([
            'icon' => '🎨',
            'name' => 'Drivio Messenger',
            'description_en' => 'Modern messaging application with rich media support, end-to-end encryption, and cross-platform synchronization.',
            'description_fr' => 'Application de messagerie moderne avec support multimédia enrichi, cryptage de bout en bout et synchronisation multiplateforme.',
            'order' => 6,
            'is_active' => true,
        ]);
    }
}
