<?php 
  include("includes/header.php");
  require("includes/function.php");
  require("language/language.php");
  
  $qry="SELECT * FROM tbl_settings where id='1'";
  $result=mysqli_query($mysqli,$qry);
  $settings_row=mysqli_fetch_assoc($result);

  $type=explode(',', $settings_row['item_type']);

  if(isset($_POST['submit']))
  {

    $img_res=mysqli_query($mysqli,"SELECT * FROM tbl_settings WHERE id='1'");
    $img_row=mysqli_fetch_assoc($img_res);
    

    if($_FILES['app_logo']['name']!="")
    {        

            unlink('images/'.$img_row['app_logo']);   

            $app_logo=$_FILES['app_logo']['name'];
            $pic1=$_FILES['app_logo']['tmp_name'];

            $tpath1='images/'.$app_logo;      
            copy($pic1,$tpath1);


              $data = array(
              'app_name'  =>  $_POST['app_name'],
              'app_logo'  =>  $app_logo,  
              'app_description'  => addslashes($_POST['app_description']),
              'app_version'  =>  $_POST['app_version'],
              'app_author'  =>  $_POST['app_author'],
              'app_contact'  =>  $_POST['app_contact'],
              'app_email'  =>  $_POST['app_email'],   
              'app_website'  =>  $_POST['app_website'],
              'app_privacy_policy'  =>  $_POST['app_privacy_policy'],
              'app_developed_by'  =>  $_POST['app_developed_by']                     

              );

    }
    else
    {
  
          $data = array(
              'app_name'  =>  $_POST['app_name'],
              'app_description'  => addslashes($_POST['app_description']),
              'app_version'  =>  $_POST['app_version'],
              'app_author'  =>  $_POST['app_author'],
              'app_contact'  =>  $_POST['app_contact'],
              'app_email'  =>  $_POST['app_email'],   
              'app_website'  =>  $_POST['app_website'],
              'app_developed_by'  =>  $_POST['app_developed_by']
          );

    } 

    $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

    $_SESSION['msg']="11";
    header( "Location:settings.php");
    exit;   
  }

  if(isset($_POST['verify_purchase_submit']))
  {

      $envato_buyer= verify_envato_purchase_code(trim($_POST['envato_purchase_code']));

      if($_POST['envato_buyer_name']!='' AND $envato_buyer->buyer==$_POST['envato_buyer_name'] AND $envato_buyer->item->id=='7054658')
      {
            $data = array(
                  'envato_buyer_name' => $_POST['envato_buyer_name'],
                  'envato_purchase_code' => $_POST['envato_purchase_code'],
                  'envato_buyer_email' => $_POST['envato_buyer_email'],
                  'envato_purchased_status' => 1,
                  'package_name' => $_POST['package_name'],
                  'ios_bundle_identifier' => $_POST['ios_bundle_identifier']
                    );
      
            $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");

            
            $config_file_default    = "includes/app.default";
            $config_file_name       = "api.php";    

            $config_file_path       = $config_file_name;

            $config_file = file_get_contents($config_file_default);
            //$config_file = str_replace("NEWS_APP", 'NEWS_APP_DEMO', $config_file);

            $f = @fopen($config_file_path, "w+");
            
            if(@fwrite($f, $config_file) > 0){

              echo "done";

            }

            $protocol = strtolower( substr( $_SERVER[ 'SERVER_PROTOCOL' ], 0, 5 ) ) == 'https' ? 'https' : 'http'; 

            $admin_url = $protocol.'://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';

            verify_data_on_server($envato_buyer->item->id,$envato_buyer->buyer,$_POST['envato_purchase_code'],1,$admin_url,$_POST['package_name'],$_POST['envato_buyer_email'],$_POST['ios_bundle_identifier']);

            $_SESSION['msg']="19";
            header( "Location:settings.php");
            exit;

      }
      else
      {
          $data = array(
                  'envato_buyer_name' => $_POST['envato_buyer_name'],
                  'envato_purchase_code' => $_POST['envato_purchase_code'],
                  'envato_buyer_email' => $_POST['envato_buyer_email'],
                  'envato_purchased_status' => 0,
                  'package_name' => $_POST['package_name'],
                  'ios_bundle_identifier' => $_POST['ios_bundle_identifier']
                );


          $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
          $_SESSION['msg']="18";
          header( "Location:settings.php");
          exit;
      }

  }

  if(isset($_POST['gif_submit']))
  {

        $data = array(
                'gif_on_off' => $_POST['gif_on_off']
                   );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
  
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
 
  }

  if(isset($_POST['item_submit']))
  {
      $item_type=implode(',', $_POST['item_type']);

      if($item_type!=''){
        $data = array(
              'item_type' => $item_type
                 ); 
      }
      else{
        $data = array(
              'item_type' => 'Portrait'
                 ); 
        
      }

      
  
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
  
      $_SESSION['msg']="11";
      header( "Location:settings.php");
      exit;
 
  }

  if(isset($_POST['admob_submit']))
  {

        $data = array(
                'publisher_id'  =>  $_POST['publisher_id'],
                'interstital_ad'  =>  $_POST['interstital_ad'],
                'interstital_ad_id'  =>  $_POST['interstital_ad_id'],
                'interstital_ad_click'  =>  $_POST['interstital_ad_click'],
                'banner_ad'  =>  $_POST['banner_ad'],
                'banner_ad_id'  =>  $_POST['banner_ad_id'],
                'facebook_interstital_ad'  =>  $_POST['facebook_interstital_ad'],
                'facebook_interstital_ad_id'  =>  $_POST['facebook_interstital_ad_id'],
                'facebook_interstital_ad_click'  =>  $_POST['facebook_interstital_ad_click'],
                'facebook_banner_ad'  =>  $_POST['facebook_banner_ad'],
                'facebook_banner_ad_id'  =>  $_POST['facebook_banner_ad_id'],
                'facebook_native_ad'  =>  $_POST['facebook_native_ad'],
                'facebook_native_ad_id'  =>  $_POST['facebook_native_ad_id'],
                'facebook_native_ad_click'  =>  $_POST['facebook_native_ad_click'],
                'admob_nathive_ad'  =>  $_POST['admob_nathive_ad'],
                'admob_native_ad_id'  =>  $_POST['admob_native_ad_id'],
                'admob_native_ad_click'  =>  $_POST['admob_native_ad_click'],
                'publisher_id_ios'  =>  $_POST['publisher_id_ios'],
                'interstital_ad_ios'  =>  $_POST['interstital_ad_ios'],
                'interstital_ad_id_ios'  =>  $_POST['interstital_ad_id_ios'],
                'interstital_ad_click_ios'  =>  $_POST['interstital_ad_click_ios'],
                'banner_ad_ios'  =>  $_POST['banner_ad_ios'],
                'banner_ad_id_ios'  =>  $_POST['banner_ad_id_ios']
                
      );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
  
      
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
 
 
  }

  if(isset($_POST['notification_submit']))
  {

        $data = array(
                'onesignal_app_id' => $_POST['onesignal_app_id'],
                'onesignal_rest_key' => $_POST['onesignal_rest_key'],
                  );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
  
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
 
  }

  if(isset($_POST['api_submit']))
  {
      $sql="SHOW COLUMNS FROM tbl_settings LIKE 'home_limit'";
      $res=mysqli_query($mysqli,$sql);
      $exists = (mysqli_num_rows($res))?TRUE:FALSE;
      if(!$exists){
          mysqli_query($mysqli,"ALTER TABLE tbl_settings CHANGE home_portrait_limit home_limit INT(3) NOT NULL DEFAULT '10'");
      }

      $data = array(                
        'home_limit'  =>  $_POST['home_limit'],
        'home_landscape_limit'  =>  $_POST['home_landscape_limit'],
        'home_square_limit'  =>  $_POST['home_square_limit'],
        'api_latest_limit'  =>  $_POST['api_latest_limit'],
        'api_cat_order_by'  =>  $_POST['api_cat_order_by'],
        'api_cat_post_order_by'  =>  $_POST['api_cat_post_order_by'],
        'api_gif_post_order_by'  =>  $_POST['api_gif_post_order_by']
      );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
 
 
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
  
 
  }

  if(isset($_POST['app_pri_poly']))
  {

        $data = array(
                'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy']) 
                  );

    
      $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
 

      

        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;

      
  }

?>

<style type="text/css">
  /* The switch - the box around the slider */
  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
  }

  /* Hide default HTML checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 5px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }

  input:checked + .slider {
    background-color: #e91e63;
  }

  input:focus + .slider {
    box-shadow: 0 0 1px #e91e63;
  }

  input:checked + .slider:before {
    -webkit-transform: translateX(20px);
    -ms-transform: translateX(20px);
    transform: translateX(20px);
  }

  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }

  .slider.round:before {
    border-radius: 50%;
  }
</style>
  
   <div class="row">
      <div class="col-md-12">
        <div class="card">
      <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Settings</div>
            </div>
          </div>
          <div class="clearfix"></div>
          <?php if(isset($_SESSION['msg'])){?> 
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                
              </div>
            </div>
          </div>
          <?php unset($_SESSION['msg']);}?> 
          <div class="card-body mrg_bottom">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#verify_purchase" aria-controls="verify_purchase" role="tab" data-toggle="tab">Verify Purchase</a></li>
                <li role="presentation"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App 
                Settings</a></li>
                <li role="presentation"><a href="#type_settings" aria-controls="type_settings" role="tab" data-toggle="tab">Type Settings</a></li>
                <li role="presentation"><a href="#gif_settings" aria-controls="gif_settings" role="tab" data-toggle="tab">GIF Settings</a></li>
                <li role="presentation"><a href="#admob_settings" aria-controls="admob_settings" role="tab" data-toggle="tab">Ad Settings</a></li>
                <li role="presentation"><a href="#notification_settings" aria-controls="notification_settings" role="tab" data-toggle="tab">Notification Settings</a></li>
                 <li role="presentation"><a href="#api_settings" aria-controls="api_settings" role="tab" data-toggle="tab">API Settings</a></li>
                <li role="presentation"><a href="#api_privacy_policy" aria-controls="api_privacy_policy" role="tab" data-toggle="tab">Privacy Policy</a></li>
                
            </ul>
          
           <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="verify_purchase">
                <form action="" name="verify_purchase" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                
                <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Envato Username :-</label>
                    <div class="col-md-6">
                      <input type="text" name="envato_buyer_name" id="envato_buyer_name" value="<?php echo $settings_row['envato_buyer_name'];?>" class="form-control" placeholder="viaviwebtech">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Envato Purchase Code :-

                      <p class="control-label-help">(<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is My Purchase Code?</a>)</p>
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="envato_purchase_code" id="envato_purchase_code" value="<?php echo $settings_row['envato_purchase_code'];?>" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx-xxxx">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Envato Buyer Email :-
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="envato_buyer_email" id="envato_buyer_email" value="<?php echo $settings_row['envato_buyer_email'];?>" class="form-control" placeholder="info@viaviweb.in">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Android Package Name :-
                      <p class="control-label-help">(More info in Android Doc)</p>
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="package_name" id="package_name" value="<?php echo $settings_row['package_name'];?>" class="form-control" placeholder="com.example.myapp">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">iOS Bundle Identifier :-
                      <p class="control-label-help">(More info in iOS Doc)</p>
                    </label>
                    <div class="col-md-6">
                      <input type="text" name="ios_bundle_identifier" id="ios_bundle_identifier" value="<?php echo $settings_row['ios_bundle_identifier'];?>" class="form-control" placeholder="com.example.myapp.ios">
                    </div>
                  </div>
                  <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="verify_purchase_submit" class="btn btn-primary">Save</button>
                  </div>
                  </div>
                </div>
                </div>
              </form>
              </div> 
              <div role="tabpanel" class="tab-pane" id="app_settings">   
                <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
                  
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Logo :-</label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="app_logo" id="fileupload">
                         
                          <?php if($settings_row['app_logo']!="") {?>
                            <div class="fileupload_img"><img type="image" src="images/<?php echo $settings_row['app_logo'];?>" alt="image" /></div>
                          <?php } else {?>
                            <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="image" /></div>
                          <?php }?>
                        
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Description :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_description" id="app_description" class="form-control"><?php echo stripslashes($settings_row['app_description']);?></textarea>

                      <script>CKEDITOR.replace( 'app_description' );</script>
                    </div>
                  </div>
                  <div class="form-group">&nbsp;</div>                 
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Version :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Author :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Contact :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                    </div>
                  </div>     
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                    </div>
                  </div>                 
                   <div class="form-group">
                    <label class="col-md-3 control-label">Website :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                    </div>
                  </div>                   
                  <div class="form-group">
                    <label class="col-md-3 control-label">Developed By :-</label>
                    <div class="col-md-6">
                      <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
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

              <div role="tabpanel" class="tab-pane" id="type_settings">
              <form action="" name="type_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                
                <div class="section">
                  <div class="section-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Portrait:-</label>
                        <div class="col-md-5">
                         <label class="switch">
                            <input type="checkbox" name="item_type[]" value="Portrait" <?php if(in_array('Portrait',$type)){ echo 'checked'; } ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Landscape:-</label>
                        <div class="col-md-5">
                         <label class="switch">
                            <input type="checkbox" name="item_type[]" value="Landscape" <?php if(in_array('Landscape',$type)){ echo 'checked'; } ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Square:-</label>
                        <div class="col-md-5">
                         <label class="switch">
                            <input type="checkbox" name="item_type[]" value="Square" <?php if(in_array('Square',$type)){ echo 'checked'; } ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                    </div>
                    <br/>     
                    <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="item_submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>

              <div role="tabpanel" class="tab-pane" id="gif_settings">
              <form action="" name="gif_settings" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                
                <div class="section">
                <div class="section-body">
                      <div class="form-group">
                      <label class="col-md-3 control-label">GIF Show:-</label>
                      <div class="col-md-5">
                       <select name="gif_on_off" id="gif_on_off" class="select2">
                                <option value="true" <?php if($settings_row['gif_on_off']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['gif_on_off']=='false'){?>selected<?php }?>>False</option>
                    
                        </select>
                      </div>
                    </div>
                       
                  <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="gif_submit" class="btn btn-primary">Save</button>
                  </div>
                  </div>
                </div>
                </div>
              </form>
            </div>
            
              <div role="tabpanel" class="tab-pane" id="admob_settings">   
                <form action="" name="admob_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                  
            <div class="section">
          <div class="section-body">            
            <div class="row">
            <div class="form-group">
              <div class="col-md-6">                
              <div class="col-md-12">
                <div class="admob_title">Android</div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Publisher ID :-</label>
                  <div class="col-md-9">
                    <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id'];?>" class="form-control">
                  </div>
                  <div style="height:60px;display:inline-block;position:relative"></div>
                </div>
                <div class="banner_ads_block">
                  <div class="banner_ad_item">
                    <label class="control-label">Admob Banner Ads:-</label>                                  
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Banner Ad:-</label>
                      <div class="col-md-9">
                       <select name="banner_ad" id="banner_ad" class="select2">
                                <option value="true" <?php if($settings_row['banner_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['banner_ad']=='false'){?>selected<?php }?>>False</option>
                    
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Banner ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['banner_ad_id'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                <div class="interstital_ads_block">
                  <div class="interstital_ad_item">
                    <label class="control-label">Admob Interstital Ads :-</label>             
                  </div>  
                  <div class="col-md-12"> 
                    <div class="form-group">
                      <label class="col-md-3 control-label">Interstital :-</label>
                      <div class="col-md-9">
                        <select name="interstital_ad" id="interstital_ad" class="select2">
                                <option value="true" <?php if($settings_row['interstital_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['interstital_ad']=='false'){?>selected<?php }?>>False</option>
                    
                            </select> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Interstital ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['interstital_ad_id'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Interstital Clicks :-</label>
                      <div class="col-md-9">
                      <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['interstital_ad_click'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>                  
               
              </div>

                
              <div class="col-md-12">
                <div class="interstital_ads_block">
                  <div class="interstital_ad_item">
                    <label class="control-label">Admob Native Ads :-</label>             
                  </div>  
                  <div class="col-md-12"> 
                    <div class="form-group">
                      <label class="col-md-3 control-label">Admob Native Ad:-</label>
                      <div class="col-md-9">
                        <select name="admob_nathive_ad" id="admob_nathive_ad" class="select2">
                                <option value="true" <?php if($settings_row['admob_nathive_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['admob_nathive_ad']=='false'){?>selected<?php }?>>False</option>
                    
                            </select> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Admob Native ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="admob_native_ad_id" id="admob_native_ad_id" value="<?php echo $settings_row['admob_native_ad_id'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Admob Native Position :-</label>
                      <div class="col-md-9">
                      <input type="text" name="admob_native_ad_click" id="admob_native_ad_click" value="<?php echo $settings_row['admob_native_ad_click'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>                  
               
              </div>
              <div class="banner_ads_block">
                  <div class="banner_ad_item">
                    <label class="control-label">Facebook Banner Ads :-</label>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Facebook Banner Ad:-</label>
                      <div class="col-md-9">
                       <select name="facebook_banner_ad" id="facebook_banner_ad" class="select2">
                                <option value="true" <?php if($settings_row['facebook_banner_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['facebook_banner_ad']=='false'){?>selected<?php }?>>False</option>
                    
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Facebook Banner ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="facebook_banner_ad_id" id="facebook_banner_ad_id" value="<?php echo $settings_row['facebook_banner_ad_id'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                <div class="interstital_ads_block">
                  <div class="interstital_ad_item">
                    <label class="control-label">Facebook Interstital Ads :-</label>             
                  </div>  
                  <div class="col-md-12"> 
                    <div class="form-group">
                      <label class="col-md-3 control-label">Facebook Interstital :-</label>
                      <div class="col-md-9">
                        <select name="facebook_interstital_ad" id="facebook_interstital_ad" class="select2">
                                <option value="true" <?php if($settings_row['facebook_interstital_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['facebook_interstital_ad']=='false'){?>selected<?php }?>>False</option>
                    
                            </select> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Facebook Interstital ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="facebook_interstital_ad_id" id="facebook_interstital_ad_id" value="<?php echo $settings_row['facebook_interstital_ad_id'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Facebook Interstital Clicks :-</label>
                      <div class="col-md-9">
                      <input type="text" name="facebook_interstital_ad_click" id="facebook_interstital_ad_click" value="<?php echo $settings_row['facebook_interstital_ad_click'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>                  
                </div> 
                <div class="banner_ads_block">
                  <div class="banner_ad_item">
                    <label class="control-label">Facebook Native Ads :-</label>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Facebook Native Ad:-</label>
                      <div class="col-md-9">
                       <select name="facebook_native_ad" id="facebook_native_ad" class="select2">
                                <option value="true" <?php if($settings_row['facebook_native_ad']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['facebook_native_ad']=='false'){?>selected<?php }?>>False</option>
                    
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Facebook Native ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="facebook_native_ad_id" id="facebook_native_ad_id" value="<?php echo $settings_row['facebook_native_ad_id'];?>" class="form-control">
                      </div>
                    </div>    
                <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Facebook Native Position :-</label>
                      <div class="col-md-9">
                      <input type="text" name="facebook_native_ad_click" id="facebook_native_ad_click" value="<?php echo $settings_row['facebook_native_ad_click'];?>" class="form-control">
                      </div>
                    </div> 
                  </div>
                </div>  
              </div> 
              </div>
              </div>

              <div class="col-md-6">                
              <div class="col-md-12">
                <div class="admob_title">iOS</div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Publisher ID :-</label>
                  <div class="col-md-9">
                    <input type="text" name="publisher_id_ios" id="publisher_id_ios" value="<?php echo $settings_row['publisher_id_ios'];?>" class="form-control">
                  </div>
                  <!-- <label class="col-md-3 control-label">Application ID :-</label>
                  <div class="col-md-9">
                    <input type="text" name="app_id_ios" id="app_id_ios" value="<?php echo $settings_row['app_id_ios'];?>" class="form-control">
                  </div> -->
                </div>
                <div class="banner_ads_block">
                  <div class="banner_ad_item">
                    <label class="control-label">Banner Ads :-</label>                                  
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Banner Ad:-</label>
                      <div class="col-md-9">
                         <select name="banner_ad_ios" id="banner_ad_ios" class="select2">
                                <option value="true" <?php if($settings_row['banner_ad_ios']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['banner_ad_ios']=='false'){?>selected<?php }?>>False</option>
                    
                            </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Banner ID :-</label>
                      <div class="col-md-9">
                        <input type="text" name="banner_ad_id_ios" id="banner_ad_id_ios" value="<?php echo $settings_row['banner_ad_id_ios'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>
                </div>  
              </div>
              <div class="col-md-12">
                <div class="interstital_ads_block">
                  <div class="interstital_ad_item">
                    <label class="control-label">Interstital Ads :-</label>                   
                  </div>  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="col-md-3 control-label">Interstital:-</label>
                      <div class="col-md-9">
                        <select name="interstital_ad_ios" id="interstital_ad_ios" class="select2">
                                <option value="true" <?php if($settings_row['interstital_ad_ios']=='true'){?>selected<?php }?>>True</option>
                                <option value="false" <?php if($settings_row['interstital_ad_ios']=='false'){?>selected<?php }?>>False</option>
                    
                            </select> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Interstital ID :-</label>
                      <div class="col-md-9">
                      <input type="text" name="interstital_ad_id_ios" id="interstital_ad_id_ios" value="<?php echo $settings_row['interstital_ad_id_ios'];?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-3 control-label mr_bottom20">Interstital Clicks :-</label>
                      <div class="col-md-9">
                      <input type="text" name="interstital_ad_click_ios" id="interstital_ad_click_ios" value="<?php echo $settings_row['interstital_ad_click_ios'];?>" class="form-control">
                      </div>
                    </div>                    
                  </div>                  
                </div>  
              </div>
              </div>
            </div>
            </div>                        
            <div class="form-group">
              <div class="col-md-9">
              <button type="submit" name="admob_submit" class="btn btn-primary">Save</button>
              </div>
            </div>
            </div>
          </div>
                </form>
              </div>
              <div role="tabpanel" class="tab-pane" id="notification_settings">
              <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                
                <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">OneSignal App ID :-</label>
                    <div class="col-md-6">
                      <input type="text" name="onesignal_app_id" id="onesignal_app_id" value="<?php echo $settings_row['onesignal_app_id'];?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">OneSignal Rest Key :-</label>
                    <div class="col-md-6">
                      <input type="text" name="onesignal_rest_key" id="onesignal_rest_key" value="<?php echo $settings_row['onesignal_rest_key'];?>" class="form-control">
                    </div>
                  </div>              
                  <div class="form-group">
                  <div class="col-md-9 col-md-offset-3">
                    <button type="submit" name="notification_submit" class="btn btn-primary">Save</button>
                  </div>
                  </div>
                </div>
                </div>
              </form>
            </div>
              <div role="tabpanel" class="tab-pane" id="api_settings">   
                <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                  
                  <div class="section">
                    <div class="section-body">
                      <div class="col-md-6">  
                      <div class="form-group">
                        <label class="col-md-5 control-label">Home Limit:-</label>
                        <div class="col-md-6">
                           
                          <input type="number" name="home_limit" id="home_limit" value="<?php echo $settings_row['home_limit'];?>" class="form-control"> 
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Home Landscape Limit:-</label>
                        <div class="col-md-6">
                           
                          <input type="number" name="home_landscape_limit" id="home_landscape_limit" value="<?php echo $settings_row['home_landscape_limit'];?>" class="form-control"> 
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Home Square Limit:-</label>
                        <div class="col-md-6">
                           
                          <input type="number" name="home_square_limit" id="home_square_limit" value="<?php echo $settings_row['home_square_limit'];?>" class="form-control"> 
                        </div>
                        
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Latest Limit:-</label>
                        <div class="col-md-6">
                           
                          <input type="number" name="api_latest_limit" id="api_latest_limit" value="<?php echo $settings_row['api_latest_limit'];?>" class="form-control"> 
                        </div>
                        
                      </div>
                      </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Category List Order By:-</label>
                        <div class="col-md-6">
                          
                            <select name="api_cat_order_by" id="api_cat_order_by" class="select2">
                              <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
                              <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Name</option>
                  
                            </select>
                            
                        </div>
                       
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Category Wallpaper Order:-</label>
                        <div class="col-md-6">
                           
                            
                            <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="select2">
                              <option value="ASC" <?php if($settings_row['api_cat_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                              <option value="DESC" <?php if($settings_row['api_cat_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
                  
                            </select>
                            
                        </div>
                       
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">GIF Order:-</label>
                        <div class="col-md-6">
                           
                            <select name="api_gif_post_order_by" id="api_gif_post_order_by" class="select2">
                              <option value="ASC" <?php if($settings_row['api_gif_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                              <option value="DESC" <?php if($settings_row['api_gif_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
                  
                            </select>
                            
                        </div>
                       
                      </div>
                     </div> 
                      <div class="form-group">
                        <div class="col-md-9">
                          <button type="submit" name="api_submit" class="btn btn-primary">Save</button>
                        </div>
                      </div>
                    </div>
                  </div>
               </form>
              </div>

              <div role="tabpanel" class="tab-pane" id="api_privacy_policy">   
                <form action="" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
                  
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">App Privacy Policy :-</label>
                    <div class="col-md-6">
                 
                      <textarea name="app_privacy_policy" id="privacy_policy" class="form-control"><?php echo stripslashes($settings_row['app_privacy_policy']);?></textarea>

                      <script>CKEDITOR.replace( 'privacy_policy' );</script>
                    </div>
                  </div>
                  <br>
                
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="app_pri_poly" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
               </form>
              </div> 

            </div>   

          </div>
        </div>
      </div>
    </div>
 
        
<?php include("includes/footer.php");?>

<script type="text/javascript">
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }
</script>  

 <script>
$("#interstital_ad_click").blur(function(e){
    if($(this).val() == '')
      $(this).val("0");
  });
     </script>

 <script>
$("#facebook_interstital_ad_click").blur(function(e){
    if($(this).val() == '')
      $(this).val("0");
  });
     </script>

