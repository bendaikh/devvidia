<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FixStorageLinks extends Command
{
    protected $signature = 'storage:fix {--force : Force recreation of symlink}';
    protected $description = 'Diagnose and fix storage link issues';

    public function handle()
    {
        $this->info('🔍 Diagnosing Laravel Storage Configuration...');
        $this->newLine();

        $publicStoragePath = public_path('storage');
        $storageAppPublicPath = storage_path('app/public');
        $storageProjectsPath = storage_path('app/public/projects');

        // Check 1: Storage directory exists
        $this->info('1️⃣  Checking storage/app/public directory...');
        if (File::isDirectory($storageAppPublicPath)) {
            $this->line("   ✅ Directory exists: {$storageAppPublicPath}");
        } else {
            $this->warn("   ⚠️  Directory missing: {$storageAppPublicPath}");
            File::makeDirectory($storageAppPublicPath, 0755, true);
            $this->info("   ✅ Created directory");
        }

        // Check 2: Projects subdirectory exists
        $this->info('2️⃣  Checking projects subdirectory...');
        if (File::isDirectory($storageProjectsPath)) {
            $fileCount = count(File::files($storageProjectsPath));
            $this->line("   ✅ Projects directory exists with {$fileCount} files");
        } else {
            $this->warn("   ⚠️  Projects directory missing");
            File::makeDirectory($storageProjectsPath, 0755, true);
            $this->info("   ✅ Created projects directory");
        }

        // Check 3: Public storage symlink
        $this->info('3️⃣  Checking public/storage symlink...');
        $shouldRecreate = false;
        
        if (File::exists($publicStoragePath)) {
            if (is_link($publicStoragePath)) {
                $target = readlink($publicStoragePath);
                $this->line("   ℹ️  Symlink exists, points to: {$target}");
                
                if ($this->option('force')) {
                    $this->warn("   🔄 Forcing symlink recreation...");
                    File::delete($publicStoragePath);
                    $shouldRecreate = true;
                } else {
                    $expectedTarget = $storageAppPublicPath;
                    $actualTarget = realpath($target);
                    $expectedTargetReal = realpath($expectedTarget);
                    
                    if ($actualTarget !== $expectedTargetReal) {
                        $this->warn("   ⚠️  Symlink points to wrong location!");
                        $this->warn("      Expected: {$expectedTargetReal}");
                        $this->warn("      Actual: {$actualTarget}");
                        
                        File::delete($publicStoragePath);
                        $shouldRecreate = true;
                    } else {
                        $this->line("   ✅ Symlink is correct");
                        $this->testFileAccess();
                        return Command::SUCCESS;
                    }
                }
            } else {
                $this->error("   ❌ public/storage exists but is not a symlink!");
                $this->warn("      This is a directory or file. Removing it...");
                
                if (File::isDirectory($publicStoragePath)) {
                    File::deleteDirectory($publicStoragePath);
                } else {
                    File::delete($publicStoragePath);
                }
                $shouldRecreate = true;
            }
        } else {
            $shouldRecreate = true;
        }

        // Create symlink
        if ($shouldRecreate) {
            $this->info('4️⃣  Creating symlink...');
            try {
                if (windows_os()) {
                    $this->warn("   ⚠️  Windows detected. Attempting symlink creation...");
                    $this->warn("      Note: Symlinks on Windows may require administrator privileges");
                }

                // Use Laravel's storage:link functionality
                $this->call('storage:link');
                
                if (File::exists($publicStoragePath)) {
                    $this->line("   ✅ Symlink created successfully");
                } else {
                    throw new \Exception("Symlink creation failed");
                }
            } catch (\Exception $e) {
                $this->error("   ❌ Failed to create symlink: " . $e->getMessage());
                $this->newLine();
                $this->warn("💡 Alternative solution for shared hosting:");
                $this->line("   1. Run: php artisan storage:copy-files");
                $this->line("   2. Add to deployment script for future updates");
                return Command::FAILURE;
            }
        }

        // Check 5: Permissions
        $this->info('5️⃣  Checking permissions...');
        if (File::isReadable($storageAppPublicPath)) {
            $this->line("   ✅ Storage directory is readable");
        } else {
            $this->error("   ❌ Storage directory is not readable!");
            $this->warn("      Run: chmod -R 755 storage");
        }

        // Test file access
        $this->testFileAccess();

        $this->newLine();
        $this->info('✅ Storage diagnostic complete!');
        
        return Command::SUCCESS;
    }

    protected function testFileAccess()
    {
        $this->info('6️⃣  Testing file access...');
        
        $projectFiles = File::files(storage_path('app/public/projects'));
        if (empty($projectFiles)) {
            $this->warn("   ⚠️  No project images found to test");
            return;
        }

        $testFile = $projectFiles[0];
        $filename = basename($testFile);
        $publicPath = public_path("storage/projects/{$filename}");
        
        if (File::exists($publicPath)) {
            $this->line("   ✅ Test file accessible: /storage/projects/{$filename}");
            $this->line("   📊 File size: " . File::size($publicPath) . " bytes");
        } else {
            $this->error("   ❌ Test file NOT accessible: /storage/projects/{$filename}");
            $this->warn("      File exists in storage but not accessible via public path");
        }
    }
}
