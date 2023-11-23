 <div class="row">

 	<div class="col-md-6">
 		<div class="form-group">
 			<label for="descripiton">Early morning</label>
 			<textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->early_morning_recall ?? '--' }}</textarea>
 		</div>
 	</div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Breakfast</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->breakfast_recall ?? '--' }}</textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Lunch</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->lunch_recall ?? '--' }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Mid-morning</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->mid_morning_recall ?? '--' }}</textarea>
        </div>
    </div>
     
      <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Evening</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->evening_recall ?? '--' }}</textarea>
        </div>
    </div>


 <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Dinner</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->dinner_recall ?? '--' }}</textarea>
        </div>
    </div>


 <div class="col-md-6">
        <div class="form-group">
            <label for="descripiton">Post dinner</label>
            <textarea readonly name="description" class="form-control" rows="4" readonly="">{{ @$User->UserMetadata->post_dinner_recall ?? '--' }}</textarea>
        </div>
    </div>

    


</div>