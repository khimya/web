<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	 if(isset($_POST['data_search']))
   {

      $gif_qry="SELECT * FROM tbl_wallpaper_gif
                   WHERE tbl_wallpaper_gif.`gif_tags` LIKE '%".addslashes($_POST['search_value'])."%' ORDER BY tbl_wallpaper_gif.`id`";
 
     $result=mysqli_query($mysqli,$gif_qry); 

   }
   else if(isset($_GET['is_download'])){
      $sql="SELECT * FROM tbl_wallpaper_gif
            WHERE tbl_wallpaper_gif.`total_download` > 0
            ORDER BY tbl_wallpaper_gif.`total_download` DESC";

      $result=mysqli_query($mysqli,$sql); 
   }
   else
   {
	   //Get all gif 
	
      $tableName="tbl_wallpaper_gif";   
      $targetpage = "manage_wallpaper_animation.php"; 
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
      
     $gif_qry="SELECT * FROM tbl_wallpaper_gif                 
                  ORDER BY tbl_wallpaper_gif.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$gif_qry); 
	 }

  if(isset($_GET['wallpaper_id']))
  { 

    $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_wallpaper_gif WHERE id=\''.$_GET['wallpaper_id'].'\'');
    $img_res_row=mysqli_fetch_assoc($img_res);

    if($img_res_row['image']!="")
      {
        unlink('images/animation/'.$img_res_row['image']);
       }
 
    Delete('tbl_wallpaper_gif','id='.$_GET['wallpaper_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_wallpaper_animation.php");
    exit;
    
  }  

  if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['gif_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_wallpaper_gif WHERE id=\''.$del_id.'\'');
      $img_res_row=mysqli_fetch_assoc($img_res);

      if($img_res_row['image']!="")
        {
          unlink('images/animation/'.$img_res_row['image']);
         }
   
      Delete('tbl_wallpaper_gif','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:manage_wallpaper_animation.php");
    exit;
  }

?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage GIF</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div> 
                <div class="add_btn_primary"> <a href="add_wallpaper_animation.php">Add GIF</a> </div>
              </div>
            </div>
            <div class="col-md-5 col-xs-12" style="margin-bottom: -10px;margin-top: -50px;">
              <form method="post" action="">
              <div class="page_title">
                  <div class="checkbox">
                    <input type="checkbox" name="checkall" id="checkall" value="">
                    <label for="checkall">Select All</label>
                    <button type="submit" class="btn btn-danger btn_delete" name="delete_rec" value="delete_wall" onclick="return confirm('Are you sure you want to delete this items?');">Delete</button>
                  </div> 

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
                <div class="block_wallpaper">
                  <div class="wall_category_block">                    
                        <div class="checkbox" style="float: right;">
                          <input type="checkbox" name="gif_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $row['id']; ?>">
                          <label for="checkbox<?php echo $i;?>">
                          </label>
                        </div>      
                  </div>

                  <div class="wall_image_title">
                    <ul>
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_views'];?> Views"><i class="fa fa-eye"></i></a></li>                      
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_download'];?> Download"><i class="fa fa-download"></i></a></li>
                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['rate_avg'];?> Rating"><i class="fa fa-star"></i></a></li>

                      <li><a href="edit_wallpaper_animation.php?wallpaper_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>
                      <li><a href="?wallpaper_id=<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Delete" onclick="return confirm('Are you sure you want to delete this GIF?');"><i class="fa fa-trash"></i></a></li>
                    </ul>
                  </div>
                  <div><img src="images/animation/<?php echo $row['image'];?>" /></div>
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

<script>
  $("#checkall").click(function () {
    $("input:checkbox[name='gif_ids[]']").not(this).prop('checked', this.checked);
  });
</script> 