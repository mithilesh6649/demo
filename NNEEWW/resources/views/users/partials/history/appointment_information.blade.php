 <div class="row">

 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Reason for appointment</label>
 			<textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->reason_for_appointment ?? '--' }}</textarea>
 		</div>
 	</div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Expectations</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->expectations_appointment ?? '--' }}</textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Clinical Goals</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->clinical_goals_appointment ?? '--' }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Other information</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->other_information_appointment ?? '--' }}</textarea>
        </div>
    </div>

    


</div>