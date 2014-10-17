<?php 
    /*
    Plugin Name: No - Follow Plugin
    Plugin URI: http://www.shyamachuthan.com/no-follow-plugin
    Description: Plugin for adding rel="external nofollow" to outgoing links from site preventing link juice 	being passed to other websites.
    Author: Shyam Achuthan
    License: GPLv2 or later
    Version: 1.0
    Author URI: http://www.shyamachuthan.com
    Credits : Simple HTML Dom Parser
    */
?>
<?php 
include('simple_html_dom.php');
function mp_footer()
{
	$body_content=ob_get_clean();
	$html=str_get_html($body_content);
	foreach($html->find('a') as $atag)
	{
				$pu = parse_url(site_url());
    			$domain=strtolower($pu["scheme"] . "://" . $pu["host"]);
    			$flag=strpos(($atag->href),$domain);
    			if(!is_int($flag) && !$flag)
    			{
					$atag->rel="external nofollow";
					
				}
	}
	echo $html;
}

function start_buffer(){
 ob_start();
}

add_action('init', 'start_buffer');
add_action('wp_footer', 'mp_footer');
?>