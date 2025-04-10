<?php get_header(); ?>

<div class="c-homepage">
    <?php 
        $cta = get_field('cta');
    ?>
    <div class="c-homepage__main-content">
        <img class="c-homepage__main-image" src="<?php echo get_template_directory_uri(); ?>/img/heart.gif" alt="">
        <h1 class="c-homepage__title">Welcome to Asha & Law's Journey!</h1>
        <a href="<?php echo $cta['url']; ?>" class="c-homepage__btn">Let's Begin!</a>
    </div>
</div>

<?php get_footer(); ?>