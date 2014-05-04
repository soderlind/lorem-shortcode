<?php
/*
Plugin Name: lorem shortcode
Version: 1.1.1
Plugin URI: http://soderlind.no/archives/2010/11/17/lorem-shortcode/
Description: The shortcode generates dummy text when needed. Use shortcode [lorem] to generate 5 paragraphs with 3 lines in each ,or [lorem p="4" l="5"], p = number of paragraphs and l = number of lines per paragraph
Author: Per Soderlind
Author URI: http://www.soderlind.no
*/


class pers_lorem {	
	private $doparamcheck = true;
	private $str_lipsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet tincidunt sollicitudin. Proin sagittis turpis semper purus gravida sit amet tempus nisi blandit. Phasellus ut consectetur mauris. Donec vel ligula eu erat tempus tincidunt et ac dolor. Sed dui lectus, varius eget dictum pretium, convallis quis dui. Nam sed magna urna. Praesent eget eleifend libero. Duis volutpat, dolor nec scelerisque porttitor, justo nisl sagittis tellus, sed luctus nibh sem eu metus. Phasellus in nisi diam. Donec mattis erat ac lorem tempus vitae condimentum dui pulvinar. Vestibulum auctor augue ut enim tempor commodo. Curabitur ornare eleifend lectus, eget rutrum nunc bibendum vel. Maecenas sodales, dui nec condimentum rutrum, nunc lacus lacinia augue, a laoreet risus sapien a neque. Nam purus sapien, elementum nec congue vitae, vehicula non sapien. Suspendisse ullamcorper egestas molestie. Mauris luctus ligula id nibh fermentum sodales lobortis erat lobortis.Cras erat neque, dignissim in interdum a, placerat ut felis. In sapien nibh, tincidunt non porttitor id, volutpat ut mauris. Sed sed mauris nibh. Proin dui nibh, facilisis sed bibendum nec, viverra eget mauris. Aliquam leo nulla, adipiscing sed fermentum a, sagittis sit amet quam. Proin scelerisque lectus rhoncus erat congue a pellentesque felis vestibulum. Pellentesque aliquet ante sed nunc sodales a scelerisque dolor malesuada. Phasellus ut nibh justo. Nunc fringilla, nunc in mattis feugiat, ligula nulla porta mi, ac dignissim risus dui non ipsum. Mauris mollis risus sit amet nisl euismod vitae pellentesque augue euismod. Quisque venenatis gravida dapibus. Sed ornare, dolor in rhoncus sollicitudin, erat sapien accumsan magna, ac pulvinar mi elit in tellus. Ut hendrerit mollis felis, sed pharetra quam aliquam eu. Phasellus consectetur volutpat tortor at faucibus. Cras eu purus ipsum, quis hendrerit libero. Morbi ullamcorper porta risus, ac varius massa volutpat et. Integer semper convallis purus vitae pharetra.Vestibulum facilisis, neque nec mollis pretium, felis elit pulvinar tortor, eu vestibulum magna mauris blandit orci. Suspendisse potenti. Nulla molestie magna nec nisi auctor rhoncus. Cras auctor, lectus nec semper rutrum, turpis enim pellentesque massa, ornare condimentum lorem justo eu velit. Quisque eget laoreet elit. Donec viverra ultricies fringilla. Phasellus aliquet lorem in quam sodales nec rutrum erat bibendum. Proin eu nulla enim, sit amet porttitor nisi. Aliquam erat volutpat. Morbi in mollis libero. Nulla luctus lacinia lectus, in faucibus lacus adipiscing nec.Aliquam adipiscing odio non sem elementum facilisis. Nulla ultrices consectetur augue, sed sagittis nulla scelerisque in. In ante elit, ultricies sagittis bibendum at, cursus et quam. Praesent nec malesuada dolor. Cras ut turpis velit. Aliquam ut elit eu magna luctus convallis at ut neque. Integer at tellus ipsum. Morbi ac tristique risus. Donec suscipit, lacus vel eleifend luctus, justo ligula consectetur felis, sit amet congue mauris mauris quis augue. Donec vitae ornare enim. In egestas tristique nulla, vitae laoreet augue tincidunt in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut adipiscing eros nulla, quis pharetra metus. Phasellus consectetur velit eget turpis volutpat et fermentum tortor iaculis. Donec condimentum purus at mauris volutpat ac vulputate nulla lobortis.Nam sit amet rhoncus justo. Nulla commodo metus ac urna suscipit auctor. Etiam luctus, ipsum id interdum laoreet, lectus elit gravida orci, et lobortis diam mauris eget urna. Sed non nisi libero, et malesuada mi. Pellentesque sapien sapien, posuere sit amet viverra quis, gravida at ante. Pellentesque sodales, dolor quis sodales dignissim, felis arcu dapibus ligula, id lacinia orci augue vel eros. Vivamus suscipit iaculis tristique. Aliquam nec accumsan augue. Duis quis lobortis eros. Praesent elementum, tellus id volutpat suscipit, tortor mauris egestas erat, tincidunt sodales nisi massa non ligula. Fusce non lacus ut eros euismod congue at quis turpis. Nullam ultrices, mi in varius blandit, nunc nibh feugiat neque, in convallis mi tellus eu magna. Nullam laoreet justo ullamcorper lorem bibendum in auctor est luctus.";

	private $imagedata = "";

	function __construct() {
		add_shortcode('lorem', array(&$this,'pers_lorem_func'));
		add_shortcode('loremimage', array(&$this,'pers_loremimage_func'));
	}

	function pers_lorem_func($atts,$content=null) {
		extract(shortcode_atts(array( // default values
			'p'   => 5,
			'l'      => 3,
			'align' => 'right'
		), $atts));	
					
		if ($this->doparamcheck) { // do param testing	
			$p = strval(intval($p));
			$l = strval(intval($l));
			$align = (strcasecmp($align, "left") == 0) ? ' style="float:left;"' : ' style="float:right;"' ;	// align the embedded image
		}
		
		// create lipsums
		$paragraphs = str_repeat('<p>%s</p>', $p);				
		$lipsums = preg_split('/([.?!])/', $this->str_lipsum, -1, PREG_SPLIT_NO_EMPTY);
		$j = 0;
		for ($i = 0; $i < $p ; $i++) {
			if ($j + $l > count($lipsums)) $j=0;		
			$lines[] = trim(implode('.',array_slice($lipsums, $j, $l))) . '.';
			$j = $j + $l;
		}		

		
		if ($content) { // support embedded shortcode
			$ret = '<div class="lorem-container">';
			$ret .= sprintf('<div%s>',$align);
			$ret .= do_shortcode($content);
			$ret .= '</div>';
			$ret .= vsprintf($paragraphs,$lines);
			$ret .= '<div style="clear:both;overflow: auto"></div>';
			$ret .= '</div>';
		} else {
			$ret = '<div class="lorem-container">';
			$ret .= vsprintf($paragraphs,$lines);
			$ret .= '</div>';
		}
		return $ret;
	}
	
	function pers_loremimage_func($atts) {
		extract(shortcode_atts(array( // default values
			'size'   	=>	'300x200', // alternative sizes, see http://dummyimage.com/
			'text'		=>	'',
			'bgcolor'	=>	'eee',
			'fgcolor'	=>	'ccc',
			'format'	=>	'png',
			'style'		=>	''
		), $atts));
		
		
		if ($this->doparamcheck) { // do param testing	
			$size = urlencode(wp_filter_nohtml_kses($size));
			$text = urlencode(wp_filter_nohtml_kses($text));
			$bgcolor = urlencode(wp_filter_nohtml_kses($bgcolor));
			$fgcolor = urlencode(wp_filter_nohtml_kses($fgcolor));
			$format = urlencode(wp_filter_nohtml_kses($format));
			$style = wp_filter_nohtml_kses($style);
		}

		 
		if (strcasecmp($size, "thumb") == 0) { // show thumb with link to image
			$thumb_xy = sprintf("%sx%s",get_option('thumbnail_size_w'),get_option('thumbnail_size_h') );
			$medium_xy = sprintf("%sx%s",get_option('medium_size_w'),get_option('medium_size_h') );
			$ret  = sprintf('<a href="http://dummyimage.com/%s/%s/%s.%s&text=%s" rel="lightbox[lorem]">',$medium_xy,$bgcolor,$fgcolor,$format,$text);
			$ret .= sprintf('<img src="http://dummyimage.com/%s/%s/%s.%s&text=%s" style="%s" class="lorem-image" />',$thumb_xy,$bgcolor,$fgcolor,$format,$text,$style);
			$ret .= '</a><br />';
		} else {
			$ret =  sprintf('<img src="http://dummyimage.com/%s/%s/%s.%s&text=%s" style="%s" class="lorem-image" />',$size,$bgcolor,$fgcolor,$format,$text,$style);			
		}
		return $ret;
	}
	
	
}
$ps_lorem = new pers_lorem();
?>