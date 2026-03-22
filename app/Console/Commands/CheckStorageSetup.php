<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class CheckStorageSetup extends Command
{
    protected $signature = 'storage:check';
    protected $description = 'Check storage configuration and diagnose issues';

    public function handle()
    {
        $this->info('=== Storage Configuration Check ===');
        $this->newLine();

        // Check APP_URL
        $appUrl = config('app.url');
        $this->line("APP_URL: {$appUrl}");

        // Check public disk configuration
        $publicDisk = config('filesystems.disks.public');
        $this->line("Public Disk URL: " . ($publicDisk['url'] ?? 'Not set'));
        $this->line("Public Disk Root: " . ($publicDisk['root'] ?? 'Not set'));
        $this->line("Public Disk Serve: " . ($publicDisk['serve'] ?? false ? 'Enabled' : 'Disabled'));
        $this->newLine();

        // Check symlink
        $symlinkPath = public_path('storage');
        $symlinkExists = is_link($symlinkPath) || is_dir($symlinkPath);
        $this->line("Symlink (public/storage): " . ($symlinkExists ? 'Exists' : 'Missing'));
        
        if ($symlinkExists && is_link($symlinkPath)) {
            $this->line("Symlink Target: " . readlink($symlinkPath));
        }
        $this->newLine();

        // Check storage directory
        $storagePath = storage_path('app/public');
        $this->line("Storage Path: {$storagePath}");
        $this->line("Storage Exists: " . (is_dir($storagePath) ? 'Yes' : 'No'));
        $this->line("Storage Writable: " . (is_writable($storagePath) ? 'Yes' : 'No'));
        $this->newLine();

        // Check projects directory
        $projectsPath = storage_path('app/public/projects');
        $projectsExists = is_dir($projectsPath);
        $this->line("Projects Directory: " . ($projectsExists ? 'Exists' : 'Missing'));
        
        if ($projectsExists) {
            $files = glob($projectsPath . '/*');
            $this->line("Files in projects/: " . count($files));
        }
        $this->newLine();

        // Check database records
        $projects = Project::whereNotNull('image_path')->get();
        $this->line("Projects with images in DB: " . $projects->count());
        
        if ($projects->count() > 0) {
            $this->newLine();
            $this->info('=== Image File Check ===');
            
            foreach ($projects->take(5) as $project) {
                $exists = Storage::disk('public')->exists($project->image_path);
                $status = $exists ? '<fg=green>OK</>' : '<fg=red>MISSING</>';
                $this->line("{$status} {$project->name}: {$project->image_path}");
            }
        }

        $this->newLine();
        $this->info('=== Test URLs ===');
        $testPath = $projects->first()?->image_path ?? 'projects/test.png';
        $this->line("Asset URL: " . asset('storage/' . $testPath));
        $this->line("Storage URL: " . Storage::disk('public')->url($testPath));

        return Command::SUCCESS;
    }
}
