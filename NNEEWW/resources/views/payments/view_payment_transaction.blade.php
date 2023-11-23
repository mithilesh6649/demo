@extends('adminlte::page')

@section('title', 'Crypto Wallet Information')

@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header alert d-flex justify-content-between align-items-center">
                        <h3>Transactions Details</h3>
                        <a class="btn btn-sm btn-success"
                            href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="tab_wrapper" id="tab_box_wrapper">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link-header active" id="pills-transaction-tab" data-toggle="pill"
                                        href="#pills-transaction-status" role="tab" aria-controls="pills-transaction"
                                        aria-selected="true" data-id="home">
                                        <i class="fas fa-exchange-alt mr-2"></i> Transactions Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-account-tab" data-toggle="pill"
                                        href="#pills-account-status" role="tab" aria-controls="pills-account-status"
                                        aria-selected="false" data-id="account"><i class="fa fa-user mr-2"></i> Account
                                        Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-pull-tab" data-toggle="pill"
                                        href="#pills-pull-status" role="tab" aria-controls="pills-pull-status"
                                        aria-selected="false" data-id="pull"><i class="fas fa-money-bill-alt mr-2"></i> Pull
                                        Funds</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-debit-tab" data-toggle="pill"
                                        href="#pills-debit-status" role="tab" aria-controls="pills-debit-status"
                                        aria-selected="false" data-id="debit"><i class="fas fa-credit-card mr-2"></i>
                                        Pull Funds By Debit Card</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-deposit-tab" data-toggle="pill"
                                        href="#pills-deposit-status" role="tab" aria-controls="pills-deposit-status"
                                        aria-selected="false" data-id="deposit"><i class="fas fa-money-check mr-2"></i>
                                        Deposit
                                        Check</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-intrabank-tab" data-toggle="pill"
                                        href="#pills-intrabank-status" role="tab" aria-controls="pills-intrabank-status"
                                        aria-selected="false" data-id="send"><i class="fa fa-university mr-2"></i> IntraBank
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-anotherbank-tab" data-toggle="pill"
                                        href="#pills-anotherbank-status" role="tab"
                                        aria-controls="pills-anotherbank-status" aria-selected="false"
                                        data-id="anotherbank"><i class="fa fa-university mr-2"></i>
                                        To Another Bank</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-todebit-tab" data-toggle="pill"
                                        href="#pills-todebit-status" role="tab" aria-controls="pills-todebit-status"
                                        aria-selected="false" data-id="todebit"><i class="fas fa-credit-card mr-2"></i>
                                        To Debit Card</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-domesticwire-tab" data-toggle="pill"
                                        href="#pills-domesticwire-status" role="tab"
                                        aria-controls="pills-domesticwire-status" aria-selected="false"
                                        data-id="domesticwire"><i class="fas fa-network-wired mr-2"></i>
                                        Domestic Wire</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-header" id="pills-internationalwire-tab" data-toggle="pill"
                                        href="#pills-internationalwire-status" role="tab"
                                        aria-controls="pills-internationalwire-status" aria-selected="false"
                                        data-id="internationalwire"><i class="fas fa-network-wired mr-2"></i>
                                        International Wire</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                {{-- Content Here --}}

                                <div class="tab-pane fade show active" id="pills-transaction-status" role="tabpanel"
                                    aria-labelledby="pills-transaction-tab">

                                    <form class="form_wrap customers-management-view">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Sender Name</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst(@$payment->sender_account->person->firstName) }} {{ ucfirst(@$payment->sender_account->person->lastName) }}"
                                                        readonly>
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Receiver Name</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst(@$payment->name) }}" readonly>
                                                </div>
                                            </div>


                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Transaction Id</label>
                                                    <input class="form-control" placeholder="{{ $payment->transfer_id }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            @if (@$payment->accountId && @$payment->accountId != null && @$payment->accountId != '')
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Sender Account Number</label>
                                                        <input class="form-control"
                                                            placeholder="{{ @\Crypt::decryptString($payment->sender_account->accountNumber) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (isset($payment->receiver_account->accountNumber))
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Receiver Account Number</label>
                                                        <input class="form-control"
                                                            placeholder="{{ @\Crypt::decryptString($payment->receiver_account->accountNumber) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            @elseif (@$payment->accountNumber == null || $payment->accountNumber == '')
                                                @if (@$payment->accountNumber == @$payment->contact->account->accountNumber)
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Receiver Account Number</label>
                                                            <input class="form-control"
                                                                placeholder="{{ @\Crypt::decryptString($payment->accountNumber) }}" readonly>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Sender Routing Number</label>
                                                    <input class="form-control"
                                                        placeholder="{{ @\Crypt::decryptString($payment->sender_account->routingNumber) }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            @if (isset($payment->receiver_account->accountNumber))
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Receiver Routing Number</label>
                                                        <input class="form-control"
                                                            placeholder="{{ @\Crypt::decryptString($payment->receiver_account->routingNumber) }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            @elseif (@$payment->routingNumber == null || $payment->routingNumber == '')
                                                @if (@$payment->routingNumber == @$payment->contact->account->routingNumber)
                                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                        <div class="form-group">
                                                            <label>Receiver Routing Number</label>
                                                            <input class="form-control"
                                                                placeholder="{{ @\Crypt::decryptString($payment->routingNumber) }}" readonly>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Payment Method</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($payment->transferType) }}" readonly>
                                                </div>
                                            </div>

                                            @if ($payment->bankName != null)
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="form-group">
                                                        <label>Bank Name</label>
                                                        <input class="form-control"
                                                            placeholder="{{ ucfirst($payment->bankName) }}" readonly>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Transfer Sub Type</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($payment->transferSubType) }}" readonly>
                                                </div>
                                            </div>

                                            @if ($payment->description != null || $payment->description != '')
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <div
                                                            style="background-color: #efefef; padding: 15px; border-radius: 5px;">
                                                            {!! $payment->description !!}<div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Transaction Type</label>
                                                    @if ($payment->txnType == 'debit')
                                                        <input class="form-control text-warning"
                                                            placeholder="{{ ucfirst($payment->txnType) }}" readonly>
                                                    @else
                                                        <input class="form-control text-success"
                                                            placeholder="{{ ucfirst($payment->txnType) }}" readonly>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input class="form-control" placeholder="${{ $payment->amount }}"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Transaction Status</label>
                                                    <input class="form-control"
                                                        placeholder="{{ ucfirst($payment->status) }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                                                <div class="form-group">
                                                    <label>Created At</label>
                                                    <input class="form-control"
                                                        placeholder="{{ date('m/d/Y', strtotime($payment->created_at)) }}"
                                                        readonly>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                    {{-- ------------ --}}

                                </div>

                                <div class="tab-pane fade" id="pills-account-status" role="tabpanel"
                                    aria-labelledby="pills-account-tab">
                                    <table style="width:100%" id="account-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Account Name</th>
                                                <th>Account Number</th>
                                                <th>Account Balance</th>
                                                <th>Account Type</th>
                                                <th>Transaction Type</th>
                                                <th>Created At</th>
                                                @can('view_user')
                                                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($accounts != '' && $accounts != null)
                                                <?php for ($i=0; $i < count($accounts); $i++) { ?>
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($accounts[$i]->label) }}</td>
                                                    <td>{{ \Crypt::decryptString($accounts[$i]->accountNumber) }}</td>
                                                    <td>${{ $accounts[$i]->availableBalance }}</td>
                                                    <td>{{ ucfirst($accounts[$i]->type) }}</td>
                                                    @if ((@$payment->transferType == 'ach' && @$payment->txnType == 'credit') ||
                                                        ($payment->transferType == 'physicalCheck' && $payment->txnType == 'credit') ||
                                                        @$payment->transferType == 'debitCard')
                                                        <td style="color:green;">Credit</td>
                                                    @elseif((@$payment->transferType == 'ach' && @$payment->txnType == 'debit') ||
                                                        ($payment->transferType == 'physicalCheck' && $payment->txnType == 'debit'))
                                                        <td style="color:orange;">Debit</td>
                                                    @elseif (@$payment->sender_account->account_id == $accounts[$i]->account_id)
                                                        <td style="color:orange;">Debit</td>
                                                    @elseif(@$payment->receiver_account->accountNumber == $accounts[$i]->accountNumber)
                                                        <td style="color:green;">Credit</td>
                                                    @endif
                                                    <td>{{ $accounts[$i]->createdAt ? date('m/d/Y', strtotime($accounts[$i]->createdAt)) : 'Not Verified' }}
                                                    </td>
                                                    <td>
                                                        @can('view_user')
                                                            <a class="action-button account_details"
                                                                id="{{ $accounts[$i]->id }}" title="View"
                                                                href="javascript:0;" data-toggle="modal"
                                                                data-target="#account-details"><i
                                                                    class="text-info fa fa-eye"></i></a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-pull-status" role="tabpanel"
                                    aria-labelledby="pills-pull-tab">
                                    <table style="width:100%" id="pull-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                {{-- <th>Descritpion</th> --}}
                                                <th>Account Number</th>
                                                <th>Routing Number</th>
                                                <th>Account Type</th>
                                                <th>Bank Name</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'ach' && $payment->txnType == 'credit')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->name) }}</td>
                                                    {{-- <td>{{ $payment->description }}</td> --}}
                                                    @if (@$payment->transferBy == @$payment->transferTo)
                                                        <td>{{ \Crypt::decryptString($payment->sender_account->accountNumber) }}</td>
                                                        <td>{{ \Crypt::decryptString($payment->sender_account->routingNumber) }}</td>
                                                        <td>{{ ucfirst($payment->sender_account->type) }}</td>
                                                        <td>{{ ucfirst($payment->sender_account->label) }}</td>
                                                    @elseif ($payment->accountNumber == null || $payment->accountNumber == '')
                                                        <td>{{ \Crypt::decryptString($payment->contact->account->accountNumber) }}</td>
                                                        <td>{{ \Crypt::decryptString($payment->contact->account->routingNumber) }}</td>
                                                        <td>{{ ucfirst($payment->contact->account->type) }}</td>
                                                        <td>{{ ucfirst($payment->contact->account->label) }}</td>
                                                    @else
                                                        <td>{{ \Crypt::decryptString($payment->accountNumber) }}</td>
                                                        <td>{{ \Crypt::decryptString($payment->routingNumber) }}</td> 
                                                        <td>{{ ucfirst($payment->receiver_account->type) }}</td>
                                                        <td>{{ ucfirst($payment->receiver_account->label) }}</td>
                                                    @endif
                                                    <td>${{ $payment->amount }}</td>
                                                    <td class="text-success">Credit</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-debit-status" role="tabpanel"
                                    aria-labelledby="pills-debit-tab">
                                    <table style="width:100%" id="debit-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                {{-- <th>Descritpion</th> --}}
                                                <th>Account Number</th>
                                                <th>Account Type</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'debitCard' && $payment->txnType == 'credit')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->name) }}</td>
                                                    @if ($payment->accountNumber == null || $payment->accountNumber == '')
                                                        <td>{{ \Crypt::decryptString($payment->contact->account->accountNumber) }}</td>
                                                        <td>{{ ucfirst($payment->contact->account->type) }}</td>
                                                    @else
                                                        <td>{{ \Crypt::decryptString($payment->accountNumber) }}</td>
                                                        <td>{{ ucfirst($payment->contact->account->type) }}</td>
                                                    @endif
                                                    <td>${{ $payment->amount }}</td>
                                                    <td class="text-success">Credit</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }} 
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-intrabank-status" role="tabpanel"
                                    aria-labelledby="pills-intrabank-tab">
                                    <table style="width:100%" id="intrabank-list"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Source</th>
                                                <th>Destination</th>
                                                <th>Account Number</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'intrabank')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->sender_account->label) }}</td>
                                                    @if (@$payment->receiver_account->label)
                                                        <td>{{ ucfirst($payment->receiver_account->label) }}</td>
                                                    @else
                                                        <td>{{ ucfirst($payment->contact->account->label) }}</td>
                                                    @endif
                                                    @if (isset($payment->receiver_account->accountNumber))
                                                        <td>{{ \Crypt::decryptString($payment->receiver_account->accountNumber) }}
                                                        </td>
                                                    @elseif($payment->accountNumber != null)
                                                        <td>{{ \Crypt::decryptString($payment->accountNumber) }}
                                                        </td>
                                                    @else
                                                        <td>{{ \Crypt::decryptString($payment->contact->account->accountNumber) }}
                                                        </td>
                                                    @endif
                                                    <td>${{ $payment->amount }}</td>
                                                    <td class="text-success">Credit</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-anotherbank-status" role="tabpanel"
                                    aria-labelledby="pills-anotherbank-tab">
                                    <table style="width:100%" id="anotherbank-list"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                <th>Account Number</th>
                                                <th>Routing Number</th>
                                                <th>Account Type</th>
                                                <th>Bank Name</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'ach' && $payment->txnType == 'debit')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->sender_account->person->firstName) }}
                                                        {{ ucfirst($payment->sender_account->person->lastName) }} </td>
                                                    <td>{{ ucfirst( \Crypt::decryptString($payment->sender_account->accountNumber)) }}</td>
                                                    <td>{{ ucfirst( \Crypt::decryptString($payment->sender_account->routingNumber)) }}
                                                    </td>
                                                    <td>{{ ucfirst($payment->sender_account->type) }}
                                                    </td>
                                                    <td>{{ ucfirst($payment->sender_account->label) }}
                                                    </td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td class="text-warning">Debit</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-deposit-status" role="tabpanel"
                                    aria-labelledby="pills-deposit-tab">
                                    <table style="width:100%" id="deposit-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Postal Code</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'physicalCheck')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>
                                                        @if ($payment->sender_account->person->firstName == null && $payment->sender_account->person->lastName == null)
                                                            --
                                                        @else
                                                            {{ ucfirst($payment->sender_account->person->firstName) }}
                                                            {{ ucfirst($payment->sender_account->person->lastName) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($address->line1 == null && $address->line2 == null)
                                                            --
                                                        @else
                                                            {{ ucfirst($address->line1) }}
                                                            {{ ucfirst($address->line2) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($address->city == null)
                                                            --
                                                        @else
                                                            {{ ucfirst($address->city) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($address->state == null)
                                                            --
                                                        @else
                                                            {{ ucfirst($address->state) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($address->postalCode == null)
                                                            --
                                                        @else
                                                            {{ ucfirst($address->postalCode) }}
                                                        @endif
                                                    </td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-todebit-status" role="tabpanel"
                                    aria-labelledby="pills-todebit-tab">
                                    <table style="width:100%" id="todebit-list" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                <th>Account Number</th>
                                                <th>Account Type</th>
                                                <th>Amount</th>
                                                <th>Transaction Type</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'debitCard' && $payment->txnType == 'debit')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->sender_account->person->firstName) }}
                                                        {{ ucfirst($payment->sender_account->person->lastName) }}</td>
                                                    <td>{{ \Crypt::decryptString($payment->sender_account->accountNumber)}}</td>
                                                    <td>{{ ucfirst($payment->sender_account->type) }}</td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td class="text-warning">Debit</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-domesticwire-status" role="tabpanel"
                                    aria-labelledby="pills-domesticwire-tab">
                                    <table style="width:100%" id="domesticwire-list"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Postal Code</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'domesticWire')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->name) }}</td>
                                                    <td>{{ ucfirst($address->line1) }}
                                                        {{ ucfirst($address->line2) }}</td>
                                                    <td>{{ ucfirst($address->city) }}</td>
                                                    <td>{{ ucfirst($address->state) }}</td>
                                                    <td>{{ ucfirst($address->postalCode) }}</td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="pills-internationalwire-status" role="tabpanel"
                                    aria-labelledby="pills-internationalwire-tab">
                                    <table style="width:100%" id="internationalwire-list"
                                        class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="display-none"></th>
                                                <th>Beneficiary Name</th>
                                                <th>Beneficiary Address</th>
                                                <th>Beneficiary Country</th>
                                                <th>Beneficiary City</th>
                                                <th>Beneficiary State</th>
                                                <th>Beneficiary Postal Code</th>
                                                <th>Beneficiary Bank Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($payment->transferType == 'internationalWire')
                                                <tr>
                                                    <th class="display-none"></th>
                                                    <td>{{ ucfirst($payment->name) }}</td>
                                                    <td>{{ ucfirst($address->line1) }}
                                                        {{ ucfirst($address->line2) }}</td>
                                                    <td>{{ ucfirst($address->country) }}</td>
                                                    <td>{{ ucfirst($address->city) }}</td>
                                                    <td>{{ ucfirst($address->state) }}</td>
                                                    <td>{{ ucfirst($address->postalCode) }}</td>
                                                    <td>{{ ucfirst($full_response->bankName) }}</td>
                                                    <td>${{ $payment->amount }}</td>
                                                    <td>{{ ucfirst($payment->status) }}</td>
                                                    <td>{{ date('m/d/Y', strtotime($payment->createdAt)) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade new-address" id="account-details" tabindex="14" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Account Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form_wrap customers-management-view">
                    <div class="modal-body address-form">
                        <div class="form-row">
                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Account Name</label>
                                <input class="form-control" id="account_name" readonly>
                            </div>
                            <div class="form-group  mb-3 col-md-6 col-12">
                                <label>Account Number</label>
                                <input class="form-control" id="account_number" readonly>
                            </div>
                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Routing Number</label>
                                <input class="form-control" id="routing_number" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label>Account Balance</label>
                                <input class="form-control" id="account_balance" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Program ID</label>
                                <input class="form-control" id="program_id" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Account Type</label>
                                <input class="form-control" id="account_type" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12  d-flex flex-wrap">
                                <label>Sponsor Bank Name</label>
                                <input class="form-control" id="sponsor_bank_name" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 d-flex flex-wrap">
                                <label>Interest</label>
                                <input class="form-control" id="interest" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 d-flex flex-wrap">
                                <label>Fees</label>
                                <input class="form-control" id="fees" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Pending Debit</label>
                                <input class="form-control" id="pending_debit" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Pending Credit</label>
                                <input class="form-control" id="pending_credit" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Account Interest Frequency</label>
                                <input class="form-control" id="account_interest" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Send Limits</label>
                                <div class="card limit_section">
                                    <div class="card-body" id="account_send">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Receive Limits</label>
                                <div class="card limit_section">
                                    <div class="card-body" id="account_receive">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Account Status</label>
                                <input class="form-control" id="account_status" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Is Verified</label>
                                <input class="form-control" id="is_verified" readonly>
                            </div>

                            <div class="form-group mb-3 col-md-6 col-12">
                                <label>Created At</label>
                                <input class="form-control" id="created_at" readonly>
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .limit_section {
            display: block;
            width: 100%;
            min-height: 60px;
            padding: 10px 22px;
            border: 1px solid #222A3B;
            padding-left: 20px;
            color: #222A3B;
            font-size: 13px;
            border-radius: 8px !important;
            box-shadow: none;
        }
    </style>
@stop

@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#account-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Account Added"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#pull-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Funds Pulled from External Account"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });


            $('#debit-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Funds Pulled using Debit Card"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#deposit-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Check Deposited"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#intrabank-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No IntraBank Transaction"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#anotherbank-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Funds Transfer to Another Bank"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#todebit-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Funds Transfer To Debit Card"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#domesticwire-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        },

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Transaction Using Domestic Wire"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

            $('#internationalwire-list').DataTable({
                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'copyHtml5',

                        text: '<i class="fa fa-copy mr-1"></i> Copy',

                        titleAttr: 'Copy',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },

                    },

                    {

                        extend: 'excelHtml5',

                        text: '<i class="fa fa-file-excel mr-1"></i>Excel',

                        titleAttr: 'Excel',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },

                    },

                    {

                        extend: 'csvHtml5',

                        text: '<i class="fa fa-file-csv mr-1"></i>CSV',

                        titleAttr: 'CSV',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },

                    },

                    {

                        extend: 'pdfHtml5',

                        text: '<i class="fa fa-file-pdf mr-1"></i>PDF',

                        titleAttr: 'PDF',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                        },

                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }

                ],
                oLanguage: {
                    sEmptyTable: "No Transaction Using International Wire"
                },
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row) {
                        return data.substr(0, 2);
                    }
                }],
            });

        });

        $(document).on('click', '.nav-item', function() {
            $('.nav-link-header').each(function() {
                if ($(this).hasClass('active')) {
                    var target = $(this).attr('href');
                    $('.tab-pane').removeClass('show');
                    $('.tab-pane').removeClass('active');
                    $(target).addClass('show');
                    $(target).addClass('active');
                }
            })
        })



        $('.account_details').click(function(e) {

            var id = $(this).attr('id');

            var url = '{{ route('view_account', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    if (response.status == "true") {
                        $('#account_name').val(response.data.label.charAt(0).toUpperCase() + response
                            .data.label.slice(1));
                        $('#account_number').val(response.data.accountNumber);
                        $('#routing_number').val(response.data.routingNumber);
                        $('#account_type').val(response.data.type.charAt(0).toUpperCase() + response
                            .data.type.slice(1));
                        $('#program_id').val(response.data.programId);
                        $('#sponsor_bank_name').val(response.data.sponsorBankName.charAt(0)
                            .toUpperCase() + response.data.sponsorBankName.slice(1));
                        $('#interest').val(response.data.interest);
                        $('#fees').val("$" + response.data.fees + "/" + response.data
                            .accountInterestFrequency);
                        $('#account_balance').val("$" + response.data.availableBalance);
                        $('#pending_debit').val("$" + response.data.pendingDebit);
                        $('#pending_credit').val("$" + response.data.pendingCredit);
                        $('#account_interest').val(response.data.accountInterestFrequency.charAt(0)
                            .toUpperCase() + response.data.accountInterestFrequency.slice(1));

                        var config = $.parseJSON(response.data.config);

                        $('#account_send').html("<span>Daily : $</span>" + config.limits.send.daily +
                            "<br>" + "<span>Monthly : $</span>" + config.limits.send.monthly);
                        $('#account_receive').html("<span>Daily : $</span>" + config.limits.receive
                            .daily + "<br>" + "<span>Monthly : $</span>" + config.limits.receive
                            .monthly);
                        $('#account_status').val(response.data.status.charAt(0).toUpperCase() + response
                            .data.status.slice(1));
                        $('#is_verified').val(response.data.isVerified == 0 ? 'Not Verified' :
                            'Verified');
                        $('#created_at').val(response.created_at);
                    }
                }
            });
        });
    </script>
@endpush
