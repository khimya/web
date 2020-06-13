<?php 

  include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
	
  error_reporting(E_ALL);
	
  if(isset($_GET['report_id']))
  {
      
     
    Delete('tbl_user_report','user_report_id='.$_GET['report_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_reports.php");
    exit;
  }
?>

<link rel="stylesheet" type="text/css" href="assets/css/stylish-tooltip.css">

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="page_title_block">
        <div class="col-md-5 col-xs-12">
          <div class="page_title">User Reports</div>
        </div>
      </div>
      <div class="clearfix"></div>
        <?php if(isset($_SESSION['msg'])){?> 
        <div class="row mrg-top">
          <div class="col-md-12"> 
            <div class="col-md-12 col-sm-12">
              <div class="alert alert-success alert-dismissible" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?>
              </div>
            </div>
          </div>
        </div>
      <?php unset($_SESSION['msg']);}?> 
      <div class="card-body mrg_bottom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#wallpaper_report" aria-controls="wallpaper_report" role="tab" data-toggle="tab">User Wallpaper Report</a></li>
            <li role="presentation"><a href="#gif_report" aria-controls="gif_report" role="tab" data-toggle="tab">User GIF Report</a></li>
            
        </ul>
      
       <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="wallpaper_report">
            <div class="section">
              <div class="section-body">
                <div class="col-md-12 mrg-top">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Wallpaper</th>
                        <th>Report</th> 
                        <th class="cat_action_list">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php 
                      $sql="SELECT report.*, wall.`image`, wall.`cat_id`, user.`name`, user.`email` FROM tbl_wallpaper wall, tbl_user_report report, tbl_users user WHERE wall.`id`=report.`parent_id` AND user.`id`=report.`user_id` AND report.`report_for`='wallpaper' AND report.`user_report_status`='1' ORDER BY report.`user_report_id` DESC";
                      $res=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
                      if(mysqli_num_rows($res) > 0)
                      {
                        $no=1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                          // print_r($row);
                    ?>
                        <tr>
                          <td><?=$no++;?></td>
                          <td><?=$row['name']?></td>
                          <td><?=$row['email']?></td>
                          <td>
                            <span class="mytooltip tooltip-effect-3">
                              <span class="tooltip-item">
                                <img src="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" style="width: 50px;height: 60px">
                              </span> 
                              <span class="tooltip-content clearfix">
                                <a href="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" target="_blank"><img src="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" /></a>
                              </span>
                            </span>
                              <!--  -->
                          </td>
                          <td><?=$row['user_message']?></td>
                          <td>
                            <a href="manage_reports.php?report_id=<?php echo $row['user_report_id'];?>" class="btn btn-danger btn_delete" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                    <?php 
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="6" class="text-center">
                            <p class="text-muted">Sorry ! no data available</p>
                          </td>
                        </tr>
                        <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="gif_report">
            <div class="section">
              <div class="section-body">
                <div class="col-md-12 mrg-top">
                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>GIF</th>
                        <th>Report</th> 
                        <th class="cat_action_list">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php 
                      $sql="SELECT report.*, gif.`image`, user.`name`, user.`email` FROM tbl_wallpaper_gif gif, tbl_user_report report, tbl_users user WHERE gif.`id`=report.`parent_id` AND user.`id`=report.`user_id` AND report.`report_for`='gif' AND report.`user_report_status`='1' ORDER BY report.`user_report_id` DESC";
                      $res=mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
                      if(mysqli_num_rows($res) > 0)
                      {
                        $no=1;
                        while($row=mysqli_fetch_assoc($res))
                        {
                    ?>
                        <tr>
                          <td><?=$no++;?></td>
                          <td><?=$row['name']?></td>
                          <td><?=$row['email']?></td>
                          <td>
                            <span class="mytooltip tooltip-effect-3">
                              <span class="tooltip-item">
                                <img src="images/animation/<?php echo $row['image'];?>" style="width: 50px;height: 60px">
                              </span> 
                              <span class="tooltip-content clearfix">
                                <a href="images/animation/<?php echo $row['image'];?>" target="_blank"><img src="images/animation/<?php echo $row['image'];?>" /></a>
                              </span>
                            </span>
                              <!--  -->
                          </td>
                          <td><?=$row['user_message']?></td>
                          <td>
                            <a href="manage_reports.php?report_id=<?php echo $row['user_report_id'];?>" class="btn btn-danger btn_delete" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                    <?php 
                        }
                      }else{
                        ?>
                        <tr>
                          <td colspan="6" class="text-center">
                            <p class="text-muted">Sorry ! no data available</p>
                          </td>
                        </tr>
                        <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>   

      </div>
    </div>
  </div>
</div>
 
        
<?php include("includes/footer.php");?>   

<script type="text/javascript">
  $('a[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>    
