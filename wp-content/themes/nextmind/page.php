<?php get_header(); ?>

<main class="container main-content">
    <?php while (have_posts()) : the_post(); ?>

        <article class="article-detail">
            <a class="back-link"
               href="<?php echo esc_url(home_url('/')); ?>">
                &larr; Back to home
            </a>

            <h1><?php the_title(); ?></h1>

            <?php if (has_post_thumbnail()) : ?>
                <div class="article-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="article-body">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>