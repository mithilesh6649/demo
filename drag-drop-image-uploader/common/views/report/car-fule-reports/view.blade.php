@extends('adminlte::page')
@section('title', 'Super Admin |  Gift Card Report Details')
@section('content_header')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-main">
               <div class="card-header alert d-flex justify-content-between align-items-center mx-0 pt-0">
                  <h3>Gift Cards Details</h3>
                  <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
               </div>
               <div class="card-body p-0">
                  
                  <form >
                                                    @csrf


                                                    <div class="card-body main_body form p-3">
                                                        <div class="row">



                                                          <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="guest_name">Date</label>
                                                                   <input type="text" name="report_date"
                                                                        id="report_date" readonly value="{{date('d/m/Y',strtotime($gift->date))}}" class="form-control"
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>

                                                             <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="guest_name">Branch</label>
                                                                    <input type="text" readonly name="guest_name" value="{{$gift->branch->title_en ?? ''}}" id="guest_name"
                                                                        class="form-control" placeholder="Guest Name">
                                                                </div>
                                                            </div> 





                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="guest_name">Guest Name</label>
                                                                    <input type="text" readonly name="guest_name" value="{{$gift->guest_name ?? ''}}" id="guest_name"
                                                                        class="form-control" placeholder="Guest Name">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="mobile_number">Mobile Number</label>
                                                                    <input type="number"  readonly name="mobile_number"
                                                                        id="mobile_number" class="form-control"
                                                                        placeholder="Mobile Number" value="{{$gift->mobile_number ?? ''}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="doc_ref_no">Document Reference Number</label>
                                                                    <input type="text" readonly name="doc_ref_no" id="doc_ref_no"
                                                                        class="form-control"
                                                                        placeholder="Document Reference Number"
                                                                        value="{{$gift->doc_ref_no ?? ''}}" readonly>
                                                                </div>
                                                            </div>
 
                                                            

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="pos_invoice_no">Pos Invoice Number </label>
                                                                    <input type="text" readonly name="pos_invoice_no"
                                                                        id="pos_invoice_no" class="form-control"
                                                                        placeholder="Pos Invoice Number"  value="{{$gift->pos_invoice_number ?? ''}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="pos_invoice_amount">Pos Invoice Amount </label>
                                                                    <input type="number" readonly name="pos_invoice_amount"
                                                                        id="pos_invoice_amount" class="form-control"
                                                                        placeholder="Pos Invoice Amount"  value="{{number_format($gift->pos_invoice_amount, 3, '.', '')}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-lg-6 col-xl-6 col-12 mb-3">
                                                                <div class="form-group mb-0">
                                                                    <label for="card_amount">Card Amount</label>
                                                                    <input type="number" readonly name="card_amount"
                                                                        id="card_amount" class="form-control"
                                                                        placeholder="Card Amount"  value="{{number_format($gift->card_amount, 3, '.', '')}}" readonly>
                                                                </div>
                                                            </div>


                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group  ">
                    <label>Gift Cards</label>
                   
                   <?php
        $card_number = json_decode($gift->card_number);
        ?>
        <td>
        

         <ul class="stocks">
        @forelse ($card_number as $number) 
          <li class="mb-2">  
             <li class="p-2 border text-center mb-2" style="width:400px;color: black;">{{ $number}}</li>
          </li> 
        @empty
           <li>  
            <span>N/A</span>    
          </li> 
        @endforelse


        
        </ul>



        </td> 
 
                    
                    
                  
                </div>
              </div>




                                                        </div>

                                                        
                                                       
                                                    </div>
                                                </form>    
 
              </div>
      </div> 
   </div>
</div>
</div>
</div>


@endsection
@section('css')
  
@stop
@section('js')

 


@stop
