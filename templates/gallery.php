<?php
global $jpb_gallery_attachments, $jpb_gallery_size;
?>
<div class="gallery">
	<?php foreach ($jpb_gallery_attachments as $att_id => $attachment) { ?>
		<?php
		$default_attr = array(
						'class' => "attachment-$size img-thumbnail",
		);
		?>
		<a href="<?php echo get_attachment_link($att_id) ?>"><?php echo wp_get_attachment_image($att_id, $jpb_gallery_size, false, $default_attr) ?></a>
	<?php } ?>
</div>


