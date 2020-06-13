<?php 

// $stylesheets=array('assets/bootstrap-tag/bootstrap-tagsinput.css','path','path');

include("includes/header.php");

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
$total_category = $total_category['num'];

$qry_wallpaper="SELECT COUNT(*) as num FROM tbl_wallpaper";
$total_wallpaper = mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper));
$total_wallpaper = $total_wallpaper['num'];

$qry_wallpaper_gif="SELECT COUNT(*) as num FROM tbl_wallpaper_gif";
$total_wallpaper_gif = mysqli_fetch_array(mysqli_query($mysqli,$qry_wallpaper_gif));
$total_wallpaper_gif = $total_wallpaper_gif['num'];


$qry_wall_dwn="SELECT SUM(total_download) as num FROM tbl_wallpaper";
$total_wall_download= mysqli_fetch_array(mysqli_query($mysqli,$qry_wall_dwn));
$total_wall_download = $total_wall_download['num'];

$qry_gif_dwn="SELECT SUM(total_download) as num FROM tbl_wallpaper_gif";
$total_gif_download= mysqli_fetch_array(mysqli_query($mysqli,$qry_gif_dwn));
$total_gif_download = $total_gif_download['num'];

?>       


         
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_category.php" class="card card-banner card-green-light">
        <div class="card-body"> <i class="icon fa fa-sitemap fa-4x"></i>
          <div class="content">
            <div class="title">Categories</div>
            <div class="value"><span class="sign"></span><?php echo $total_category;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper.php" class="card card-banner card-yellow-light">
        <div class="card-body"> <i class="icon fa fa-image fa-4x"></i>
          <div class="content">
            <div class="title">Wallpaper</div>
            <div class="value"><span class="sign"></span><?php echo $total_wallpaper;?></div>
          </div>
        </div>
        </a> 
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"> <a href="manage_wallpaper_animation.php" class="card card-banner card-blue-light">
        <div class="card-body"> <i class="icon fa fa-leaf fa-4x"></i>
          <div class="content">
            <div class="title">GIF</div>
            <div class="value"><span class="sign"></span><?php echo $total_wallpaper_gif;?></div>
          </div>
        </div>
        </a> </div>        
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mr_bot60"> 
          <a href="manage_wallpaper.php?is_download" class="card card-banner card-pink-light">
        <div class="card-body"> <i class="icon fa fa-download fa-4x"></i>
          <div class="content">
            <div class="title">Wallpaper Download</div>
            <div class="value"><span class="sign"></span><?php echo $total_wall_download;?></div>
          </div>
        </div>
        </a> 
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mr_bot60"> 
          <a href="manage_wallpaper_animation.php?is_download" class="card card-banner card-orange-light">
        <div class="card-body"> <i class="icon fa fa-download fa-4x"></i>
          <div class="content">
            <div class="title">GIF Download</div>
            <div class="value"><span class="sign"></span><?php echo $total_gif_download;?></div>
          </div>
        </div>
        </a> 
    </div>
     
</div>

        
<?php include("includes/footer.php");?>       
