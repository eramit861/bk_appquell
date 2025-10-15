<input type="hidden" name="form_id" value="{{$formId}}">
<input type="hidden" name="client_id" value="{{$clientId}}">
<input type="hidden" name="sourcePDFName" value="{{$sourcePDFName}}">
<input type="hidden" name="clientPDFName" value="{{$clientPDFName}}">
<input type="hidden" name="{{ base64_encode('Case number') }}" value="{{ $caseNumber }}">
<input type="hidden" name="{{ base64_encode('Debtor 1') }}" value="{{ $debtor1 }}">
<input type="hidden" name="{{ base64_encode('Debtor 2') }}" value="{{ $debtor2 }}">
