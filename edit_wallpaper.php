<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");

  //Get Category
	$cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
	$cat_result=mysqli_query($mysqli,$cat_qry); 

  $qry="SELECT * FROM tbl_wallpaper where id='".$_GET['wallpaper_id']."'";
  $result=mysqli_query($mysqli,$qry);
  $row=mysqli_fetch_assoc($result);

  $sql="SELECT * FROM tbl_color WHERE color_status='1' ORDER BY color_name";
  $col_result=mysqli_query($mysqli,$sql);
	
	if(isset($_POST['submit']))
	{    


        if($_POST['wall_tags']=='')
        {
             
            $qry="SELECT * FROM tbl_category where cid='".$_POST['cat_id']."'";
            $result=mysqli_query($mysqli,$qry);
            $row=mysqli_fetch_assoc($result);

            $wall_tags=$row['category_name'];

        }
        else
        {
          $wall_tags=$_POST['wall_tags'];
        }

    		if($_FILES['wallpaper_image']['name']!="")
        { 
           $file_name= str_replace(" ","-",$_FILES['wallpaper_image']['name']);

    			 $albumimgnm=rand(0,99999)."_".$file_name;
       
           //Main Image
           $tpath1='categories/'.$_POST['cat_id'].'/'.$albumimgnm;       
           $pic1=compress_image($_FILES["wallpaper_image"]["tmp_name"], $tpath1, 100);
       
		        $data = array( 
					    'cat_id'  =>  $_POST['cat_id'],
              'wallpaper_type'  =>  $_POST['wallpaper_type'],
					    'image'  =>  $albumimgnm,
              'wall_tags'  =>  $wall_tags,
              'wall_colors'  =>  implode(',', $_POST['wallpaper_color'])
					    );		

    		 		 
             $qry=Update('tbl_wallpaper', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
        }
        else
        {

            if($row['cat_id']!=$_POST['cat_id']){

              $curr_File='categories/'.$row['cat_id'].'/'.$row['image'];
              $moveFile='categories/'.$_POST['cat_id'].'/'.$row['image'];
              if (copy($curr_File,$moveFile)) 
              {
                unlink($curr_File);
              }

              $albumimgnm=$row['image'];
              
            }
            else{
              $albumimgnm=$row['image'];
            }

            
            
            $data = array( 
                  'cat_id'  =>  $_POST['cat_id'],
                  'wallpaper_type'  =>  $_POST['wallpaper_type'],
                  'image'  =>  $albumimgnm,
                  'wall_tags'  =>  $wall_tags,
                  'wall_colors'  =>  implode(',', $_POST['wallpaper_color'])
                  );     

             
            $qry=Update('tbl_wallpaper', $data, "WHERE id = '".$_POST['wallpaper_id']."'");
            
               
         }
 			

		$_SESSION['msg']="11";
    header( "Location:edit_wallpaper.php?wallpaper_id=".$_POST['wallpaper_id']);
    
		exit;	

		 
	}
	  
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(e) {
     $("#wallpaper_type").change(function(){
   
     var type=$("#wallpaper_type").val();
        //alert(type);
        if(type=="Portrait")
        {                 
           $("#portrait_lable_info").show();
           $("#landscape_lable_info").hide();
           $("#square_lable_info").hide();
        }
        else if(type=="Landscape")
        {                 
           $("#portrait_lable_info").hide();
           $("#landscape_lable_info").show();
           $("#square_lable_info").hide();
        }
        else if(type=="Square")
        {   
           $("#portrait_lable_info").hide();
           $("#landscape_lable_info").hide();
           $("#square_lable_info").show();
           
        }
        else
        {
           $("#portrait_lable_info").hide();
           $("#landscape_lable_info").hide();
           $("#square_lable_info").hide();
        }   
        
   });

     
  });
</script>

<style type="text/css">
  .select2-container .select2-selection--multiple{
    padding: 10px 15px !important;
  }
</style>

<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Edit Wallpaper</div>
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
              <input  type="hidden" name="wallpaper_id" value="<?php echo $_GET['wallpaper_id'];?>" />

              <div class="section">
                <div class="section-body">
                   <div class="form-group">
                    <label class="col-md-3 control-label">Category :-</label>
                    <div class="col-md-6">
                      <select name="cat_id" id="cat_id" class="select2">
                        <option value="">--Select Category--</option>
          							<?php
          									while($cat_row=mysqli_fetch_array($cat_result))
          									{
          							?>          						 
          							<option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
          							<?php
          								}
          							?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Type :-
                      <!-- <p class="control-label-help">(Optional)</p> -->
                    </label>
                    <div class="col-md-6">
                      <select name="wallpaper_type" id="wallpaper_type" class="select2" required>
                        <!-- <option value="none">--Select Type--</option> -->
                        <option value="Portrait" <?php if($row['wallpaper_type']=="Portrait"){?>selected<?php }?>>Portrait</option>
                        <option value="Landscape" <?php if($row['wallpaper_type']=="Landscape"){?>selected<?php }?>>Landscape</option>
                        <option value="Square" <?php if($row['wallpaper_type']=="Square"){?>selected<?php }?>>Square</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Image :-
                      
                    <p class="control-label-help" id="portrait_lable_info" <?php if($row['wallpaper_type']=="Portrait"){?>style="display: block;" <?php }else{?>style="display: none;"<?php }?>>(Recommended resolution: 600x900,680x1024,640x960,720x1280 OR width less then height)</p>

                    <p class="control-label-help" id="landscape_lable_info" <?php if($row['wallpaper_type']=="Landscape"){?>style="display: block;" <?php }else{?>style="display: none;"<?php }?>>(Recommended resolution: 900x600,1280x720 OR width more then height)</p>

                    <p class="control-label-help" id="square_lable_info" <?php if($row['wallpaper_type']=="Square"){?>style="display: block;" <?php }else{?>style="display: none;"<?php }?>>(Recommended resolution: 500x500,700x700 OR width and height equal)</p>

                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="wallpaper_image" id="fileupload">
                        
                           <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="category image" /></div>
                           
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">&nbsp; </label>
                    <div class="col-md-6">
                      <?php if($row['image']!="") {?>
                            <div class="block_wallpaper"><img src="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" alt="image" /></div>
                          <?php } ?>
                    </div>
                  </div><br>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Tags :-</label>
                    <div class="col-md-6">
                      <input type="text" value="<?php echo $row['wall_tags'];?>" data-role="tagsinput" name="wall_tags" class="form-control" required="" />
                    </div>
                  </div>
                  <br/>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Wallpaper Colors :-</label>
                    <div class="col-md-6">
                      <select name="wallpaper_color[]" class="select2" multiple="multiple" style="padding: 10px 15px !important;">
                        <option value="">--Select Colors--</option>
                        <?php
                            $db_colors=explode(',', $row['wall_colors']);
                            while($colors=mysqli_fetch_array($col_result))
                            {
                              
                        ?>                       
                        <option value="<?php echo $colors['color_id'];?>" <?php if(in_array($colors['color_id'],$db_colors)){ echo 'selected'; } ?>><?php echo $colors['color_name'];?></option>                           
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <hr/>
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
