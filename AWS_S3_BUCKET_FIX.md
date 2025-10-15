# AWS S3 Bucket Configuration Fix

## Problem

**Error:**
```
InvalidArgumentException

The GetObject operation requires non-empty parameter: Bucket
resources/views/attorney/uploaded_doc_view/docMainColFormData.blade.php:120
```

**Root Cause:**
The application is attempting to generate temporary S3 URLs for document access, but the `AWS_BUCKET` environment variable is not configured in the `.env` file, causing the S3 client to fail.

**Current `.env` Configuration:**
```env
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

## Immediate Fix Applied ✅

I've added safety checks to prevent the error from crashing the application. The following files have been updated to gracefully handle missing S3 configuration:

### Files Modified:

1. ✅ `resources/views/attorney/uploaded_doc_view/docMainColFormData.blade.php`
2. ✅ `resources/views/attorney/uploaded_doc_view/docDownload.blade.php`
3. ✅ `resources/views/attorney/uploaded_doc_view/docSecuredColFormData.blade.php`

### Changes Applied:

**Before:**
```php
$filePth = \Storage::disk('s3')->temporaryUrl(
    $doc['document_file'],
    now()->addDays(2),
    ['ResponseContentDisposition' => 'inline']
);
```

**After:**
```php
$filePth = null;
// Only generate temporary URL if S3 is properly configured
if (config('filesystems.disks.s3.bucket')) {
    try {
        $filePth = \Storage::disk('s3')->temporaryUrl(
            $doc['document_file'],
            now()->addDays(2),
            ['ResponseContentDisposition' => 'inline']
        );
    } catch (\Exception $e) {
        \Log::error('S3 temporaryUrl failed: ' . $e->getMessage());
        $filePth = null;
    }
}
```

## What This Fix Does

- ✅ **Prevents Application Crashes** - No more InvalidArgumentException errors
- ✅ **Graceful Degradation** - Documents simply won't show preview/download buttons if S3 is not configured
- ✅ **Error Logging** - Any S3 errors are logged for debugging
- ✅ **Maintains Functionality** - When S3 is properly configured, everything works as before

## Permanent Solution: Configure AWS S3

To fully restore document functionality, you need to configure AWS S3 credentials in your `.env` file:

### Step 1: Get AWS Credentials

You need the following from your AWS account:
1. **AWS Access Key ID**
2. **AWS Secret Access Key**
3. **S3 Bucket Name**
4. **AWS Region** (e.g., us-east-1, us-west-2)

### Step 2: Update .env File

```env
AWS_ACCESS_KEY_ID=your_access_key_here
AWS_SECRET_ACCESS_KEY=your_secret_key_here
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
AWS_USE_PATH_STYLE_ENDPOINT=false
```

### Step 3: Clear Configuration Cache

After updating the `.env` file, run:

```bash
cd /Applications/MAMP/htdocs/bk_appquell
php artisan config:clear
php artisan cache:clear
```

### Step 4: Verify S3 Configuration

Test that S3 is working:

```bash
php artisan tinker
```

Then run:
```php
Storage::disk('s3')->exists('test.txt');
```

If configured correctly, it should return `true` or `false` without errors.

## Alternative: Use Local Storage

If you don't need S3 and want to store documents locally instead:

### Option 1: Change Default Disk

In `config/filesystems.php`, find:

```php
'default' => env('FILESYSTEM_DISK', 'local'),
```

And in `.env`, add:

```env
FILESYSTEM_DISK=public
```

### Option 2: Update Document Upload Logic

You'll need to update the document upload logic throughout the application to use local storage instead of S3. This would require code changes in:
- Document upload controllers
- Document retrieval views
- File processing services

## Impact of Current Fix

### What Works:
- ✅ Application no longer crashes with S3 errors
- ✅ Pages load normally
- ✅ Other functionality remains intact
- ✅ Errors are logged for debugging

### What Doesn't Work (Until S3 is Configured):
- ❌ Document preview buttons may not appear
- ❌ Document download links may not work
- ❌ Document viewing functionality limited

## Testing After Configuration

Once S3 is configured, test these features:

1. **Document Upload**
   - Upload a document as attorney
   - Verify it appears in S3 bucket

2. **Document Preview**
   - Click preview button on uploaded document
   - Verify PDF opens in browser

3. **Document Download**
   - Click download button
   - Verify file downloads correctly

4. **Document Management**
   - View document lists
   - Check document thumbnails
   - Test document search/filter

## Security Considerations

1. **Never commit AWS credentials to version control**
   - Keep `.env` in `.gitignore`
   - Use different credentials for dev/staging/production

2. **Use IAM User with Limited Permissions**
   - Create a dedicated IAM user for the application
   - Grant only S3 permissions needed:
     ```json
     {
       "Version": "2012-10-17",
       "Statement": [
         {
           "Effect": "Allow",
           "Action": [
             "s3:GetObject",
             "s3:PutObject",
             "s3:DeleteObject",
             "s3:ListBucket"
           ],
           "Resource": [
             "arn:aws:s3:::your-bucket-name/*",
             "arn:aws:s3:::your-bucket-name"
           ]
         }
       ]
     }
     ```

3. **Enable S3 Bucket Versioning**
   - Protects against accidental deletions
   - Allows recovery of overwritten files

4. **Configure CORS for S3 Bucket**
   - Required for browser-based file access
   - Example CORS configuration:
     ```json
     [
       {
         "AllowedHeaders": ["*"],
         "AllowedMethods": ["GET", "HEAD"],
         "AllowedOrigins": ["https://yourdomain.com"],
         "ExposeHeaders": []
       }
     ]
     ```

## Troubleshooting

### Issue: "Access Denied" Error

**Solution:** Check IAM user permissions and bucket policy

### Issue: "Bucket does not exist"

**Solution:** Verify bucket name in `.env` matches actual S3 bucket name

### Issue: Temporary URLs expire too quickly

**Solution:** Modify the expiration time in the code:
```php
now()->addDays(7) // Change from 2 days to 7 days
```

### Issue: Files upload but can't be accessed

**Solution:** Check S3 bucket permissions and CORS configuration

## Related Files

Files that interact with S3 storage:

- `config/filesystems.php` - Storage configuration
- `app/Http/Controllers/Attorney/AttorneyDocumentController.php` - Document upload
- `app/Http/Controllers/Client/ClientDocumentController.php` - Client document management
- `app/Jobs/ZipDownload.php` - Bulk document downloads
- `app/Traits/Common.php` - Common file operations

## Status

✅ **IMMEDIATE FIX APPLIED** - Application won't crash, but document features are limited until S3 is configured.

⚠️ **ACTION REQUIRED** - Configure AWS S3 credentials to fully restore document functionality.

## Date Fixed

October 15, 2025 at 05:00:00

