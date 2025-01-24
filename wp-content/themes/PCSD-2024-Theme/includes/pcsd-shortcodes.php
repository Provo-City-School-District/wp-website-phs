<?php
defined('ABSPATH') or die('No script kiddies please!');

//[span]
function span_func($atts)
{
	return "<span>";
}
add_shortcode('span', 'span_func');

//[end-span]
function end_span_func($atts)
{
	return "</span>";
}
add_shortcode('end-span', 'end_span_func');

//[pdf]
function pdf_func($atts)
{
	return ' class="pdf" ';
}
add_shortcode('pdf', 'pdf_func');

//[xls]
function xls_func($atts)
{
	return ' class="xls" ';
}
add_shortcode('xls', 'xls_func');

//[ext]
function ext_func($atts)
{
	return ' class="ext" ';
}
add_shortcode('ext', 'ext_func');

//Display Modified Date [modified-date]
function modifiedDate_func($atts)
{
?>
	<p class="lastmodified"><em>Last modified: <?php the_modified_date(); ?></em></p>
<?php
}
add_shortcode('modified-date', 'modifiedDate_func');




//camera feeds
//for https://provo.edu/construction/
//[ths1]
function cam_ths1_func()
{
?>
	<iframe src="http://158.91.59.49/mjpg/video.mjpg?camera=quad&amp;timestamp=1662482364393" title="W3Schools Free Online Web Tutorials"></iframe>

<?php
}
add_shortcode('ths1', 'cam_ths1_func');


//[directory url=""]
function directory_func($atts)
{
	$category = shortcode_atts(array(
		'url' => 'something',
	), $atts);
	$directory_url = "{$category['url']}";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $directory_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// TODO: to verify certificate, but path to cerificate may move or change in the future. want to think through something so this doesn't get disjointed or forgotten, going to not verify for now
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	// curl_setopt($ch, CURLOPT_CAINFO, '/etc/ssl/wildcard/star_provo_edu.crt'); // Path to CA certificates bundle
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$output = curl_exec($ch);
	if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
	}
	curl_close($ch);
	$output = '<div class="staff-member-listing">' . $output . '</div>';
	return $output;
}
add_shortcode('directory', 'directory_func');

/*
============================================
Collapsible Area Shortcode: [collapsible_area title="First h2 title" heading="h2"]Your content here[/collapsible_area]
============================================
*/
function collapsible_area_shortcode($atts, $content = null)
{
	static $collapsible_area_counter = 0;
	$collapsible_area_counter++;

	$atts = shortcode_atts(
		array(
			'title' => 'Click to Expand',
			'heading' => 'h2', // Default heading level
		),
		$atts,
		'collapsible_area'
	);

	$heading_tag = in_array($atts['heading'], array('h2', 'h3')) ? $atts['heading'] : 'h2';
	$unique_id = 'collapsible-area-' . $collapsible_area_counter;

	ob_start();
?>
	<div class="collapsible-area" id="<?php echo $unique_id; ?>">
		<<?php echo $heading_tag; ?> class="collapsible-button"><?php echo esc_html($atts['title']); ?></<?php echo $heading_tag; ?>>
		<div class="collapsible-content" style="display: none;">
			<?php echo do_shortcode($content); ?>
		</div>
	</div>

<?php
	return ob_get_clean();
}
add_shortcode('collapsible_area', 'collapsible_area_shortcode');
