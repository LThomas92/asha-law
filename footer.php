<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Asha_&_Law
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="c-popup-modal"> 
  <div class="c-popup-modal__header">
    <h3 class="c-popup-modal__title">Will you be my girlfriend?</h3>
	<svg class="close-icon" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 125">
  <defs>
    <style>
      .cls-1 {
        fill: #fff;
        stroke-width: 0px;
      }
    </style>
  </defs>
  <path class="cls-1" d="M84.7,88.8l-26.3-26.3,26.3-26.3c1.7-1.7,1.7-4.6,0-6.3l-2.1-2.1c-1.7-1.7-4.6-1.7-6.3,0l-26.3,26.3-26.3-26.3c-1.7-1.7-4.6-1.7-6.3,0l-2.1,2.1c-1.7,1.7-1.7,4.6,0,6.3l26.3,26.3-26.3,26.3c-1.7,1.7-1.7,4.6,0,6.3l2.1,2.1c1.7,1.7,4.6,1.7,6.3,0l26.3-26.3,26.3,26.3c1.7,1.7,4.6,1.7,6.3,0l2.1-2.1c1.7-1.8,1.7-4.6,0-6.3Z"/>
</svg>
	</div>
	<div class="c-popup-modal__form">
		<?php echo get_field('girlfriend_form', 'option'); ?>
	</div>

</div>

<?php wp_footer(); ?>

</body>
</html>
