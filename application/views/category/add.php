<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Category</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

<script>
/*
function save()
{
	var cat_name=$('#cat_name').val();
		if (cat_name == "") {
			alert("Please enter category name");
			return false;
		}
	var cat_desc=$('#cat_desc').val();
		if (cat_desc == "") {
			alert("Please enter category description");
			return false;
		}
	
	var cat_image=$('#cat_image').prop('files')[0];
	
	var active=$('#active').val();
	var items=$('#items').val();
	var main_cat=$('#main_cat').val();
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>index.php/category/add/", 
		data: { cat_name:cat_name, cat_desc:cat_desc, cat_image:cat_image, active:active, items:items, main_cat:main_cat},
		success: function(msg) 
		{ 				
			alert("Record save successfully");
			window.location("<?php echo base_url();?>index.php/category/");
		}
	}).error(function(error) 
	{
		alert(error.responseText);
	});	

	return false;
}

function edit(cat_id)
{
	var cat_id=cat_id;
	var cat_name=$('#cat_name').val();
		if (cat_name == "") {
			alert("Please enter category name");
			return false;
		}
	var cat_desc=$('#cat_desc').val();
		if (cat_desc == "") {
			alert("Please enter category description");
			return false;
		}
	var catname=$('#cat_image').prop('files')[0];
	var cat_image='';
		if(catname!=undefined)
		{
			cat_image=catname.name;
		}
	
	var active=$('#active').val();
	var items=$('#items').val();
	var main_cat=$('#main_cat').val();
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>index.php/category/add/"+cat_id, 
		data: { cat_id:cat_id, cat_name:cat_name, cat_desc:cat_desc, cat_image:cat_image, active:active, items:items, main_cat:main_cat},
		success: function(msg) 
		{ 				
			alert("Record update successfully");
			window.location("<?php echo base_url();?>index.php/category/");
		}
	}).error(function(error) 
	{
		alert(error.responseText);
	});	

	return false;
}*/
	
function validate()
{
 var error="";
 var name = document.getElementById( "cat_name" );
 if( name.value == "" )
 {
  error = " You Have To Write Your Name. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 var email = document.getElementById( "cat_desc" );
 if( email.value == "" )
 {
  error = " You Have To Write Valid Email Address. ";
  document.getElementById( "error_para" ).innerHTML = error;
  return false;
 }

 else
 {
  return true;
 }
}

</script>	
</head>
<body>

<?php if($this->session->flashdata('error')) {
		echo $this->session->flashdata('error'); }
?>

<div id="container">

	<?php $cat_id = "";
			if(isset($catdata->cat_id) && !empty($catdata->cat_id)) {
				$cat_id = $catdata->cat_id;
			}
		
		if(isset($catdata->items) && !empty($catdata->items)) {
		$items_array = json_decode(json_encode($catdata->items),TRUE);
		$items_array = explode(",",$items_array);
		}
	?>

	<h1><?php if($cat_id) echo "Edit Category"; else echo "Add Category";?></h1>
	
	<div id="body">
	
		<form method="post" enctype="multipart/form-data" action="<?php echo base_url()."index.php/category/add/".$cat_id; ?>" onsubmit="return validate();">
			
			<input type="hidden" name="cat_id" id="cat_id" value="<?php if(isset($catdata->cat_id) && !empty($catdata->cat_id)) echo $catdata->cat_id; ?>" />
			<p id="error_para" ></p>
			<label> Category Name</label>
			<input type="text" name="cat_name" id="cat_name" value="<?php if(isset($catdata->cat_name) && !empty($catdata->cat_name)) echo $catdata->cat_name; ?>" />
			</br></br>
			<label> Category Desc</label>
			<textarea name="cat_desc" id="cat_desc"  rows=3><?php if(isset($catdata->cat_desc) && !empty($catdata->cat_desc)) echo $catdata->cat_desc; ?></textarea>
			</br></br>
			<label> Category Image</label>
			<input type="file" name="cat_image" id="cat_image" />
			</br></br>
			<label> Active</label>
			<input type="radio" name="active" id="active" <?php if(isset($catdata->active) && !empty($catdata->active)) { if($catdata->active=='1') {echo 'checked'; } }?>  value="1"/>Yes
			<input type="radio" name="active" id="active" <?php if(isset($catdata->active) && !empty($catdata->active)) { if($catdata->active=='2') {echo 'checked'; } }?>  value="2"/>No
			</br></br>
			<label> Select Items</label>
			<input type="checkbox" name="items[]" id="items" <?php if (isset($catdata->items) && !empty($catdata->items) && in_array("1", $items_array))  echo 'checked'; ?> value="1"/>Item_1
			<input type="checkbox" name="items[]" id="items" <?php if (isset($catdata->items) && !empty($catdata->items) && in_array("2", $items_array))  echo 'checked'; ?> value="2"/>Item_2
			<input type="checkbox" name="items[]" id="items" <?php if (isset($catdata->items) && !empty($catdata->items) && in_array("3", $items_array))  echo 'checked'; ?> value="3"/>Item_3
			<input type="checkbox" name="items[]" id="items" <?php if (isset($catdata->items) && !empty($catdata->items) && in_array("4", $items_array))  echo 'checked'; ?> value="4"/>Item_4
			</br></br>
			<label> Select Main Category</label>
			<select name="main_cat" id="main_cat">
				<option value="0" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '0')  echo 'selected = "selected"'; ?>>Select</option>
				<option value="1" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '1')  echo 'selected = "selected"'; ?>>main cat 1</option>
				<option value="2" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '2')  echo 'selected = "selected"'; ?>>main cat 2</option>
				<option value="3" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '3')  echo 'selected = "selected"'; ?>>main cat 3</option>
				<option value="4" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '4')  echo 'selected = "selected"'; ?>>main cat 4</option>
				<option value="5" <?php if (!empty($catdata->main_cat) && $catdata->main_cat == '5')  echo 'selected = "selected"'; ?>>main cat 5</option>
			</select>
			</br></br>
			<?php if($cat_id) { ?>
			<button type="submit" onclick="return edit(<?php echo $cat_id; ?>);">Edit category</button>
			<?php } else { ?>
			<button type="submit" onclick="return save();">Add category</button>
			<?php } ?>
			<a href="<?php echo base_url()."index.php/category/" ?>"><button type="button" >Cancel</button></a>
		</form>
	</div>
</body>
</html>

	