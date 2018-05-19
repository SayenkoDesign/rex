<?php

// Turn on label visibility
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// On submit scroll back down to form
add_filter( 'gform_confirmation_anchor', '__return_true' );

// Remove scroll to a specific form #5
//add_filter( 'gform_confirmation_anchor_5', '__return_false' );