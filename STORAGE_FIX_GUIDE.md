# Laravel Storage 404 Fix Guide

## Problem
Images stored in `storage/app/public/projects/` are returning 404 errors when accessed via `https://devvidia.com/storage/projects/{filename}.png` even though:
- `php artisan storage:link` has been run
- Files exist in the storage directory

## Quick Diagnosis

### On Production Server, run:
```bash
php artisan storage:fix
```

This will automatically diagnose and attempt to fix the issue.

## Common Causes & Solutions

### 1. Symlink Not Working (Most Common on Shared Hosting)

**Symptom:** Symlink command runs without error, but files still return 404

**Check:**
```bash
ls -la public/ | grep storage
```

If you see something like `storage -> ../storage/app/public`, the symlink exists.

**Solutions:**

#### Option A: Recreate Symlink with Force
```bash
php artisan storage:fix --force
```

#### Option B: Manual Symlink
```bash
rm -rf public/storage
ln -s ../storage/app/public public/storage
```

#### Option C: Copy Files Instead (For Hosting That Doesn't Support Symlinks)
```bash
# One-time copy
php artisan storage:copy-files

# Or watch mode (keeps copying new files)
php artisan storage:copy-files --watch
```

Then add to your deployment script:
```bash
php artisan storage:copy-files
```

### 2. Web Server Document Root Issue

**Symptom:** Everything works locally but not in production

**Check:** Ensure your web server is serving from the `public` directory, not the root.

**Fix for Apache (.htaccess in root):**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Fix for Nginx (nginx.conf):**
```nginx
root /path/to/your/project/public;
```

### 3. .htaccess Not Being Read

**Symptom:** Other routes work, but storage files don't

**Check:**
```bash
# Verify mod_rewrite is enabled
apache2ctl -M | grep rewrite
```

**Fix:** Ensure `AllowOverride All` is set in your Apache virtual host config.

### 4. APP_URL Mismatch

**Check your `.env` file:**
```bash
APP_URL=https://devvidia.com
```

Make sure it matches your actual domain (including https/http).

### 5. Permission Issues

**Check:**
```bash
ls -la storage/app/public/projects/
```

**Fix:**
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### 6. SELinux (On CentOS/RHEL)

**Check:**
```bash
getenforce
```

**Fix:**
```bash
chcon -R -t httpd_sys_rw_content_t storage/
```

## Testing

### 1. Test Symlink
```bash
# Check if symlink target is accessible
ls -la public/storage/projects/

# Should show the same files as:
ls -la storage/app/public/projects/
```

### 2. Test Web Access
```bash
# Get a filename from storage
FILE=$(ls storage/app/public/projects/ | head -1)

# Try to access it via curl
curl -I https://devvidia.com/storage/projects/$FILE

# Should return 200 OK, not 404
```

### 3. Test File Serving
Create a test file:
```bash
echo "test" > storage/app/public/test.txt
```

Try to access it:
```
https://devvidia.com/storage/test.txt
```

## Alternative Solutions

### Use Direct Public Storage

If symlinks continue to cause issues, modify your application to store files directly in the public directory:

1. **Update `.env`:**
```
FILESYSTEM_DISK=public_direct
```

2. **The `public_direct` disk is already configured in `config/filesystems.php`**

3. **Ensure `public/storage` directory exists:**
```bash
mkdir -p public/storage/projects
chmod -R 755 public/storage
```

4. **Files will now be stored directly in `public/storage/` without needing symlinks**

### Use Cloud Storage (Best for Production)

Configure S3, DigitalOcean Spaces, or similar:

1. **Update `.env`:**
```
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket
AWS_URL=https://your-bucket.s3.amazonaws.com
```

2. **Install AWS SDK:**
```bash
composer require league/flysystem-aws-s3-v3 "^3.0"
```

3. **No symlinks needed, files served directly from CDN**

## Deployment Checklist

Add to your deployment script:

```bash
# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix storage
php artisan storage:fix
# OR if symlinks don't work:
php artisan storage:copy-files

# Set permissions
chmod -R 755 storage bootstrap/cache
```

## Still Not Working?

Run the diagnostic script:
```bash
bash storage-diagnostic.sh
```

Or check Laravel logs:
```bash
tail -f storage/logs/laravel.log
```

Check web server error logs:
```bash
# Apache
tail -f /var/log/apache2/error.log

# Nginx
tail -f /var/log/nginx/error.log
```

## Contact Support

If none of these solutions work, provide the following information:
1. Output of `php artisan storage:fix`
2. Output of `bash storage-diagnostic.sh`
3. Hosting provider name
4. PHP version: `php -v`
5. Laravel version: `php artisan --version`
