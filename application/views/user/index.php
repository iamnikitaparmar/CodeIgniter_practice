<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>

<script>

$(document).ready(function()
	{
		filluser(0);	
	});
	
function filluser(id)
{
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "<?php echo base_url();?>index.php/user/view_user",
		//data: "cm_id="+cm_id,
		success: function(data)
		{ 	
			var j=1;
		$('#tbodyuser').empty();
		$(data).each(function(i,obj)
		{
			var tr='<tr>';
			tr +='<td>'+j+'</td>';
			tr +='<td>'+obj.firstname+'</td>';
			tr +='<td>'+obj.lastname+'</td>';
			tr +='<td>'+obj.username+'</td>';
			tr +='<td>'+obj.email+'</td>';
			tr +='<td><a href="<?php echo base_url();?>index.php/user/add/'+obj.id+'" class="btn btn-success">Update</a> ';	
			tr +='<a href="#" onclick="return delete_id('+obj.id+');" class="btn btn-danger">Delete</a></td>';
			tr +='</tr>';
			j++;
		$('#tbodyuser').append(tr);	
		});
		
		}
	}).error(function(error) 
	{
		alert(error.responseText);
		
	});    
	return false;
} 

function delete_id(dlt_id)
{
	var succ = confirm("Do you want to delete?");
		if(succ==true) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>index.php/user/delete/"+dlt_id, 
				//data: "dlt_id="+dlt_id,
				success: function(msg) 
				{ 				
					alert("Record delete successfully");
					filluser(0);
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


<div class="pageheader">
  <h2><i class="fa fa-home"></i> User Management <span>List User</span></h2>
  <div class="breadcrumb-wrapper">
	<span class="label">You are here:</span>
	<ol class="breadcrumb">
	  <li><a href="index.html">Bracket</a></li>
	  <li class="active">List User</li>
	</ol>
  </div>
</div>

<div class="contentpanel">
   <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
          <table class="table mb30">
		  <a href="<?php echo base_url()."index.php/user/add/"?>" class="btn btn-success">Add New User</a>
            <thead>
              <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
			        	<th>Email</th>
				        <th>Action</th>
              </tr>
            </thead>
            <tbody id="tbodyuser">
               
			 
            </tbody>
          </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->
        
        
        
      </div><!-- row -->
      
</div>