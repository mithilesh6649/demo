<div class="col-md-12 col-lg-12 col-xl-12 col-12">
	<input type="hidden" name="id[]" class="form-control"  >
                                            <div class="row choices_child mt-2">
                                                <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                 <div class="form-group">
                                                    <label for="duration[]">Select Plan Duration</label>
                                                    <select name="duration[]" id="duration[]" class="form-control">
                                                        @foreach($MonthDurations as $MonthDuration)
                                                        <option value="{{$MonthDuration->value}}">{{$MonthDuration->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4  col-lg-4  col-xl-4 col-12">
                                                <div class="mainArabicChoiceContainer">
                                                    <div class="form-group">
                                                        <label for="amount">Amount<span
                                                            class="text-danger"> *</span></label>
                                                            <input type="number" name="amount[]" class="form-control"
                                                            value="" step="any">
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-3  col-lg-3  col-xl-3 col-12">
                                                    <div class="form-group">
                                                        <label for="discount">Discount  </label>
                                                        <input type="number" name="discount[]" class="form-control"
                                                        value="" step="any">
                                                    </div>
                                                </div>

                                                    <div class="col-md-1 col-lg-1 col-xl-1 col-1 delete">
                                                 <i class="text-danger fa fa-trash-alt delete-button-just-created" style="font-size:28px;cursor:pointer;"></i> <!-- <i
                                                    class="text-success"
                                                    style="font-size:14px; margin-top:20px;">Default</i> -->
                                            </div>
  

                                            </div>
                                        </div>