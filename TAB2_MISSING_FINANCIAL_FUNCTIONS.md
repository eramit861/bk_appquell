# Tab 2 - Missing Financial Functions Analysis

## Date: October 17, 2025

## Overview
Analysis of missing financial asset functions that need to be moved from `questionarrie.js` to `tab2/common.js`.

---

## Functions Currently Missing

### Used in MULTIPLE Property Steps (step4 + step8)
All these financial functions are used across multiple property steps, so they belong in `tab2/common.js`.

| Function Name | Lines in questionarrie.js | Size | Used In |
|--------------|---------------------------|------|---------|
| `bank_addmore` | 9851-10016 | ~165 lines | step4, step8 |
| `venmo_paypal_cash_addmore` | 10018-10128 | ~110 lines | step4, step8 |
| `showHideGuideVidDiv` | 10130-10149 | ~19 lines | step4, step8 |
| `brokerage_account_addmore` | 10151-10237 | ~86 lines | step4, step8 |
| `child_addmore` | 10239-10375 | ~136 lines | step4, step8 |
| `common_financial_addmore` | 11061-11216 | ~155 lines | step4, step8 |
| `common_financial_addmore_with_limit` | 11218-11473 | ~255 lines | step4, step8 |
| `tax_refund_addmore` | 11535-11659 | ~124 lines | step4, step8 |
| `showHideTransactionSection` | 15235-15246 | ~11 lines | step4, step8 |
| `addMoreBankTransaction` | 15347-15385 | ~38 lines | step4, step8 |
| `removeButton` | 13793-13808 | ~15 lines | step4, step8 |
| `removeVenmoButton` | 13810-13822 | ~12 lines | step4, step8 |

**Total Lines:** ~1,126 lines of code

---

## Functions Already in Common Utilities

These are already available globally:

| Function | Location | Status |
|----------|----------|--------|
| `seperate_save` | common-utilities.js:590 | ✅ Available |
| `seperate_remove_div_common` | common-utilities.js:478 | ✅ Available |
| `edit_div_common` | common-utilities.js:581 | ✅ Available |
| `remove_div_common` | common-utilities.js:452 | ✅ Available |
| `checkBankAccInputs` | common-utilities.js | ✅ Available |
| `checkUnknown` | common-utilities.js:317 | ✅ Available |
| `showConfirmation` | common-utilities.js:286 | ✅ Available |

---

## Where These Functions Are Called

### Bank Functions
- `bank_addmore()` - Called in:
  - `resources/views/client/questionnaire/property/financial/common/parent_bank.blade.php:14`
  
- `showHideTransactionSection()` - Called in:
  - `resources/views/client/questionnaire/property/financial/bank.blade.php:213`
  - `resources/views/client/questionnaire/property/financial/bank.blade.php:216`
  
- `addMoreBankTransaction()` - Called in:
  - `resources/views/client/questionnaire/property/financial/bank.blade.php:237`

- `removeButton()` - Called in:
  - Multiple financial asset files when removing bank entries

### Venmo/PayPal/Cash Functions
- `venmo_paypal_cash_addmore()` - Called in:
  - `resources/views/client/questionnaire/property/financial/common/parent_venmo_paypal_cash.blade.php:11`
  
- `showHideGuideVidDiv()` - Called in:
  - `venmo_paypal_cash_addmore` (line 10124)
  - Event handlers in venmo/paypal/cash blade files

- `removeVenmoButton()` - Called in:
  - Financial asset files when removing venmo/paypal entries

### Brokerage Functions
- `brokerage_account_addmore()` - Called in:
  - `resources/views/client/questionnaire/property/financial/common/parent_brokerage_account.blade.php:11`

### Alimony/Child Support Functions
- `child_addmore()` - Called in:
  - `resources/views/client/questionnaire/property/financial/common/parent_alimony_child_support.blade.php:11`

### Tax Refund Functions
- `tax_refund_addmore()` - Called in:
  - `resources/views/client/questionnaire/property/financial/common/parent_tax_refund.blade.php:14`

### Common Financial Functions
- `common_financial_addmore()` - Called in:
  - `parent_mutual_funds.blade.php`
  - `parent_government_corporate_bonds.blade.php`
  - `parent_inheritances.blade.php`
  - `parent_other_claims.blade.php`
  - `parent_other_financial.blade.php`
  - `parent_patents_copyrights.blade.php`
  - `parent_trusts_life_estates.blade.php`

- `common_financial_addmore_with_limit()` - Called in:
  - `parent_education_ira.blade.php`
  - `parent_annuities.blade.php`
  - `parent_retirement_pension.blade.php`
  - `parent_life_insurance.blade.php`
  - `parent_insurance_policies.blade.php`
  - `parent_injury_claims.blade.php`
  - `parent_unpaid_wages.blade.php`

---

## Dependencies

All these functions depend on:
- jQuery
- `seperate_save()` - already in common-utilities.js
- `seperate_remove_div_common()` - already in common-utilities.js
- `checkUnknown()` - already in common-utilities.js  
- `checkBankAccInputs()` - already in common-utilities.js
- `$.systemMessage()` - global utility

---

## Recommended Action

### Add to `tab2/common.js`
Since these functions are:
1. Used in multiple property steps (step4 and step8)
2. Specific to Tab 2 (Property)
3. Share common patterns for "Add More" functionality

They should be added to `public/assets/js/client/questionnaire/tab2/common.js`

### Export Format
```javascript
// Add to end of tab2/common.js
window.bank_addmore = bank_addmore;
window.venmo_paypal_cash_addmore = venmo_paypal_cash_addmore;
window.showHideGuideVidDiv = showHideGuideVidDiv;
window.brokerage_account_addmore = brokerage_account_addmore;
window.child_addmore = child_addmore;
window.common_financial_addmore = common_financial_addmore;
window.common_financial_addmore_with_limit = common_financial_addmore_with_limit;
window.tax_refund_addmore = tax_refund_addmore;
window.showHideTransactionSection = showHideTransactionSection;
window.addMoreBankTransaction = addMoreBankTransaction;
window.removeButton = removeButton;
window.removeVenmoButton = removeVenmoButton;
```

### Version Update
Update `tab2.blade.php` to increment version:
```php
<script src="{{ asset('assets/js/client/questionnaire/tab2/common.js') }}?v=1.05"></script>
```

---

## Impact Analysis

### Files That Will Be Updated
1. ✅ `public/assets/js/client/questionnaire/tab2/common.js` - Add ~1,126 lines
2. ✅ `resources/views/client/questionnaire/tab2.blade.php` - Update version

### Files That Use These Functions (No Changes Needed)
All blade files already call these functions - they just need to be available:
- All files in `property/financial/common/parent_*.blade.php` (15 files)
- All files in `property/financial/*.blade.php` (20+ files)
- `property/steps/step4.blade.php`
- `property/steps/step8.blade.php`

---

## Size Comparison

Current `tab2/common.js`: ~1,140 lines
After adding functions: ~2,266 lines

This is reasonable for a shared utilities file.

---

## Next Steps

1. ✅ **Extract functions** from `questionarrie.js` (lines 9851-15385)
2. ✅ **Add to** `tab2/common.js` at the end, before final exports
3. ✅ **Add exports** for all 12 functions
4. ✅ **Update version** in `tab2.blade.php` to force cache clear
5. ✅ **Test** all "Add More" buttons in Financial Assets sections

---

## Testing Checklist

After implementation, test these scenarios:

### Bank Accounts (step4)
- [ ] Click "Add Account" button
- [ ] Toggle "Upload Statement" yes/no
- [ ] Add transaction rows
- [ ] Remove bank account
- [ ] Save bank account

### Venmo/PayPal/Cash (step4)
- [ ] Add Venmo account
- [ ] Add PayPal account
- [ ] Add Cash App account
- [ ] Guide video toggles correctly
- [ ] Remove accounts

### Brokerage Accounts (step4)
- [ ] Add brokerage account
- [ ] Remove brokerage account
- [ ] Save brokerage account

### Alimony/Child Support (step4)
- [ ] Add alimony entry
- [ ] Select different account types
- [ ] Toggle "unknown" checkbox
- [ ] Remove entry

### Tax Refunds (step4)
- [ ] Add tax refund
- [ ] Select year
- [ ] Select type (Federal/State/Local)
- [ ] Remove entry

### Other Financial Assets (step4)
- [ ] Mutual Funds - Add More
- [ ] Education IRA - Add More
- [ ] Retirement/Pension - Add More
- [ ] Life Insurance - Add More
- [ ] Insurance Policies - Add More
- [ ] Personal Injury Claims - Add More
- [ ] Unpaid Wages - Add More
- [ ] Inheritances - Add More
- [ ] Other Claims - Add More
- [ ] Patents/Copyrights - Add More
- [ ] Trusts/Life Estates - Add More
- [ ] Government/Corporate Bonds - Add More

### Step 8 (if applicable)
- [ ] Test all "Add More" functionality
- [ ] Ensure all financial sections work

---

## Notes

- These functions follow a consistent pattern:
  1. Check limit
  2. Call `seperate_save()` first
  3. Clone last element
  4. Update indices
  5. Reset values
  6. Update event handlers
  7. Append to DOM
  
- All functions are `async` because they call `seperate_save()` first
- All functions use `setTimeout()` for DOM manipulation timing
- All functions enforce entry limits (3, 7, 9, 10, or 18 depending on type)

---

## Conclusion

Moving these 1,126 lines of financial "Add More" functions to `tab2/common.js` will:

✅ Make them available across all property steps
✅ Follow the project structure (shared functions in common files)
✅ Maintain all existing functionality
✅ Keep code organized and maintainable
✅ Require no changes to blade files (they already call these functions)

**Status:** Ready to implement
**Estimated Time:** ~30 minutes for extraction and testing
**Risk:** Low (functions are self-contained, blade files unchanged)

