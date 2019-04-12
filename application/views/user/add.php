<div class="pageheader">
  <h2><i class="fa fa-home"></i> User Management <span>Add User</span></h2>
  <div class="breadcrumb-wrapper">
	<span class="label">You are here:</span>
	<ol class="breadcrumb">
	  <li><a href="index.html">Bracket</a></li>
	  <li class="active">Add User</li>
	</ol>
  </div>
</div>

<div class="contentpanel">

      <div class="row">
        <?php $user_id = "";
			if(isset($user->id) && !empty($user->id)) {
				$user_id = $user->id;
			}
		?>
		
		<?php if($this->session->flashdata('error')) {
		echo $this->session->flashdata('error'); }
		?>
		
		
        <div class="col-md-12">
          <form id="basicForm" method="post" action="<?php echo base_url()."index.php/user/add/".$user_id; ?>" class="form-horizontal">
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">&times;</a>
                  <a href="" class="minimize">&minus;</a>
                </div>
                <h4 class="panel-title">Basic Form Validation</h4>
                <p>Please provide your name, email address (won't be published) and a comment.</p>
              </div>
              <div class="panel-body">
			  
				<input type="hidden" name="user_id" id="user_id" value="<?php if(isset($user->id) && !empty($user->id)) echo $user->id; ?>" >
				
                <div class="form-group">
                  <label class="col-sm-3 control-label">Firstname <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="firstname" id="firstname" value="<?php if(isset($user->firstname) && !empty($user->firstname)) echo $user->firstname; ?>" class="form-control" placeholder="Type your firstname..." required />
                  </div>
                </div>
				
				 <div class="form-group">
                  <label class="col-sm-3 control-label">Lastname <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="lastname" id="lastname" value="<?php if(isset($user->lastname) && !empty($user->lastname)) echo $user->lastname; ?>" class="form-control" placeholder="Type your lastname..." required />
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-sm-3 control-label">Username <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" name="username" id="username" value="<?php if(isset($user->username) && !empty($user->username)) echo $user->username; ?>" class="form-control" placeholder="Type your username..." required />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">Email <span class="asterisk">*</span></label>
                  <div class="col-sm-9">
                    <input type="email" name="email" id="email" value="<?php if(isset($user->email) && !empty($user->email)) echo $user->email; ?>" class="form-control" placeholder="Type your email..." required />
                  </div>
                </div>
                
               
              </div><!-- panel-body -->
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-9 col-sm-offset-3">
                    <a href="<?php echo base_url()."index.php/user/add/" ?>"><button type="submit" class="btn btn-primary"><?php if($user_id) echo "Edit User"; else echo "Add User";?></button></a>
                    <a href="<?php echo base_url()."index.php/user/index/" ?>"><button type="button" class="btn btn-default">Cancel</button></a>
                  </div>
                </div>
              </div>
            
          </div><!-- panel -->
          </form>
          
          
        </div><!-- col-md-6 -->

        
      </div><!--row -->
 </div>




