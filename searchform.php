<?php
/**
 * The template for displaying search forms in _s
 *
 * @package _s
 * @since _s 1.0
 */
 
?>
	<form method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s">
		<span class="screen-reader-text">Search for:</span>
		<input type="search" class="search-field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', '_s' ); ?>" />
		<i class="icon icon-search"></i>
		</label>
        <input type="hidden" name="post_type[]" value="post" />
        <input type="hidden" name="post_type[]" value="story" />
        <input type="hidden" name="post_type[]" value="event" />
		<button class="search-submit"><svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1216 832q0-185-131.5-316.5t-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5 316.5-131.5 131.5-316.5zm512 832q0 52-38 90t-90 38q-54 0-90-38l-343-342q-179 124-399 124-143 0-273.5-55.5t-225-150-150-225-55.5-273.5 55.5-273.5 150-225 225-150 273.5-55.5 273.5 55.5 225 150 150 225 55.5 273.5q0 220-124 399l343 343q37 37 37 90z"/></svg>
<span><?php echo esc_attr_x( 'Search', 'submit button', '_s' ); ?></span></button>
	</form>