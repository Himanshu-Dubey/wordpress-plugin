
	<div class="navbar navbar-dark bg-dark">
	<div class="container">
		<a href="#" class="navbar-brand">Add New Strip</a>
		
	</div>	
</div>
<?php do_action('admin_notices'); ?>
<div class="container">
<div class="form-class">
	<form method="post" name="create-strip" action="<?php echo $_SERVER['REQUEST_URI']; ?>">


		<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Name</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="strip_name" id="strip-name" placeholder="">
    </div>
  </div>
	
		<div class="form-group row">
		<div class="col-md-2">
			<label class="form-check-label" for="exampleRadios1">
    Strip Visiblity :
  </label>
		</div>

	<div class="col-md-6">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio1" value="1" checked="">
  <label class="form-check-label" for="inlineRadio1">Enable</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio2" value="0">
  <label class="form-check-label" for="inlineRadio2">Disable</label>
</div>
</div>
</div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Color</label>
    <div class="col-sm-2">
      <input type="color" class="form-control" name="strip_color" id="strip-color" placeholder="">
    </div>
  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Height</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="strip_height" id="strip-height" placeholder="Eg: 10px">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Color</label>
    <div class="col-sm-2">
      <input type="color" class="form-control" name="button_color" id="button-color" placeholder="">
    </div>
  </div>

  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Button Size</label>
    <div class="col-sm-6">
    <select class="form-control" name="button_size" id="exampleFormControlSelect1">
       <option value="btn btn-primary btn-sm">Small</option>
       <option value="btn btn-primary btn-md">Medium</option>
       <option value="btn btn-primary btn-lg">Large</option>
    
    </select>
  </div>
</div>
 <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Label</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="button_label" id="button-label" placeholder="">
    </div>
  </div>
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Link</label>
    <div class="col-sm-6">
      <input type="url" class="form-control" name="button_link" id="button-link" placeholder="">
    </div>
  </div>
 
  <div class="form-group row">
    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Strip Text</label>
    <div class="col-sm-6">
    <?php wp_editor($thoughts,'strip_text'); ?> 
  </div>
</div>
  <div class="form-group row">
    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Strip Text Color</label>
    <div class="col-sm-2">
     <input type="color" class="form-control" name="strip_text_color" id="button-link" placeholder="">
  </div>
</div>
<input type="hidden" name="strip_id" value="<?php echo $data->id; ?>">
<div class="form-group row">
	<label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label"></label>
       <div class="col-sm-6">
     <input type="submit" class="btn btn-primary" name="submit" id="button-link" value="Save" placeholder="">

  </div>
</div>

</form>
</div>
</div>
