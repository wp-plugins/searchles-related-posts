<?php
/**
 * @package Searchles Plug-in
 * @author Peter Hale
 * @version 0.3
 */
/*
Plugin Name: Searchles Discovery
Plugin URI: http://www.searchles.com/misc/platform
Description: View related content for your blog via the Searchles engine.
Author: Peter Hale
Version: 0.3
Author URI: http://www.searchles.com/misc/platform
*/

define(SEARCHLES_WIDGET_ID, "widget_searchles_1_3_7");

function get_searchles_content($content) {


	echo $content;
  widget_searchles_header();
	  $options = get_option(SEARCHLES_WIDGET_ID);
		
		echo "<div class='widget-content'>";
		echo "<!-- Searchles Widget Code -->";
		echo "<script>";
		echo "var platform='wordpress';";
		echo "	var rel_url = document.location.href.replace( /[\?#].*/, '' );";
		echo "	var rel_disp= 'true';";
		echo "	if( !rel_url.match( 'http://.*/.*/.*/' ) ) {";
		echo "	     rel_disp = 'true';";
		echo "	}";
		echo "	rel_url = escape(rel_url);";

		echo "	var rellinkBold='" . $options['link_bold'] . "';";
		echo "	var relshowSeparator='" . $options['show_separator'] . "';";
		echo "	var relseparation='" . $options['separation'] . "';";
		echo "	var relheaderText='" . $options['header_text'] . "';";
		echo "	var rellinkFont='" . $options['link_font'] . "';";

		echo "	var relfontSizeVar='" . $options['font_size'] . "';";
		echo "	var relrelatedColor='0x" . $options['related_color'] . "';";
		echo "	var relheaderFill='0x" . $options['header_fill'] . "';";
		echo "	var rellinkColor='" . $options['link_color'] . "';";
		echo "	var relbgColor='0x" . $options['background_color'] . "';";
		echo "	var relborderColor='0x" . $options['border_color'] . "';";
		echo "	var relwidgetWidth='" . $options['widget_width'] . "';";
		echo "	var relwidgetHeight='" . $options['widget_height'] . "';";
		echo "	var relclient='" . $options['client_id'] . "';";
		echo "</script>";
		echo "<script src=\"http://cdn.searchles.com/platform/rel.js\"></script>";
		echo "<!-- End of Searchles Widget Code -->";
		echo "<span class='widget-item-control'>";
		echo "<span class='item-control blog-admin'>";
		echo "</div>";
}

function widget_get_searchles_content($args) {
	extract($args, EXTR_SKIP);  
	echo $before_widget;  
	get_searchles_content($args);  
	echo $after_widget;  	
}



function widget_get_searchles_content_init() 
{
  wp_register_sidebar_widget(SEARCHLES_WIDGET_ID, "Searchles Discovery", 'check_searchles_posts');
  wp_register_widget_control(SEARCHLES_WIDGET_ID, "Searchles Discovery", 'widget_get_searchles_content_control');
}

function widget_searchles_header() {
?>
	<script language="Javascript">
	function change_color(input, id) {
		var obj = document.getElementById(id);
		if (obj) {
			obj.style.backgroundColor = "#" + input.value;
			//alert (obj.style.backgroundColor + " for " + obj.id);
		}
	}
	</script>
	<style>
		.color_viewer {
			border:1px solid;
			width:70px;
			background-color:#ffffff;
			padding-left:10px;
		}
	</style>
	
<?php
}

function check_searchles_posts($ar) {
}

function widget_get_searchles_content_control() {
  $options = get_option(SEARCHLES_WIDGET_ID);
  if (!is_array($options)) {
    $options = array();
    $options['client_id'] = 'test';
    $options['font_size'] = '10';
    $options['related_color'] = 'CC0000';
    $options['header_fill'] = 'F6F6F6';
    $options['link_color'] = '666666';
    $options['border_color'] = 'CCCCCC';
    $options['background_color'] = 'FFFFFF';
    $options['link_bold'] = 'bold';
    $options['show_separator'] = 'true';
    $options['separation'] = '10';
    $options['header_text'] = 'Related Content';
    $options['link_font'] = 'Verdana';
    $options['widget_width'] = '450';
    $options['widget_height'] = '180';
  }

  $options_to_save = $_POST[SEARCHLES_WIDGET_ID];
  if ($options_to_save['submit']) {
    update_option(SEARCHLES_WIDGET_ID, $options_to_save);
  }

  // Render form
  // The HTML form will go here
?>

<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-client_id"> Searchles Client Id: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[client_id]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-client_id" value="<?php echo $options['client_id']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-font_size"> Font Size: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[font_size]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-font_size" value="<?php echo $options['font_size']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-related_color"> Related Color: </label>
<span id="related_color" class="color_viewer" style="background-color:#<?php echo $options['related_color']; ?>;">&nbsp;</span>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[related_color]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-related_color" value="<?php echo $options['related_color']; ?>" onblur="change_color(this, 'related_color');"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-header_fill"> Header Fill Color: </label>
<span id="header_fill" class="color_viewer" style="background-color:#<?php echo $options['header_fill']; ?>;">&nbsp;</span>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[header_fill]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-header_fill" value="<?php echo $options['header_fill']; ?>"  onblur="change_color(this, 'header_fill');"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-link_color"> Link Color: </label>
<span id="link_color" class="color_viewer" style="background-color:#<?php echo $options['link_color']; ?>;">&nbsp;</span>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[link_color]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-link_color" value="<?php echo $options['link_color']; ?>"  onblur="change_color(this, 'link_color');"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-border_color"> Border Color: </label>
<span id="border_color" class="color_viewer" style="background-color:#<?php echo $options['border_color']; ?>;">&nbsp;</span>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[border_color]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-border_color" value="<?php echo $options['border_color']; ?>"  onblur="change_color(this, 'border_color');"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-background_color"> Background Color: </label>
<span id="background_color" class="color_viewer" style="background-color:#<?php echo $options['background_color']; ?>;">&nbsp;</span>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[background_color]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-background_color" value="<?php echo $options['background_color']; ?>"  onblur="change_color(this, 'background_color');"/>
<p>

<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-link_bold"> Bold Links (bold/normal): </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[link_bold]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-link_bold" value="<?php echo $options['link_bold']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-show_separator"> Show Separator: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[show_separator]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-show_separator" value="<?php echo $options['show_separator']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-separation"> Separation of Links: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[separation]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-separation" value="<?php echo $options['separation']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-header_text"> Header Text: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[header_text]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-header_text" value="<?php echo $options['header_text']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-link_font"> Link Font: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[link_font]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-link_font" value="<?php echo $options['link_font']; ?>"/>
</p>


<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-widget_width"> Width: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[widget_width]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-widget_width" value="<?php echo $options['widget_width']; ?>"/>
</p>
<p>
<label for="<?php echo SEARCHLES_WIDGET_ID;?>-widget_height"> Height: </label>
<input class="widefat" type="text" name="<?php echo SEARCHLES_WIDGET_ID; ?>[widget_height]" id="<?php echo SEARCHLES_WIDGET_ID; ?>-widget_height" value="<?php echo $options['widget_height']; ?>"/>
</p>
<input type="hidden" name="<?php echo SEARCHLES_WIDGET_ID; ?>[submit]" value="1"/>
<?php
}


// Register widget to WordPress
add_action("plugins_loaded", "widget_get_searchles_content_init");
add_action("admin_head", "widget_searchles_header");
//add_action("pre_get_posts", "check_searchles_posts");
add_filter("the_content", "get_searchles_content");

?>