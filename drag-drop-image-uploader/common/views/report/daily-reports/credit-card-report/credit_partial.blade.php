 
    <th colspan="2">Card Type</th>
    <th colspan="3">CC AMEX 
       {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::amex)}}
    </th>
    <th colspan="3">CC VISA 
     {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::visa)}}
    </th>
    <th colspan="3">CC MSTER 
      {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::master_card)}}
    </th>
    <th colspan="3">CC DINERS  {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::diner)}}

    </th>
    <th colspan="3">PAYMENT GETWAY 
        {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::payment_getway)}}
     </th>
    <th colspan="3">DR KNET {{\App\Models\CreditDebitCommission::getcardamount(Session::get('credit_card_commission_report_branch_id'),\App\Models\CreditDebitCommission::k_net)}}</th>
    <th colspan="3">MONTH TOTAL</th>
