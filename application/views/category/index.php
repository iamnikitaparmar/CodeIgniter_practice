<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

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

$(document).ready(function()
	{
		fillcategory(0);	
	});
	
function fillcategory(cat_id)
{
	
	$.ajax({
		
		type: "POST",
		dataType: "json",
		url: "<?php echo base_url();?>index.php/category/view_cat/",
		//data: "cm_id="+cm_id,
		success: function(data)
		{ 	
			
			var j=1;
		$('#tbodycat').empty();
		$(data).each(function(i,obj)
		{
			if(obj.active==1){
				var active='Yes';
			} else { 
				var active='No';
			}

			/*if(obj.items==1){
				var items='Item_1';
			} else if(obj.items==2){ 
				var items='Item_2';
			} else if(obj.items==3){ 
				var items='Item_3';
			} else if(obj.items==4){ 
				var items='Item_4';	
			} else {
				var items='';
			} */

			if(obj.main_cat==1){
				var main_cat='main cat 1';
			} else if(obj.main_cat==2){ 
				var main_cat='main cat 2';
			} else if(obj.main_cat==3){ 
				var main_cat='main cat 3';
			} else if(obj.main_cat==4){ 
				var main_cat='main cat 4';	
			} else if(obj.main_cat==5){ 
				var main_cat='main cat 5';	
			} else {
				var main_cat='';
			}	
			
			var tr='<tr>';
			tr +='<td>'+j+'</td>';
			tr +='<td>'+obj.cat_name+'</td>';
			tr +='<td>'+obj.cat_desc+'</td>';
			tr +="<td><img style='height: 50;' src='<?php echo base_url();?>images/category/"+obj.cat_image+"'></img></td>";
			tr +='<td>'+active+'</td>';
			tr +='<td>'+obj.items+'</td>';
			tr +='<td>'+main_cat+'</td>';
			tr +='<td><a href="<?php echo base_url();?>index.php/category/add/'+obj.cat_id+'" >Update</a>|';	
			tr +='<a href="#" onclick="return delete_id(' + obj.cat_id + ',\'' + obj.cat_image +'\');">Delete</a></td>';
			tr +='</tr>';
			j++;
		$('#tbodycat').append(tr);	
		});
		
		}
	}).error(function(error) 
	{
		alert(error.responseText);
		
	});    
	return false;
}

function delete_id(cat_id,cat_image)
{	

	var succ = confirm("Do you want to delete?");
		if(succ==true) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/category/delete/", 
				data: { cat_id : cat_id, cat_image : cat_image},
				success: function(msg) 
				{ 				
					alert("Record delete successfully");
					fillcategory(0);
				}
			}).error(function(error) 
			{
				alert(error.responseText);
			});	
		} else {
			return false;
		}	
	
	return false;
}	

</script>	
	
</head>
<body>

<?php
	if($this->session->flashdata('error')) {
		echo $this->session->flashdata('error');
	} else if($this->session->flashdata('success')) {
		echo $this->session->flashdata('success');
	}
	
 
?>

<div id="container">

	<h1>Welcome to CodeIgniter!</h1>
	<a href="<?php echo base_url()."index.php/category/add/"; ?>">Add Category</a>
	<div id="body">
		<table border=1>
			<tr>
				<th>Category ID</th>
				<th>Category Name</th>
				<th>Category Desc</th>
				<th>Image</th>
				<th>Active</th>
				<th>Selected Items</th>
				<th>Main Category</th>
				<th>Action</th>
				
			</tr>
			<tbody id="tbodycat">
			
			</tbody>
			<?php echo textConvert('vidhi'); ?>
			<?php echo textConvert1('VIDHI'); ?>
		</table>
	</div>
</body>
</html>

