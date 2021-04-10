<div class="modal fade" id="chooseDeposit" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">{{__('Choose Deposit')}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <h3 class="sec-title">{{ __('Investment Plan') }}</h3>
            @php $currency = get_option('currency') @endphp
            <form action="{{ route('profile.post_make_deposit') }}" method="POST" data-choose="#" data-currency="{{ $currency }}">
               @csrf
               <table>
                  <tr>
                     <td class="bg-grey2"><label>{!! __('Input Amount') !!}</label></td>
                     <td><input type="text" name="deposit_amount" class="form-cs currency-format" placeholder="{{ __('Input your deposit amount!') }}" min="{{ isset($plans[0]) ? $plans[0]->min_deposit : '0' }}"></td>
                  </tr>
                  <tr>
                     <td class="bg-grey2"><label>{!! __('Daily profit') !!}</label></td>
                     <td><input type="text" id="daily_profit" class="form-cs currency-format" disabled readonly></td>
                  </tr>
                  <tr>
                     <td class="bg-grey2"><label>{!! __('Weekly profit') !!}</label></td>
                     <td><input type="text" id="weekly_profit" class="form-cs currency-format" disabled readonly></td>
                  </tr>
                  <tr>
                     <td class="bg-grey2"><label>{!! __('Monthly profit') !!}</label></td>
                     <td><input type="text" id="monthly_profit" class="form-cs currency-format" disabled readonly></td>
                  </tr>
               </table>
               <div class="row justify-content-center">
                  <button class="btn-cs" data-dismiss="modal" aria-label="Close">{{ __('Cancel') }}</button>
                  <button type="submit" class="btn-cs">{{ __('Deposit') }}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>