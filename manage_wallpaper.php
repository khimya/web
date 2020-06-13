<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['data_search']))
   {

      $wall_qry="SELECT * FROM tbl_wallpaper
                  LEFT JOIN tbl_category ON tbl_wallpaper.`cat_id`= tbl_category.`cid` 
                  WHERE tbl_wallpaper.`wall_tags` like '%".addslashes($_POST['search_value'])."%' or tbl_category.category_name like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_wallpaper.id";
 
     $result=mysqli_query($mysqli,$wall_qry); 

   }
   else if(isset($_GET['is_download'])){
      $sql="SELECT * FROM tbl_wallpaper
            LEFT JOIN tbl_category ON tbl_wallpaper.`cat_id`= tbl_category.`cid` 
            WHERE tbl_wallpaper.`total_download` > 0
            ORDER BY tbl_wallpaper.`total_download` DESC";

      $result=mysqli_query($mysqli,$sql); 
   }
   else
   {
	
	   //Get all Wallpaper 
	
      $tableName="tbl_wallpaper";   
      $targetpage = "manage_wallpaper.php"; 
      $limit = 12; 
      
      
      if(isset($_GET['filter'])){

        $types=explode('_', $_GET['filter']);

        foreach ($types as &$value) {
            $value = "'".$value."'";
        }
        unset($value);

        $type=implode(',', $types);

        if(isset($_GET['colors'])){

          $color_id=$_GET['colors'];

          $targetpage = "manage_wallpaper.php?filter=".$_GET['filter']."&colors=".$_GET['colors']; 

          $query = "SELECT COUNT(*) as num FROM $tableName WHERE tbl_wallpaper.`wallpaper_type` IN ($type) AND FIND_IN_SET($color_id,wall_colors)";
        }
        else{
          $targetpage = "manage_wallpaper.php?filter=".$_GET['filter']; 

          $query = "SELECT COUNT(*) as num FROM $tableName WHERE tbl_wallpaper.`wallpaper_type` IN ($type)";

        }

        
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

        if(isset($_GET['colors'])){

          $color_id=$_GET['colors'];

          $wall_qry="SELECT * FROM tbl_wallpaper
                  LEFT JOIN tbl_category ON tbl_wallpaper.`cat_id`= tbl_category.`cid`  
                  WHERE tbl_wallpaper.`wallpaper_type` IN ($type) AND FIND_IN_SET($color_id,tbl_wallpaper.`wall_colors`) 
                  ORDER BY tbl_wallpaper.id DESC LIMIT $start, $limit";          
        }
        else{
          $wall_qry="SELECT * FROM tbl_wallpaper
                      LEFT JOIN tbl_category ON tbl_wallpaper.`cat_id`= tbl_category.`cid` WHERE tbl_wallpaper.`wallpaper_type` IN ($type)
                      ORDER BY tbl_wallpaper.`id` DESC LIMIT $start, $limit";  
        }
        

      }else{

        if(isset($_GET['colors'])){

          $color_id=$_GET['colors'];

          $targetpage = "manage_wallpaper.php?colors=".$_GET['colors'];

          $query = "SELECT COUNT(*) as num FROM $tableName WHERE FIND_IN_SET($color_id,tbl_wallpaper.`wall_colors`)";
        }
        else{
            $query = "SELECT COUNT(*) as num FROM $tableName";
        }

        
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

        
        if(isset($_GET['colors'])){

          $color_id=$_GET['colors'];

          $wall_qry="SELECT * FROM tbl_wallpaper
                  LEFT JOIN tbl_category ON tbl_wallpaper.`cat_id`= tbl_category.`cid` WHERE FIND_IN_SET($color_id,tbl_wallpaper.`wall_colors`) 
                  ORDER BY tbl_wallpaper.id DESC LIMIT $start, $limit";          
        }else{
          $wall_qry="SELECT * FROM tbl_wallpaper
                  LEFT JOIN tbl_category ON tbl_wallpaper.cat_id= tbl_category.cid 
                  ORDER BY tbl_wallpaper.id DESC LIMIT $start, $limit";

        }

        
      }
 
      $result=mysqli_query($mysqli,$wall_qry); 

      foreach ($types as &$value) {
          $value = trim($value,"'");
      }
      unset($value);
   }
	 

  if(isset($_POST['delete_rec']))
  {

    $checkbox = $_POST['wall_ids'];
    
    for($i=0;$i<count($checkbox);$i++){
      
      $del_id = $checkbox[$i]; 
     
      $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_wallpaper WHERE id=\''.$del_id.'\'');
      $img_res_row=mysqli_fetch_assoc($img_res);

      if($img_res_row['image']!="")
        {
          unlink('categories/'.$img_res_row['cat_id'].'/'.$img_res_row['image']);
         }
   
      Delete('tbl_wallpaper','id='.$del_id.'');
 
    }

    $_SESSION['msg']="12";
    header( "Location:manage_wallpaper.php");
    exit;
  }

  //Active and Deactive featured
  if(isset($_GET['featured_deactive_id']))
  {
    $data = array('featured'  =>  '0');
    
    $edit_status=Update('tbl_wallpaper', $data, "WHERE id = '".$_GET['featured_deactive_id']."'");
    
     $_SESSION['msg']="14";
     header( "Location:manage_wallpaper.php");
     exit;
  }
  if(isset($_GET['featured_active_id']))
  {
    $data = array('featured'  =>  '1');
    
    $edit_status=Update('tbl_wallpaper', $data, "WHERE id = '".$_GET['featured_active_id']."'");
    
    $_SESSION['msg']="13";
     header( "Location:manage_wallpaper.php");
     exit;
  }   

  
?>

<style type="text/css">

  .filter_color{
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
    font-family: FontAwesome;
    
  }
  .filter_color option span{
    color: red !important;
    background: red
  }

  ul.filter_color { 
    font-family: 'FontAwesome';
    height: 36px;
    width: 150px;
    z-index: 9999;
    text-align: left;
    cursor: pointer;
  }
  ul.filter_color li span{
	  font-family: "FontAwesome";
  }
  ul.filter_color li{
	  font-family: "Poppins", sans-serif;
	  border-radius:6px;
  }
  ul.filter_color li:first-child{
    border:1px solid #999;
  }
  ul.filter_color li:last-child{
    border-bottom:1px solid #999;
  }
  ul.filter_color li { padding: 7px 10px; z-index: 2;border-left: 1px solid #ccc;border-right: 1px solid #ccc;}
  ul.filter_color li:not(.init) { border-radius:0px;float: left; border-bottom:1px solid #dfe6e8; width: 150px; display: none; background: #f9f9f9; }
  ul.filter_color li:not(.init):hover, ul li.selected:not(.init) { border-radius:0px;background: #e91e63;color:#fff;}

</style>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="add_btn_primary pull-right"> <a href="add_wallpaper.php">Add Wallpaper</a> </div>
        <div class="card mrg_bottom">

          <div class="page_title_block">

            <div class="col-md-3 col-xs-12">
              <div class="page_title">Manage Wallpaper</div>
            </div>
            <div class="col-md-9 col-xs-12">
              <div class="search_list">
                <div class="search_block search_item">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required value="<?php if(isset($_POST['search_value'])){ echo $_POST['search_value']; } ?>">
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                
              </div>
            </div>            
            <div class="col-md-8">
              <h4 style="float: left;">Filter: |</h4>
              <div style="float: left;margin-left: 10px">

                <div class="checkbox">
                  <input type="checkbox" name="filter_type[]" id="portrait_check" value="Portrait" class="filter_type" <?php if(isset($_GET['filter']) && in_array('portrait',$types)){ echo 'checked';} ?>>
                  <label for="portrait_check">
                    Portrait
                  </label>
                </div> 
              </div>
              <div style="float: left;margin-left: 10px">
                <div class="checkbox">
                  <input type="checkbox" name="filter_type[]" id="landscape_check" value="Landscape" class="filter_type" <?php if(isset($_GET['filter']) && in_array('landscape',$types)){ echo 'checked';} ?>>
                  <label for="landscape_check">
                    Landscape
                  </label>
                </div> 
              </div>
              <div style="float: left;margin-left: 10px">
                <div class="checkbox">
                  <input type="checkbox" name="filter_type[]" id="square_check" value="Square" class="filter_type" <?php if(isset($_GET['filter']) && in_array('square',$types)){ echo 'checked';} ?>>
                  <label for="square_check">
                    Square
                  </label>
                </div> 
              </div>
              <div class="search_list" style="padding: 0px 0px 5px;float: left;margin-left: 10px">
                <!-- <select name="filter_color" class="form-control filter_color" required style="padding: 5px 10px;height: 35px;">
                  <option value="">Color Filter</option>
                  <?php 
                    $sql="SELECT * FROM tbl_color WHERE color_status='1'";
                    $res=mysqli_query($mysqli,$sql);
                    while($data=mysqli_fetch_assoc($res))
                    {
                  ?>
                  <option value="<?=$data['color_id']?>" data-color="<?=$data['color_code']?>" <?php if(isset($_GET['colors']) && $_GET['colors']==$data['color_id']){ echo 'selected';} ?>><span style="color:<?=$data['color_code']?>">&#xf0c8;</span> <?=$data['color_name']?></option>
                  <?php } ?>
                </select> -->

                <ul class="list-unstyled filter_color">
                  <li class="init">Color Filter</li>
                  <?php 
                    $sql="SELECT * FROM tbl_color WHERE color_status='1'";
                    $res=mysqli_query($mysqli,$sql);
                    while($data=mysqli_fetch_assoc($res))
                    {
                  ?>
                  <li data-value="<?=$data['color_id']?>"><span style="color:<?=$data['color_code']?>">&#xf0c8;</span>&nbsp;&nbsp;<?=$data['color_name']?></li>
                  <?php } ?>
                </ul>

              </div>
            </div>
			      <div class="col-md-4 col-xs-12 select_item_block">
              <form method="post" action="">
                <div class="search_list">
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
                    <h2><?php echo $row['category_name'];?></h2>
                     <?php if($row['featured']!="0"){?>
                         <a href="" data-id="<?php echo $row['id'];?>" class="btn_featured" data-action="deactive" data-toggle="tooltip" data-tooltip="Added to Slider" style="width: 30px;height: 30px"><div style="color:green;"><i class="fa fa-check-circle"></i></div></a> 
                      <?php }else{?>
                         <a href="" class="btn_featured" data-action="active" data-id="<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Set to Slider" style="width: 30px;height: 30px"><i class="fa fa-circle"></i></a> 
                      <?php }?>
                      
                      <a href="edit_wallpaper.php?wallpaper_id=<?php echo $row['id'];?>" target="_blank" data-toggle="tooltip" data-tooltip="Edit" style="margin-right: 5px;width: 30px;height: 30px"><i class="fa fa-edit"></i></a>

                      
                      <div class="checkbox" style="float: right;">
                        <input type="checkbox" name="wall_ids[]" id="checkbox<?php echo $i;?>" value="<?php echo $row['id']; ?>">
                        <label for="checkbox<?php echo $i;?>">
                        </label>
                      </div>      
                  </div>
                  <div class="wall_image_title">
                    <div class="wall_category_block" style="padding-left: 10px">
                    
                      <?php
                          $sql="SELECT * FROM tbl_color WHERE color_id IN ($row[wall_colors]) ORDER BY color_id ASC";
                          $res=mysqli_query($mysqli,$sql);
                          while($colors=mysqli_fetch_assoc($res)){
                            echo '<div style="width: 30px;height: 30px;background: '.$colors['color_code'].';border-radius: 50%;float: left;margin: 5px 3px 5px 3px;text-align:center" data-toggle="tooltip" data-tooltip="'.$colors['color_name'].'"></div>';
                          }
                      ?>

                    </div>

                    <div class="clearfix"></div>
                    <br/>
                    <h2 style="margin-top: 30px">Wallpaper Tags</h2>
                    <p><?php echo $row['wall_tags'];?></p>
                    <ul>
                      <?php 
                        if($row['wallpaper_type']=='Landscape'){
                          ?>
                          <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Landscape"><i class="fa fa-mobile" style="transform:rotate(90deg);"></i></a>
                          </li>
                          <?php
                        }
                        else if($row['wallpaper_type']=='Portrait'){
                          ?>
                          <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Portrait"><i class="fa fa-mobile"></i></a>
                          </li>
                          <?php
                        }
                        else if($row['wallpaper_type']=='Square'){
                          ?>
                          <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="Square"><i class="fa fa-square-o"></i></a>
                          </li>
                          <?php
                        }

                      ?>

                      <!--  <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_views'];?> Views"><i class="fa fa-eye"></i></a></li> -->

                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_views'];?> Views"><i class="fa fa-eye"></i></a></li>            

                      <li><a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['rate_avg'];?> Rating"><i class="fa fa-star"></i></a></li>

                      <li>
                        <a href="javascript:void(0)" data-toggle="tooltip" data-tooltip="<?php echo $row['total_download'];?> Download"><i class="fa fa-download"></i></a>
                      </li>
                       
                       <li><a href="" class="btn_del" data- data-id="<?php echo $row['id'];?>" data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a></li>
                    </ul>
                  </div>
                  <span><img src="categories/<?php echo $row['cat_id'];?>/<?php echo $row['image'];?>" style="height: 350px"/></span>
                </div>
              </div>
          <?php
            
            $i++;
              }
        ?>     
         
       </form>
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

<script type="text/javascript">

  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null) {
         return '';
      }
      return decodeURI(results[1]) || 0;
  }

  $(document).ready(function(e){
    
    $(".filter_type").on("click",function(e){

      var _filter_type=$.urlParam('filter');
      var _filter_color=$.urlParam('colors');

      var type='';

      $('input[name="filter_type[]"]').map(function () {
        if($(this). prop("checked") == true){
          type+=$(this).val()+"_";
        }
      }); 
      var url_append=type.slice(0, -1);

      if(_filter_color=='' && (_filter_type=='' || url_append!='')){
        window.location.href="manage_wallpaper.php?filter="+url_append.toLowerCase();
      }
      else if((_filter_type=='' || url_append!='') && _filter_color!=''){
        window.location.href="manage_wallpaper.php?filter="+url_append.toLowerCase()+"&colors="+_filter_color; 
      }
      else if(url_append=='' && _filter_color!=''){
        window.location.href="manage_wallpaper.php?colors="+_filter_color; 
      }
      else if((_filter_type!='' || url_append=='') && _filter_color==''){
        window.location.href="manage_wallpaper.php";
      }
      
      
    });

    $("select[name='filter_color']").on("change",function(e){

        var _filter=$.urlParam('filter');

        var color=$(this).val();
        if(color!=''){ 

          if(_filter!=''){
            window.location.href="manage_wallpaper.php?filter="+_filter+"&colors="+color;
          }else{
            window.location.href="manage_wallpaper.php?colors="+color;
          }

        }
        else{

          if(_filter!=''){
            window.location.href="manage_wallpaper.php?filter="+_filter
          }else{
            window.location.href="manage_wallpaper.php";
          }
          
        }
    });

  });

</script>

<script type="text/javascript">



  $("ul.filter_color").on("click", ".init", function() {
    $(this).closest("ul").children('li:not(.init)').toggle();
  });

  var _filter_color=$.urlParam('colors');
  var allOptions = $("ul.filter_color").children('li:not(.init)');
  
  if(_filter_color!=''){

    var element=$("ul.filter_color li").filter('[data-value="'+_filter_color+'"]');
    $("ul.filter_color li").filter('[data-value="'+_filter_color+'"]').addClass('selected');
    $("ul.filter_color").children('.init').html(element.html());
    $("ul.filter_color li:first").after('<li class="clr_filter" data-value="clr">Clear Filter</li>');  
  }

  


  $("ul.filter_color").on("click", "li:not(.init)", function() {

      var _filter=$.urlParam('filter');

      var color=$(this).data("value");

      allOptions.removeClass('selected');
      $("ul.filter_color .clr_filter").remove();
      $(this).addClass('selected');
      $("ul.filter_color").children('.init').html($(this).html());
      $("ul.filter_color").children('.init').html($(this).html());
      $("ul.filter_color li:first").after('<li class="clr_filter" data-value="clr">Clear Filter</li>');
      allOptions.toggle();

      if(color!='' && color!='clr'){ 

        if(_filter!=''){
          window.location.href="manage_wallpaper.php?filter="+_filter+"&colors="+color;
        }else{
          window.location.href="manage_wallpaper.php?colors="+color;
        }

      }
      else{

        if(_filter!=''){
          window.location.href="manage_wallpaper.php?filter="+_filter
        }else{
          window.location.href="manage_wallpaper.php";
        }
        
      }
            
  });
</script>

<!-- Active/Deactive and Delete Wallpaper -->

<script type="text/javascript">
  $(".btn_del").on("click",function(e){
    e.preventDefault();
    if(confirm("Are you sure you want to delete this wallpaper ?")){

        $.ajax({
          type:'post',
          url:'processData.php',
          dataType:'json',
          data:{wallpaper_id:$(this).data("id"),'action':'delete_wallpaper'},
          success:function(res){
            if(res.status=='1')
              location.reload();
          }
        });
    }
    

  });

  $(".btn_featured").on("click",function(e){
    e.preventDefault();
    var _for=$(this).data("action");
    var _id=$(this).data("id");

    $.ajax({
      type:'post',
      url:'processData.php',
      dataType:'json',
      data:{wallpaper_id:_id,for_action:_for,'action':'featured_wallpaper'},
      success:function(res){
        if(res.status=='1')
          location.reload();
        }
    });

  });

</script>