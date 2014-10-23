<?php

// Colocar en el functions.php
function metabox_callback()
{
	?>
	<p>Aquí va el contenido...</p>
	<?php

}

function adding_custom_meta_boxes()
{
	add_meta_box(
					'metabox-id', 'Metabox Title', 'metabox_callback', 'post-type', 'side', 'high'
	);
}

add_action('add_meta_boxes', 'adding_custom_meta_boxes', 10, 2);
