<form name="payment_frm" id="payment_frm" action="{{route('attorney_payment')}}" method="post">
    @csrf
    <div class="light-gray-div mt-3">
        <h2>Update Credit / Debit Card Details</h2>
        <div class="row gx-3">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <label class="font-weight-bold">{{ __('Card Holder Name') }} </label>
                        <input required type="text" class="form-control " name="card_holder_name" value="{{old('card_name',(!empty($attorneycards->card_name))?$attorneycards->card_name:'')}}" placeholder="{{ __('Card Holder') }} ">
                    </div>
                    @if ($errors->has('card_holder_name'))
                    <p class="help-block text-danger">{{ $errors->first('card_holder_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        @php
                            if (!empty($attorneycards->last4)) {
                                $attorneycards->last4 = 'xxxxxxxxxxxx' . $attorneycards->last4;
                            }
                        @endphp
                        <label class="font-weight-bold">{{ __('Card Number') }} </label>
                        <input required type="text" class="form-control " name="card_number" value="{{old('card_number',(!empty($attorneycards->last4))?$attorneycards->last4:'')}}" placeholder="{{ __('4242 4242 4242 4242') }}" maxlength="16">
                    </div>
                    @if ($errors->has('card_number'))
                    <p class="help-block text-danger">{{ $errors->first('card_number') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Month Card Expires') }}</label>
                        @php $months = ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December']; @endphp
                        <select required id='expireMM' class="form-control" name="exp_month">
                            <option value=''>{{ __('Month') }}</option>
                            @foreach ($months as $key => $val)
                                <option value='{{$key}}' {{ (!empty($attorneycards->exp_month) && $key == $attorneycards->exp_month) ? "selected='selected'" : "" }}>{{$val}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('exp_month'))
                    <p class="help-block text-danger">{{ $errors->first('exp_month') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ __('Year Card Expires') }}</label>
                        <select required name='exp_year' id='expireYY' class="form-control">
                            <option value=''>{{ __('Year') }}</option>
                            @php $year = date('Y', strtotime('-4 years')); @endphp
                            @for ($i = 0; $i < 26; $i++)
                                <option value='{{$year}}' {{ (!empty($attorneycards->exp_year) && $year == $attorneycards->exp_year) ? "selected='selected'" : "" }}>{{$year}}</option>
                                @php $year = $year + 1; @endphp
                            @endfor
                        </select>
                    </div>
                    @if ($errors->has('exp_year'))
                    <p class="help-block text-danger">{{ $errors->first('exp_year') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label class="font-weight-bold">Card CVC Code</label>
                        <input required type="text" class="form-control" value="{{old('cvc',(!empty($attorneycards->cvc))?$attorneycards->cvc:'')}}" name='cvc' placeholder="cvc" maxlength="5">
                    </div>
                    @if ($errors->has('cvc'))
                    <p class="help-block text-danger">{{ $errors->first('cvc') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save New Credit Card Info</span></button>
    </div>
</form>