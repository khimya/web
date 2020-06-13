<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");

	 
	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{
          
       $data = array( 
			    'color_name'  =>  trim($_POST['color_name']),
			   	'color_code'  =>  trim('#'.$_POST['color_code'])
			    );		

 		$qry = Insert('tbl_color',$data);	

 	    $color_id=mysqli_insert_id($mysqli);	

		$_SESSION['msg']="10";
 
		header( "Location:add_color.php?add=yes");
		exit; 
		
	}
	
	if(isset($_GET['color_id']))
	{
			 
		$qry="SELECT * FROM tbl_color where color_id='".$_GET['color_id']."'";
		$result=mysqli_query($mysqli,$qry);
		$row=mysqli_fetch_assoc($result);

	}
	if(isset($_POST['submit']) and isset($_POST['color_id']))
	{
		 
		$data = array( 
			    'color_name'  =>  trim($_POST['color_name']),
			   	'color_code'  =>  trim('#'.$_POST['color_code'])
			    );	
 
		$category_edit=Update('tbl_color', $data, "WHERE color_id = '".$_POST['color_id']."'");
		$_SESSION['msg']="11"; 
		header( "Location:add_category.php?color_id=".$_POST['color_id']);
		exit;
 
	}


?>
<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title"><?php if(isset($_GET['color_id'])){?>Edit<?php }else{?>Add<?php }?> Color</div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
            	<input  type="hidden" name="color_id" value="<?php echo $_GET['color_id'];?>" />

              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Color Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="color_name" id="color_name" value="<?php if(isset($_GET['color_id'])){echo $row['color_name'];}?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Color :-
                    </label>
                    <div class="col-md-6">
                      <input value="<?php if(isset($_GET['color_id'])){echo str_replace('#','',$row['color_code']);}else{ echo 'e91e63';}?>" name="color_code" class="form-control jscolor {width:243, height:150, position:'right',
                      borderColor:'#000', insetColor:'#FFF', backgroundColor:'#ddd'}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       

<script type="text/javascript" src="assets/js/jscolor.js"></script>