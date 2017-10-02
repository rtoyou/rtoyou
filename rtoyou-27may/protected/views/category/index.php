 <style>
 
.typeahead,
.tt-query,
.tt-hint {
  width: 396px;
  height: 35px;
  padding: 8px 12px;
  
  line-height: 30px;
 
 
  outline: none;
}

.typeahead {
  background-color: #f7f7f7;
}

.typeahead:focus {
  border: 1px solid #efefef;
}

.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {
  width: 422px;
  margin: 12px 0;
  padding: 8px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 8px;
     -moz-border-radius: 8px;
          border-radius: 8px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
  padding: 3px 20px;
  font-size: 18px;
  line-height: 24px;
}

.tt-suggestion:hover {
  cursor: pointer;
  color: #fff;
  background-color: #0097cf;
}

.tt-suggestion.tt-cursor {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}
 
 </style><div class="st-pusher">
            <!-- sidebar effects INSIDE of st-pusher: -->
            <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
            <!-- this is the wrapper for the content -->
             <div class="st-content" id="content">
                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner">
                    <div class="container-fluid">
                        <div class="jumbotron text-center bg-transparent margin-none">
                            <h1>Post a Review</h1>
                        </div>
                        <div class="page-section">
                            <div class="row">
                                <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                                    <div class="panel panel-info">
                                    	<div class="panel-heading panel-heading-gray title">
                                            What´s new
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" action="post/listall" method="POST" name="post_review">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Category</label>
                                                    <div class="col-sm-10">
                                                        <select name="category" class="selectpicker category" data-style="btn-white" data-live-search="true" data-size="5" style="display: none;">
                                                            <?php foreach ($category as $a=>$v) { ?>
                                                            	 <option value="<?php echo $v['category_id'];?>"><?php echo $v['category_name'];?></option>
                                                            <?php }?>
                                                          
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Review On</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="review_on" id="review_on" class="form-control typeahead" placeholder="Start typing ...">
                                                    </div>
                                                </div>
                                                <div class="form-group  required">
                                                    <label class="col-sm-2 control-label">Message</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" rows="5" placeholder="Write Your opinion about this to help others ..."></textarea>
                                                    </div>
                                                </div>
                                                 <div class="form-group  required">
                                                    <label class="col-sm-2 control-label">Add Photos</label>
                                                     <div class="col-sm-10">
                                               		 <input id="input-700" name="kartik-input-700[]" type="file" multiple class="file-loading">
                                                	</div>
                                                </div>
                                                <div class="form-group">
						<label class="col-sm-2 control-label">Rate it</label>
						<div class="col-sm-10">
						<div class="radio radio-danger radio-inline">
                                                        <input type="radio" name="radio2" id="radio21" value="option1" checked="">
                                                        <label for="radio21">Fuzzy</label>
                                                    </div>
						<div class="radio radio-warning radio-inline">
                                                        <input type="radio" name="radio2" id="radio22" value="option2">
                                                        <label for="radio22">Bad</label>
                                                    </div>
<div class="radio radio-info radio-inline">
                                                        <input type="radio" name="radio2" id="radio23" value="option3">
                                                        <label for="radio23">Average</label>
                                                    </div>

<div class="radio radio-primary radio-inline">
                                                        <input type="radio" name="radio2" id="radio24" value="option3">
                                                        <label for="radio24">Good</label>
                                                    </div>

<div class="radio radio-success radio-inline">
                                                        <input type="radio" name="radio2" id="radio25" value="option3">
                                                        <label for="radio25">Awesome</label>
                                                    </div>
						</div></div>
						 <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary" data-dismiss="modal">Post</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /st-content-inner -->
            </div>
            <!-- /st-content -->
        </div>