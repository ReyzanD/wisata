# Bug Fix - Image Upload Path Issue (Nov 9, 2025)

## Problem
Images were not showing on the page because they were being stored in the wrong directory:
- **Wrong:** `storage/app/private/public/destinations/` 
- **Correct:** `storage/app/public/destinations/`

This happened because the `storeAs()` method was being called incorrectly.

## Root Cause
Using `storeAs('public/destinations', $filename)` on the default disk stores files in:
`storage/app/public/destinations/` (creates nested public folder)

## Solution
Changed all file upload code to use the correct syntax:
```php
// BEFORE (Wrong)
$image->storeAs('public/destinations', $imageName);

// AFTER (Correct)
$image->storeAs('destinations', $imageName, 'public');
```

## Files Fixed
1. `app/Http/Controllers/DestinationController.php` - store() and update() methods
2. `app/Http/Controllers/GalleryController.php` - store() and update() methods

## Manual Fix Applied
Moved existing uploaded image from wrong location to correct location:
- From: `storage/app/private/public/destinations/1762697094_images.jpeg`
- To: `storage/app/public/destinations/1762697094_images.jpeg`

## Verification
Images should now be accessible at:
- Destinations: `http://localhost:8000/storage/destinations/filename.jpg`
- Galleries: `http://localhost:8000/storage/galleries/filename.jpg`

The `storage` symlink points to `storage/app/public`, so files in `storage/app/public/destinations` are accessible via `/storage/destinations`.
