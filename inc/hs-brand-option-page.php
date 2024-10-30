<div class="wrap hs-brand-logo-wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>HS Brand Logo Slider</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
						<div class="inside">
						<?php if(!$_GET['id']){  ?>
							<h2><?php _e( 'Add New Brand', 'hsbrand' ); ?></h2>
							<h4 class="success_message"> <?php if(isset($_GET['add']) == 1){ echo 'New Brand is inserted successfully...'; } ?> </h4>
							<h4 class="success_message"> <?php if(isset($_GET['edit']) == 1){ echo 'Edited successfully...'; } ?> </h4>
							<form name="hsbrand_logo_form" method="post" action="" enctype="multipart/form-data">							
								<table cellspacing="5" cellpadding="5" class="setting-logo-table" >
									<tr>
										<td>Brand Name <span class="required">*</span></td>
										<td><input type = "text" name="brandname" id="brandname" placeholder="Enter Brand Name Here" size="40" class="input-field hsbrand_brandname"  required /></td>
									</tr>
									<tr>
										<td>Brand Logo <span class="required">*</span></td>
										<td><input type = "file" name="logoupload" id="logoupload" placeholder="Upload Logo" class="input-field hsbrand_logoupload" required/></td>
									</tr>
									<tr>
										<td>Redirect URL</td>
										<td><input type = "text" name="logourl" id="logourl" placeholder="Enter URL Here" size="40" class="input-field hsbrand_logourl"/></td>
									</tr>
									<tr>
										<td>Sort Order</td>
										<td><input type = "text" name="sortorder" id="sortorder" placeholder="Enter Sort Order" size="20" class="input-field hsbrand_sortorder"/></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input type = "submit" value="Submit" id="save_data" name="submit_data" class="input-field button button-primary hsbrand_submit"/></td>
									</tr>
								</table>
							</form>
							<?php } ?>
							<?php if($_GET['id']){ 
								global $wpdb;
								$table_name = $wpdb->prefix . "hs_brand_logo";
								$results = $wpdb->get_results( 'SELECT * FROM '.$table_name.' WHERE id = '.$_GET['id'].'', OBJECT );
								foreach($results as $result){
							?>
							<h2><?php _e( 'Edit Brand ', 'hsbrand' ); ?></h2>
							<form name="hsbrand_logo_form_update" method="post" action="" enctype="multipart/form-data">							
								<table cellspacing="5" cellpadding="5" class="setting-logo-table" >
									<tr>
										<td>Brand Name <span class="required">*</span></td>
										<td><input type = "text" name="brandname" value="<?php echo $result->company_name; ?>" id="brandname" placeholder="Enter Brand Name Here" size="40" class="input-field hsbrand_brandname"/></td>
									</tr>
									<tr>
										<td>Brand Logo <span class="required">*</span></td>
										<td><input type = "file" name="logoupload" id="logoupload" placeholder="Upload Logo" class="input-field hsbrand_logoupload"/> <img src="../wp-content/uploads/<?php echo $result->image; ?>" width="30" height="30"/></td>
									</tr>
									<tr>
										<td>Redirect URL</td>
										<td><input type = "text" name="logourl" value="<?php echo $result->logourl; ?>" id="logourl" placeholder="Enter URL Here" size="40" class="input-field hsbrand_logourl"/></td>
									</tr>
									<tr>
										<td>Sort Order</td>
										<td><input type = "text" name="sortorder" value="<?php echo $result->sortorder; ?>" id="sortorder" placeholder="Enter Sort Order" size="20" class="input-field hsbrand_sortorder"/></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input type = "submit" value="Update" id="save_data" name="update_data" class="input-field button button-primary hsbrand_submit"/>
											<a href="admin.php?page=hs-brand-logo-slider.php" title="Add New Brand" class="button button-primary"> <?php _e('Cancel', 'hsbrand'); ?> </a>
											<a href="admin.php?page=hs-brand-logo-slider.php" title="Add New Brand" class="button button-primary"> <?php _e('Add New', 'hsbrand'); ?> </a>
										</td>
									</tr>
								</table>
							</form>
							<?php 
							  }
							} ?>
						</div> <!-- .inside -->
                                                
					</div> <!-- .postbox -->
					
					<!-- Brand Logo Listing -->
					<div class="postbox">
						<div class="inside">
							<h2><?php _e( 'Brand Logos', 'hsbrand' ); ?></h2>
							<h4 class="success_message"> <?php if(isset($_GET['del']) == 1){ echo 'Deleted Successfully'; } ?> </h4>
								<table class="logo-listing" width="100%" border="0" style="text-align:left;">
									<tr>
											<th><?php _e( 'Logo', 'hsbrand' ); ?></th>
											<th><?php _e( 'Brand Name', 'hsbrand' ); ?> </th>
											<th><?php _e( 'Redirect URL', 'hsbrand' ); ?></th>
											<th><?php _e( 'Sort Order ', 'hsbrand' ); ?></th>
											<th><?php _e( 'Action', 'hsbrand' ); ?></th>
									</tr>
									<?php foreach($select_result as $row_value){ ?>
									<tr class="logo-data">
										<td> <img src="<?php echo $image_file_path . '/' . $row_value->image; ?>" style="max-width:100px;margin:0 auto;text-align:center;"> </td>
										<td> <?php echo $row_value->company_name; ?> </td>
										<td> <?php echo $row_value->logourl; ?> </td>
										<td> <?php echo $row_value->sortorder; ?> </td>
										<td> 
											<a href="?page=hs-brand-logo-slider.php&id=<?php echo $row_value->id ?>">
                                              <input class="button-primary delete-btn" type="button" id="<?php echo $row_value->id; ?>" name="delete" value="<?php _e('Edit', 'hsbrand'); ?>" />
                                                </a>
											<a onclick="show_confirm('<?php echo $row_value->company_name; ?>','<?php echo $row_value->id; ?>');" href="#delete">
                                              <input class="button-primary delete-btn" type="button" id="<?php echo $row_value->id; ?>" name="delete" value="<?php _e('Delete', 'hsbrand'); ?>" />
                                                </a>
										</td>
									</tr>
									<?php } ?>
									<tr>
										
									</tr>
								</table>
						</div> <!-- .inside -->
                                                
					</div> <!-- .postbox -->
					
					<!-- Brand Slider Settings -->
					<div class="postbox">
						<div class="inside">
							<h2><?php _e( 'HS Brand Logo Slider Settings', 'hsbrand' ); ?></h2>
							<h4 class="success_message"> <?php if(isset($_GET['settings']) == 1){ echo 'New Brand is inserted successfully...'; } ?> </h4>
							<form name="hsbrand_settings" method="post" action="" enctype="multipart/form-data">							
								<table cellspacing="5" cellpadding="5">
									<tr>
										<td><?php _e('Autoplay','hsbrand') ?></td>
										<td><input type = "checkbox" <?php if($autoplay_option == 'yes') { ?>checked="checked" <?php } ?> name="autoplay" id="autoplay" value="yes" class="input-field hsbrand_autoplay"/> 
										<label for="autoplay"><?php _e('Yes', 'hsbrand'); ?></label></td>
									</tr>
									<tr>
										<td><?php _e('Stop on hover','hsbrand') ?></td>
										<td><input type = "checkbox" <?php if($stoponhover_option == 'yes') { ?>checked="checked" <?php } ?> name="stoponhover" id="stoponhover" value="yes" class="input-field hsbrand_stoponhover"/> 
										<label for="stoponhover"><?php _e('Yes', 'hsbrand'); ?></label> 
										<span> <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('(Default is false) ','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Delay Time','hsbrand') ?></td>
										<td><input type = "text" name="autoplay_time" id="autoplay_time" class="input-field hsbrand_autoplay_time" placeholder="<?php _e('Enter Delay Time','hsbrand') ?>" value="<?php if(isset($autoplay_time_option)){ echo $autoplay_time_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('(Default is 3000 milliseconds (3 Seconds)) ','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Pagination','hsbrand') ?></td>
										<td><input id="pagination" type = "checkbox" <?php if($pagination_option == 'yes') { ?>checked="checked" <?php } ?> name="pagination" value="yes" class="input-field hsbrand_pagination"/><label for="pagination"> <?php _e('Yes', 'hsbrand'); ?></label>
										<span> <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e(' (Default is false)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Responsive','hsbrand') ?></td>
										<td><input id="responsive" type = "checkbox" <?php if($responsive_option == 'yes') { ?>checked="checked" <?php } ?> name="responsive" value="yes" class="input-field hsbrand_responsive"/><label for="responsive"> <?php _e  ('Yes', 'hsbrand'); ?></label>
										<span> <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('(Default is false)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Default Logo Shows at a time','hsbrand') ?></td>
										<td><input type = "text" name="default_items" id="default_items" placeholder="<?php _e('Enter Number','hsbrand') ?>" size="10" class="input-field hsbrand_default_items" value="<?php if(isset($default_items_option)){ echo $default_items_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('(Default is 3)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Logos Shows in Desktop') ?></td>
										<td><input type = "text" name="default_items_desktop" id="default_items_desktop" placeholder="<?php _e('Enter Number','hsbrand') ?>" size="10" class="input-field hsbrand_default_items_desktop" value="<?php if(isset($default_items_desktop_option)){ echo $default_items_desktop_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('logos is displayed at a time i.e browser width <= 1199px and >=981px (Default is 3)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Logos Shows in Small Desktop') ?></td>
										<td><input type = "text" name="default_items_small" id="default_items_small" placeholder="<?php _e('Enter Number','hsbrand') ?>" size="10" class="input-field hsbrand_default_items_small" value="<?php if(isset($default_items_small_option)){ echo $default_items_small_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('logos is displayed at a time i.e browser width <= 980px and >=769px (Default is 3)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Logos Shows in Tablet') ?></td>
										<td><input type = "text" name="default_items_tablet" id="default_items_tablet" placeholder="<?php _e('Enter Number','hsbrand') ?>" size="10" class="input-field hsbrand_default_items_tablet" value="<?php if(isset($default_items_tablet_option)){ echo $default_items_tablet_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('logos is displayed at a time i.e browser width <= 768px and >=481px (Default is 3)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td><?php _e('Logos Shows in Mobile') ?></td>
										<td><input type = "text" name="default_items_mobile" id="default_items_mobile" placeholder="<?php _e('Enter Number','hsbrand') ?>" size="10" class="input-field hsbrand_default_items_mobile" value="<?php if(isset($default_items_mobile_option)){ echo $default_items_mobile_option; } ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"/> 
										<span> <i><?php _e('logos is displayed at a time i.e browser width <= 480px and >=0 (Default is 2)','hsbrand') ?></i>  </span> </td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><input type = "submit" value="Save Settings" id="save_settings" name="save_settings" class="input-field button button-primary hsbrand_submit"/></td>
									</tr>
								</table>
							</form>
						</div> <!-- .inside -->
                                                
					</div> <!-- .postbox -->
					
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
				
			</div> <!-- post-body-content -->
			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
                                            
						<h3><span>About Helios Solutions</span></h3>
						<div class="inside">
							<a href="http://heliossolutions.in/" target="_blank">
								<img src="<?php echo $url = plugins_url('hs-brand-logo-slider/images/cmp_logo.png'); ?>">
							</a>
							<p>Helios Solution is an Indian IT outsourcing company who works on many IT technologies such as wordpress, magento, joomla, drupal, opencart, cakephp, .NET etc </p>
						</div> <!-- .inside -->
                                                
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables -->
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
                                            
						<h3><span><?php _e("Shortcode", "hsbrand"); ?></span></h3>
						<div class="inside">
							<?php _e("To display HS Brand Logo Slider, Add Following Shortcode to your page :" , 'hsbrand'); ?> <br><br>
							<code> [hs-brand] </code> <br><br>
							<?php _e("Use shortcode in a PHP file :" , 'hsbrand'); ?> <br><br>
							<code> &#60;&#63;php echo do_shortcode('[hs-brand]'); &#63;&#62; </code> 
						</div> <!-- .inside -->
                                                
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
			
		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->
<script>
	function show_confirm(title, id){
        var rpath1 = "";
        var rpath2 = "";
        var r=confirm('Are you sure you want to delete brand :  "'+title+'"');
        if (r==true)
        {
            rpath1 = '<?php echo $_SERVER['REQUEST_URI']; ?>';
			rpath2 = '&delete=y&del_id='+id;
			window.location = rpath1+rpath2;
        }
    }
	
	var specialKeys = new Array();
       specialKeys.push(13,8,9,16,45,46,35,36,116,37,38,38,40); 
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            //document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
       }
</script>