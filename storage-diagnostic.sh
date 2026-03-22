#!/bin/bash

echo "=== Laravel Storage Diagnostic ==="
echo ""

echo "1. Checking if public/storage symlink exists:"
if [ -L "public/storage" ]; then
    echo "✓ Symlink exists"
    echo "   Target: $(readlink public/storage)"
else
    echo "✗ Symlink does NOT exist"
fi
echo ""

echo "2. Checking storage/app/public directory:"
if [ -d "storage/app/public" ]; then
    echo "✓ Directory exists"
    echo "   Contents:"
    ls -lah storage/app/public/
else
    echo "✗ Directory does NOT exist"
fi
echo ""

echo "3. Checking public/storage directory accessibility:"
if [ -d "public/storage" ]; then
    echo "✓ Directory accessible"
    echo "   Contents:"
    ls -lah public/storage/
else
    echo "✗ Directory NOT accessible"
fi
echo ""

echo "4. Checking permissions:"
echo "   storage/app/public: $(stat -c '%a' storage/app/public 2>/dev/null || stat -f '%A' storage/app/public 2>/dev/null)"
echo "   public/storage: $(stat -c '%a' public/storage 2>/dev/null || stat -f '%A' public/storage 2>/dev/null)"
echo ""

echo "5. Checking for project images:"
if [ -d "storage/app/public/projects" ]; then
    echo "   Images in storage/app/public/projects:"
    ls -lh storage/app/public/projects/ | head -5
else
    echo "   No projects directory found"
fi
echo ""

echo "6. Checking web server document root:"
pwd
echo ""

echo "7. Testing file access:"
TEST_FILE=$(ls storage/app/public/projects/*.png 2>/dev/null | head -1)
if [ -n "$TEST_FILE" ]; then
    FILENAME=$(basename "$TEST_FILE")
    echo "   Test file: $FILENAME"
    if [ -f "public/storage/projects/$FILENAME" ]; then
        echo "   ✓ File accessible via public/storage/projects/$FILENAME"
    else
        echo "   ✗ File NOT accessible via public/storage/projects/$FILENAME"
    fi
fi
echo ""

echo "=== Suggested Solutions ==="
echo ""
if [ ! -L "public/storage" ]; then
    echo "Run: php artisan storage:link"
elif [ ! -d "storage/app/public" ]; then
    echo "Run: mkdir -p storage/app/public"
else
    echo "Check:"
    echo "1. APP_URL in .env matches your domain"
    echo "2. Web server is serving from the 'public' directory"
    echo "3. .htaccess rewrite rules are working"
fi
