 
<div>
  
  <!-- for Report -->
  <div id="accordion">

    <div class="card">
        <div class="card-header">
         Report
         <a class="card-link" data-toggle="collapse" href="#collapseOne">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div> 
    <div id="collapseOne" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="report-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allReportsTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end for report -->




<!-- for Support -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
         Support
         <a class="card-link" data-toggle="collapse" href="#Support">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="Support" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="support-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allSupportTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end for Support -->



<!-- for Consultation -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
         Consultation
         <a class="card-link" data-toggle="collapse" href="#Consultation">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="Consultation" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="consultation-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allConsultationTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end for Consultation -->








<!-- for    Dna Test Support -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
         Dna Test Support
         <a class="card-link" data-toggle="collapse" href="#DnaTestSupport">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="DnaTestSupport" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="dna-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allDnaTestSupportTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end for DnaTestSupport -->





<!-- for  ChronicDiseaseSupport -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
          Chronic Disease Support
          <a class="card-link" data-toggle="collapse" href="#ChronicDiseaseSupport">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="ChronicDiseaseSupport" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="chronic-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allChronicDiseaseSupportTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end forChronicDiseaseSupport -->



<!-- for  weight_loss_support -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
            Weight Loss Support
            <a class="card-link" data-toggle="collapse" href="#WeightLossSupport">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </div>
        <div id="WeightLossSupport" class="collapse    " data-parent="#accordion">
            <div class="card-body">
             
                <table style="width:100%" id="WeightLossSupport-list-hs" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="display-none"></th>
                            <th>Ticket Id</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Current Nutiritionist</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allWeightLossSupportTickets as $ticket)
                        <tr>
                            <th class="display-none"></th>
                            <td>{{ $ticket->unique_ticket_id }}</td>
                            <td>

                                {{ $ticket->category }}
                            </td>
                            <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                            </td>




                            <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                            <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                            </td>


                        </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>


</div>

<!-- end weight_loss_support -->



<!-- for  DietPlanSupport -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
          Diet Plan Support
          <a class="card-link" data-toggle="collapse" href="#DietPlanSupport">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="DietPlanSupport" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="DietPlanSupport-list-hs" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allDietPlanSupportTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end DietPlanSupport -->



<!-- for  allTalkToGenahealthxTickets -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
          Talk To Genahealthx
          <a class="card-link" data-toggle="collapse" href="#TalkToGenahealthx">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="TalkToGenahealthx" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="TalkToGenahealthx-list" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allTalkToGenahealthxTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end allTalkToGenahealthxTickets -->





<!-- for  allOtherSupportTickets -->
<div id="accordion">

    <div class="card">
        <div class="card-header">
           Other Support
           <a class="card-link" data-toggle="collapse" href="#OtherSupport">
            <i class="fa fa-angle-down" aria-hidden="true"></i>
        </a>
    </div>
    <div id="OtherSupport" class="collapse    " data-parent="#accordion">
        <div class="card-body">
         
            <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="display-none"></th>
                        <th>Ticket Id</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Current Nutiritionist</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($allOtherSupportTickets as $ticket)
                    <tr>
                        <th class="display-none"></th>
                        <td>{{ $ticket->unique_ticket_id }}</td>
                        <td>

                            {{ $ticket->category }}
                        </td>
                        <td> <span style="color:{{ @$ticket->status->color }}">{{ @$ticket->status->name }}</span>
                        </td>




                        <td> {{ @$ticket->nutritionist->name ?? '--' }}</td>


                        <td> <a title="View" href="{{route('user_view_ticket',['id'=>$ticket->id])}}"><i class="text-success fa fa-eye"></i></a>



                        </td>


                    </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>
</div>


</div>

<!-- end allOtherSupportTickets -->
</div>