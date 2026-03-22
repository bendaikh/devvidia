# Quick Fix: Storage 404 Errors

## 🚨 Problem
Images at `https://devvidia.com/storage/projects/*.png` return 404

## ✅ Quick Solutions

### Solution 1: Run Diagnostic Command (Recommended)
```bash
ssh into your production server
cd /path/to/your/project
php artisan storage:fix
```

### Solution 2: Manual Symlink Fix
```bash
rm -rf public/storage
php artisan storage:link
```

### Solution 3: For Shared Hosting (No Symlink Support)
```bash
# Copy files instead of symlinking
php artisan storage:copy-files

# Add to your deployment:
echo "php artisan storage:copy-files" >> deploy.sh
```

### Solution 4: Check Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 📝 Verify Fix Worked

Test a file:
```bash
# Get a filename
ls storage/app/public/projects/ | head -1

# Test access (replace FILENAME)
curl -I https://devvidia.com/storage/projects/FILENAME.png

# Should return "HTTP/2 200" not "HTTP/2 404"
```

## 📚 Full Documentation

See `STORAGE_FIX_GUIDE.md` for detailed troubleshooting.

## 🆘 Still Not Working?

1. Check if web server serves from `public/` folder
2. Verify `.env` has: `APP_URL=https://devvidia.com`
3. Ensure `.htaccess` exists in `public/` folder
4. Check web server error logs
