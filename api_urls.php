<?php 
    include("includes/header.php");
    include("includes/function.php");

    $file_path = getBaseUrl().'api.php';
?>
<div class="row">
  <div class="col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-header">
          Example API URLS
        </div>
            <div class="card-body no-padding">
        
           <pre>
            <code class="html">
              <br><b>API URL</b>&nbsp; <?php echo $file_path;?>    

              <br><b>Home</b> (Method: get_home) (Parameters: type (Portrait/Landscape/Square))
              <br><b>Latest Wallpapers</b> (Method: get_latest) (Parameters: type, page, color_id (1,2,3))
              <br><b>Category List</b> (Method: get_category, type)
              <br><b>Wallpaper list by Cat ID</b> (Method: get_wallpaper) (Parameters: cat_id, type, page, color_id (1,2,3))
              <br><b>Single Wallpaper</b> (Method: get_single_wallpaper) (Parameters: wallpaper_id)
              <br><b>Most Viewed Wallpaper</b> (Method: get_wallpaper_most_viewed) (Parameters: type, page, color_id (1,2,3))
              <br><b>Most Rated Wallpaper</b> (Method: get_wallpaper_most_rated) (Parameters: type, page, color_id (1,2,3))
              <br><b>Latest GIF</b> (Method: get_latest_gif) (Parameters: page)
              <br><b>Check Favorite</b> (Method: get_check_favorite) (Parameters: id, type, page)
              <br><b>GIF List</b> (Method: get_gif_list) (Parameters: page)
              <br><b>Single GIF Image</b> (Method: get_single_gif) (Parameters: gif_id)
              <br><b>Most Viewed GIF</b> (Method: get_gif_wallpaper_most_viewed) (Parameters: page)
              <br><b>Most Rated GIF</b> (Method: get_gif_wallpaper_most_rated) (Parameters: page)
              <br><b>Search Wallpaper</b> (Method: search_wallpaper) (Parameters: search_text, type, color_id (1,2,3))
              <br><b>Search GIF</b> (Method: search_gif) (Parameters: gif_search_text)
              <br><b>Wallpaper Rating</b> (Method: wallpaper_rate) (Parameters: post_id, device_id, rate)
              <br><b>Get Wallpaper Rating</b> (Method: get_wallpaper_rate) (Parameters: post_id, device_id)
              <br><b>GIF Rating</b> (Method: gif_rate) (Parameters: post_id, device_id, rate)
              <br><b>Get GIF Rating</b> (Method: get_gif_rate) (Parameters: post_id, device_id)
              <br><b>Wallpaper Download</b> (Method: download_wallpaper) (Parameters: wallpaper_id)
              <br><b>GIF Download</b> (Method: download_gif) (Parameters: gif_id)
              <br><b>User Login</b> (Method: user_login) (Parameters: email, password)
              <br><b>User Registration</b> (Method: user_register) (Parameters: name, email, password, phone)
              <br><b>User Profile</b> (Method: user_profile) (Parameters: user_id)
              <br><b>Edit Profile</b> (Method: edit_profile) (Parameters: user_id, name, email, password, phone)
              <br><b>Forgot Password</b> (Method: forgot_pass) (Parameters: email)
              <br><b>User Report</b> (Method: user_report) (Parameters: user_id, item_id, user_txt, report_for('wallpaper','gif'))
              <br><b>App Details</b>(Method: get_app_details)
            </code> 
         </pre>
      
          </div>
        </div>
    </div>
  </div>
<br/>
<div class="clearfix"></div>

<!-- <br><b>Portrait Wallpaper</b> (Method: get_portrait_wallpaper) (Parameters: page)
<br><b>Landscape Wallpaper</b> (Method: get_landscape_wallpaper) (Parameters: page)
<br><b>Square Wallpaper</b> (Method: get_square_wallpaper) (Parameters: page) -->
        
<?php include("includes/footer.php");?>