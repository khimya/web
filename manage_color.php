<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['data_search']))
   {

      $qry="SELECT * FROM tbl_color                   
                  WHERE tbl_color.color_name like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_color.color_name";
 
     $result=mysqli_query($mysqli,$qry); 

   }
   else
   {
	
	//Get all color 
	 
      $tableName="tbl_color";   
      $targetpage = "manage_color.php"; 
      $limit = 12; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
      
     $qry="SELECT * FROM tbl_color
                   ORDER BY tbl_color.color_id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$qry); 
	
    } 

	if(isset($_GET['color_id']))
	{

		Delete('tbl_color','color_id='.$_GET['color_id'].'');

		$_SESSION['msg']="12";
		header( "Location:manage_color.php");
		exit;
		
	}	

  function get_total_wallpaper($color_id)
  { 
    global $mysqli;   

    $qry_wallpaper="SELECT COUNT(*) as num FROM tbl_wallpaper WHERE FIND_IN_SET(".$color_id.", wall_colors)";
     
    $total_wallpaper = mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper));
    $total_wallpaper = $total_wallpaper['num'];
     
    return $total_wallpaper;

  }

  //Active and Deactive status
if(isset($_GET['status_deactive_id']))
{
   $data = array('color_status'  =>  '0');
  
   $edit_status=Update('tbl_color', $data, "WHERE color_id = '".$_GET['status_deactive_id']."'");
  
   $_SESSION['msg']="14";
   header( "Location:manage_color.php");
   exit;
}
if(isset($_GET['status_active_id']))
{
    $data = array('color_status'  =>  '1');
    
    $edit_status=Update('tbl_color', $data, "WHERE color_id = '".$_GET['status_active_id']."'");
    
    $_SESSION['msg']="13";   
    header( "Location:manage_color.php");
    exit;
}  
	 
?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Colors</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_color.php?add=yes">Add Color</a> </div>
              </div>
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
          <div class="col-md-12 mrg-top">
            <div class="row">
              <?php 
              $i=0;
              while($row=mysqli_fetch_array($result))
              {         
          ?>
              <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="block_wallpaper add_wall_color" style="border-radius: 10px !important;overflow: hidden;box-shadow: 2px 3px 5px #333">           
                  <div class="wall_image_title">
                    <h2><a href="#"><?php echo $row['color_name'];?> <span>(<?php if(get_total_wallpaper($row['color_id'])){ echo get_total_wallpaper($row['color_id']); }else{ echo '0';}?>)</span></a></h2>
                    <ul>                
                      <li><a href="add_color.php?color_id=<?php echo $row['color_id'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>               
                      <li><a href="?color_id=<?php echo $row['color_id'];?>" data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a></li>
                      
                      <?php if($row['color_status']!="0"){?>
                      <li><div class="row toggle_btn"><a href="manage_color.php?status_deactive_id=<?php echo $row['color_id'];?>" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="wallpaper_1" /></a></div></li>

                      <?php }else{?>
                      
                      <li><div class="row toggle_btn"><a href="manage_color.php?status_active_id=<?php echo $row['color_id'];?>" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="wallpaper_1" /></a></div></li>
                  
                      <?php }?>


                    </ul>
                  </div>
                  <span><div style="height: 130px; background: <?=$row['color_code']?>"></div></span>
                </div>
              </div>
          <?php
            
            $i++;
              }
        ?>     
               
      </div>
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
