
	<div class="navbar navbar-dark bg-dark">
	<div class="container">
		<a href="#" class="navbar-brand">Edit Strip</a>
		
	</div>	
</div>
<?php do_action('admin_notices'); ?>
<div class="container">
<div class="form-class">
	<form method="post" name="edit-strip" action="<?php echo $_SERVER['REQUEST_URI']; ?>">


		<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Name</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="strip_name" id="strip-name" value="<?php echo $data->strip_name; ?>" placeholder="">
    </div>
  </div>
	
		<div class="form-group row">
		<div class="col-md-2">
			<label class="form-check-label" for="exampleRadios1">
    Strip Visiblity :
  </label>
		</div>

	<div class="col-md-6">
    <?php if($data->strip_visiblity==1) { ?>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio1" value="1" checked="">
  <label class="form-check-label" for="inlineRadio1">Enable</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio2" value="0">
  <label class="form-check-label" for="inlineRadio2">Disable</label>
</div>
<?php } else { ?>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio1" value="1" >
  <label class="form-check-label" for="inlineRadio1">Enable</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="strip_visiblity" id="inlineRadio2" value="0" checked="">
  <label class="form-check-label" for="inlineRadio2">Disable</label>
</div>
<?php } ?>
 </div>
</div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Color</label>
    <div class="col-sm-2">
      <input type="color" class="form-control" name="strip_color" id="strip-color" value="<?php echo $data->strip_color; ?>" placeholder="">
    </div>
  </div>

<div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Strip Height</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" name="strip_height" id="strip-height" value="<?php echo $data->strip_height; ?>" placeholder="Eg: 10px">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Color</label>
    <div class="col-sm-2">
      <input type="color" class="form-control" name="button_color" id="button-color" placeholder="" value="<?php echo $data->button_color; ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Button Size</label>
    <div class="col-sm-6">
    <select class="form-control" name="button_size" id="exampleFormControlSelect1">
      <?php if($data->button_size == "btn btn-primary btn-sm") { ?>
      <option value="btn btn-primary btn-sm" selected="">Small</option>
       <option value="btn btn-primary btn-md">Medium</option>
       <option value="btn btn-primary btn-lg">Large</option>
    <?php } elseif($data->button_size == "btn btn-primary btn-md") { ?> 
       <option value="btn btn-primary btn-sm">Small</option>
       <option value="btn btn-primary btn-md" selected="">Medium</option>
       <option value="btn btn-primary btn-lg">Large</option>
    <?php } elseif($data->button_size == "btn btn-primary btn-lg") { ?>
       <option value="btn btn-primary btn-sm">Small</option>
       <option value="btn btn-primary btn-md">Medium</option>
       <option value="btn btn-primary btn-lg" selected="">Large</option>
    <?php } else{ ?>
   <option value="btn btn-primary btn-sm">Small</option>
       <option value="btn btn-primary btn-md">Medium</option>
       <option value="btn btn-primary btn-lg">Large</option>

  <?php   } ?>
    
    </select>
  </div>
</div>
 <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Label</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name="button_label" value="<?php echo $data->button_label; ?>" id="button-label" placeholder="">
    </div>
  </div>
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Button Link</label>
    <div class="col-sm-6">
      <input type="url" class="form-control" name="button_link" value="<?php echo $data->button_link; ?>" id="button-link" placeholder="">
    </div>
  </div>
 
  <div class="form-group row">
    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Strip Text</label>
    <div class="col-sm-6">
    <?php wp_editor($data->message_body,'strip_text'); ?> 
  </div>
</div>
  <div class="form-group row">
    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Strip Text Color</label>
    <div class="col-sm-2">
     <input type="color" class="form-control" name="strip_text_color" id="strip_text_colot" value="<?php echo $data->message_text_color; ?>" placeholder="">
  </div>
</div>
<div class="form-group row">
	<label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label"></label>
       <div class="col-sm-6">
     <input type="submit" class="btn btn-primary" name="update" id="button-link" value="Update" placeholder="">
  </div>
</div>

</form>
</div>
</div>
