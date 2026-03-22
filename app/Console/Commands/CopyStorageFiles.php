<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyStorageFiles extends Command
{
    protected $signature = 'storage:copy-files {--watch : Watch for new files and copy them automatically}';
    protected $description = 'Copy storage files to public directory (alternative to symlinks)';

    public function handle()
    {
        $this->info('📦 Copying storage files to public directory...');
        $this->newLine();

        $sourceBase = storage_path('app/public');
        $targetBase = public_path('storage');

        // Ensure target directory exists
        if (!File::isDirectory($targetBase)) {
            File::makeDirectory($targetBase, 0755, true);
            $this->line("✅ Created directory: {$targetBase}");
        }

        // Copy files
        $copiedCount = 0;
        $errorCount = 0;

        $this->copyDirectory($sourceBase, $targetBase, $copiedCount, $errorCount);

        $this->newLine();
        $this->info("📊 Summary:");
        $this->line("   ✅ Files copied: {$copiedCount}");
        if ($errorCount > 0) {
            $this->error("   ❌ Errors: {$errorCount}");
        }

        // Watch mode
        if ($this->option('watch')) {
            $this->newLine();
            $this->info('👀 Watching for new files... (Press Ctrl+C to stop)');
            $this->watchForChanges($sourceBase, $targetBase);
        }

        return Command::SUCCESS;
    }

    protected function copyDirectory($source, $target, &$copiedCount, &$errorCount)
    {
        if (!File::isDirectory($source)) {
            return;
        }

        // Get all files and directories
        $items = File::allFiles($source);

        foreach ($items as $item) {
            $relativePath = str_replace($source, '', $item->getPathname());
            $targetPath = $target . $relativePath;
            $targetDir = dirname($targetPath);

            try {
                // Ensure target directory exists
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }

                // Copy file if it doesn't exist or is different
                if (!File::exists($targetPath) || File::hash($item->getPathname()) !== File::hash($targetPath)) {
                    File::copy($item->getPathname(), $targetPath);
                    $this->line("   📄 Copied: {$relativePath}");
                    $copiedCount++;
                } else {
                    $this->line("   ⏭️  Skipped (unchanged): {$relativePath}", 'v');
                }
            } catch (\Exception $e) {
                $this->error("   ❌ Failed to copy {$relativePath}: " . $e->getMessage());
                $errorCount++;
            }
        }
    }

    protected function watchForChanges($source, $target)
    {
        $lastCheck = [];

        while (true) {
            $items = File::allFiles($source);
            
            foreach ($items as $item) {
                $path = $item->getPathname();
                $modified = $item->getMTime();
                
                if (!isset($lastCheck[$path]) || $lastCheck[$path] !== $modified) {
                    $relativePath = str_replace($source, '', $path);
                    $targetPath = $target . $relativePath;
                    $targetDir = dirname($targetPath);

                    try {
                        if (!File::isDirectory($targetDir)) {
                            File::makeDirectory($targetDir, 0755, true);
                        }
                        
                        File::copy($path, $targetPath);
                        $this->line("   🔄 Updated: {$relativePath}");
                        $lastCheck[$path] = $modified;
                    } catch (\Exception $e) {
                        $this->error("   ❌ Failed: " . $e->getMessage());
                    }
                }
            }

            sleep(2); // Check every 2 seconds
        }
    }
}
