<?php

class Home_Worth extends WP_Widget {

	function Home_Worth() {
		$widget_ops = array('description' => __("Home Worth") );
		$this->WP_Widget('Home_Worth', __('Home Worth'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$text = apply_filters( 'widget_text', $instance['text'] );
		$link = $instance['link'];
		echo $before_widget;
		global $post;
		?>

<div class="home-worth-box">
			<h3>What's My Home Worth?</h3>
			
			<?php if ( isset($_GET['form_submitted']) ) { ?>
				
			<div class="inside">
				<p>Thank you very much for your inquiry. We will contact you shortly with what we find.</p>
			</div>	
				
			<?php } else { ?>
			
			<div class="inside">
				<p>We need a little bit of information.</p>
				
				<?php
				$vals = array(
					array("twhw_address", "Address of the Property"),
					array("twhw_beds", "Number of Bedrooms"),
					array("twhw_phone", "Phone Number"),
					array("twhw_sqft", "Square Footage"),
					array("twhw_first_name", "First Name"),
					array("twhw_last_name", "Last Name"),
					array("twhw_email", "Your Email Address")
				);
				?>
				<script>
					function checkFields()
					{
						var first = document.getElementById('first_name');
						var last = document.getElementById('last_name');
						var email = document.getElementById('email');
						var phone = document.getElementById('phone');
						var sendAlert = false;
						var sendPhoneAlert = false;

						if((first.value == "First Name") || (first.value == ""))
							sendAlert = true;
						if((last.value == "Last Name") || (last.value == ""))
							sendAlert = true;
						if((email.value == "Your Email Address") || (last.value == ""))
							sendAlert = true;
						
						if(phone.value != "Phone Number (optional)")
						{
							if(phone.value.search(/\d{3}\-\d{3}\-\d{4}/)==-1)
								sendPhoneAlert = true;
						}


						if(sendAlert == true)
						{
							alert("The following fields are required: First Name, Last Name, and Email Address");
							return false;
						}
						else if(sendPhoneAlert)
						{
							alert("Please fill out your phone number in the following format: ###-###-####");
							return false;
						}
						else
						{
							return true;
						}
					}
				</script>
				
				<form action="<?php bloginfo('url'); ?>/forms/home-worth/" method="post" >
					
					<input name="<?php echo $vals[0][0]; ?>" type="text" value="<?php echo $vals[0][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[0][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[0][1]; ?>') {this.value = '';}" />
					
					<input name="<?php echo $vals[1][0]; ?>" type="text" value="<?php echo $vals[1][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[1][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[1][1]; ?>') {this.value = '';}" />
					
					<input name="<?php echo $vals[3][0]; ?>" type="text" value="<?php echo $vals[3][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[3][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[3][1]; ?>') {this.value = '';}" />
					
					<input name="<?php echo $vals[4][0]; ?>" type="text" value="<?php echo $vals[4][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[4][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[4][1]; ?>') {this.value = '';}" id="first_name" />
					
					<input name="<?php echo $vals[5][0]; ?>" type="text" value="<?php echo $vals[5][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[5][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[5][1]; ?>') {this.value = '';}" id="last_name" />

					<input name="<?php echo $vals[2][0]; ?>" type="text" value="<?php echo $vals[2][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[2][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[2][1]; ?>') {this.value = '';}" id="phone" />
					
					<input name="<?php echo $vals[6][0]; ?>" type="text" value="<?php echo $vals[6][1]; ?>" class="text-field" onblur="if (this.value == '') {this.value = '<?php echo $vals[6][1]; ?>';}" onfocus="if (this.value == '<?php echo $vals[6][1]; ?>') {this.value = '';}" id="email" />
					
					
					<input type="hidden" name="twhw_redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<?php wp_nonce_field('home_worth','HomeWorth'); ?>
					
					<div class="submit-button"><input type="submit" value="Receive An Evaluation" id="home-worth-submit" onClick="return checkFields();"></div>
					<div class="break"></div>
				</form>
				
			</div>
			
			<?php } ?>
			
		</div>
		<?php
		echo $after_widget;
	}
}

