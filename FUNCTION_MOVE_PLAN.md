# Function Move Plan - Step4 Specific Functions

## Current Issue
The `tab2/common.js` file got corrupted during edits. Need to clean it up.

## Functions to KEEP in tab2/common.js (Shared across steps):
1. ✅ `bank_addmore` - Used in step4 AND step8
2. ✅ `common_financial_addmore` - Used in step4 AND step8
3. ✅ `common_financial_addmore_with_limit` - Used in step4 AND step8  
4. ✅ `tax_refund_addmore` - Used in step4 AND step8
5. ✅ `showHideTransactionSection` - Bank transaction toggle
6. ✅ `addMoreBankTransaction` - Bank transactions
7. ✅ `removeButton` - Generic remove
8. ✅ `removeVenmoButton` - Remove venmo
9. ✅ `checkBankAccInputs` - Bank validation
10. ✅ `handleBankButtonClick` - Bank button handler

## Functions to MOVE to tab2/step4.js (Only in step4):
1. ❌ `venmo_paypal_cash_addmore` - Only in financial_assets_1 (step4)
2. ❌ `showHideGuideVidDiv` - Only used by venmo_paypal_cash_addmore
3. ❌ `brokerage_account_addmore` - Only in financial_assets_2 (step4)
4. ❌ `child_addmore` - Only in financial_assets_continued_1 (step4 continued)

## Current Status

### tab2/step4.js ✅
- ✅ Already has: bank_addmore
- ✅ Just added: venmo_paypal_cash_addmore
- ✅ Just added: showHideGuideVidDiv  
- ✅ Just added: brokerage_account_addmore
- ✅ Just added: child_addmore
- ✅ Exports added

### tab2/common.js ❌ CORRUPTED
- ❌ Has corrupted common_financial_addmore (mixed with venmo code)
- ❌ Still has venmo_paypal_cash_addmore, showHideGuideVidDiv, brokerage_account_addmore, child_addmore (need to remove)
- ❌ Has duplicate common_financial_addmore

## Solution
Need to manually clean tab2/common.js by:
1. Removing lines with venmo_paypal_cash_addmore, showHideGuideVidDiv, brokerage_account_addmore, child_addmore
2. Fixing the corrupted common_financial_addmore  
3. Removing their exports
4. Updating version to v=1.07

## User Action Required
Due to file corruption, I recommend:
1. I'll provide the corrected code sections
2. You review and apply them manually
3. This ensures no further corruption

Would you like me to:
A) Continue trying automated fixes (risky due to corruption)
B) Provide clean code sections for manual review and application  
C) Revert common.js and start fresh from last working state

