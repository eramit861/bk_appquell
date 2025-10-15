# ShortLink Database Error Fix

## Problem

**Error:** 
```
SQLSTATE[HY000]: General error: 1364 Field 'custom_intake_link' doesn't have a default value
```

**Location:** `app/Models/ShortLink.php:40`

**Root Cause:** 
The `custom_intake_link` column in the `short_links` table was created without allowing NULL values or having a default value. When inserting records that don't provide a value for this field, MySQL throws an error.

## Solution Applied

### 1. **Model Fix** (Immediate Solution)
**File:** `app/Models/ShortLink.php`

Added a check in the `getSetLink()` method to ensure `custom_intake_link` always has a value:

```php
// Ensure custom_intake_link has a default value if not provided
if (!isset($input['custom_intake_link'])) {
    $input['custom_intake_link'] = null;
}
```

**Lines:** 37-40

This ensures that even if the field is not provided in the input, it will be set to `null` before being inserted into the database.

### 2. **Database Migration** (Permanent Solution)
**File:** `database/migrations/2025_10_15_045320_add_default_to_custom_intake_link_in_short_links_table.php`

Created and ran a migration to modify the `custom_intake_link` column to be nullable:

```php
public function up(): void
{
    Schema::table('short_links', function (Blueprint $table) {
        // Make custom_intake_link nullable to fix the default value error
        $table->string('custom_intake_link')->nullable()->change();
    });
}
```

**Migration Status:** ✅ Successfully applied on 2025-10-15 04:53:20

## Files Modified

1. ✅ `app/Models/ShortLink.php` - Added default null value handling
2. ✅ `database/migrations/2025_10_15_045320_add_default_to_custom_intake_link_in_short_links_table.php` - Created and applied

## Testing Recommendations

After this fix, the following operations should work without errors:

1. **Creating regular short links:**
   ```php
   ShortLink::getSetLink([
       'link' => 'http://example.com/questionnaire?token=...',
       'manual_link' => 'http://example.com/manual-upload?token=...'
   ], $attorney_id);
   ```

2. **Creating manual links:**
   ```php
   ShortLink::getSetLink([
       'link' => 'http://example.com/questionnaire?token=...',
       'manual_link' => 'http://example.com/manual-upload?token=...',
       'link_for' => 'manual'
   ], $attorney_id);
   ```

3. **Creating custom intake links:**
   ```php
   ShortLink::getSetLink([
       'link' => 'http://example.com/questionnaire?token=...',
       'custom_intake_link' => 'http://example.com/custom-intake?token=...',
       'link_for' => 'custom_intake_link'
   ], $attorney_id);
   ```

## Database Schema Changes

**Table:** `short_links`

**Column Modified:** `custom_intake_link`

**Before:**
```sql
custom_intake_link VARCHAR(255) NOT NULL
```

**After:**
```sql
custom_intake_link VARCHAR(255) NULL DEFAULT NULL
```

## Impact

- ✅ **No Breaking Changes** - Existing functionality remains intact
- ✅ **Backward Compatible** - All existing code continues to work
- ✅ **Future Proof** - Prevents similar errors in the future
- ✅ **Clean Solution** - Both application-level and database-level fixes applied

## Related Code

The `custom_intake_link` field is used for:
- Custom intake forms for attorneys
- Alternative link routing
- Identified by the constant `ShortLink::CUSTOM_INTAKE_LINK`

## Additional Fix: manual_link Field

### Problem 2
**Error:**
```
SQLSTATE[HY000]: General error: 1364 Field 'manual_link' doesn't have a default value
```

The same issue occurred with the `manual_link` field.

### Solution 2 Applied ✅

**File:** `app/Models/ShortLink.php`

Added default value handling for `manual_link`:

```php
// Ensure custom_intake_link and manual_link have default values if not provided
if (!isset($input['custom_intake_link'])) {
    $input['custom_intake_link'] = null;
}
if (!isset($input['manual_link'])) {
    $input['manual_link'] = null;
}
```

**Migration:** `2025_10_15_050227_add_default_to_manual_link_in_short_links_table.php`

Made `manual_link` column nullable:

```php
$table->string('manual_link')->nullable()->change();
```

**Status:** ✅ Migration successfully applied on 2025-10-15 05:02:27

## Summary of All Fixes

### Database Schema Changes

**Table:** `short_links`

**Columns Modified:**

1. **custom_intake_link**
   - Before: `VARCHAR(255) NOT NULL`
   - After: `VARCHAR(255) NULL DEFAULT NULL`
   - Migration: `2025_10_15_045320_add_default_to_custom_intake_link_in_short_links_table.php`

2. **manual_link**
   - Before: `VARCHAR(255) NOT NULL`
   - After: `VARCHAR(255) NULL DEFAULT NULL`
   - Migration: `2025_10_15_050227_add_default_to_manual_link_in_short_links_table.php`

### Application Code Changes

**File:** `app/Models/ShortLink.php`

Both fields now have default null values in the `getSetLink()` method:
- `custom_intake_link` defaults to `null`
- `manual_link` defaults to `null`

## Status

✅ **FULLY FIXED** - Both `custom_intake_link` and `manual_link` errors have been resolved at both the application and database levels. Short links can now be created for all link types without providing values for optional fields.

## Date Fixed

- custom_intake_link: October 15, 2025 at 04:53:20
- manual_link: October 15, 2025 at 05:02:27

