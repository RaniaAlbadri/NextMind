<?php get_header(); ?>

<main class="container main-content">
    <?php while (have_posts()) : the_post(); ?>

        <article class="article-detail">
            <a class="back-link"
               href="<?php echo esc_url(home_url('/')); ?>">
                &larr; Back to home
            </a>

            <div class="post-categories">
                <?php the_category(' · '); ?>
            </div>

            <h1><?php the_title(); ?></h1>

            <p class="post-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date()); ?>
                </time>
                · By <?php echo esc_html(get_the_author()); ?>
            </p>

            <?php if (has_post_thumbnail()) : ?>
                <div class="article-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="article-body">
                <?php the_content(); ?>

                <?php
                wp_link_pages(array(
                    'before' => '<nav aria-label="Article pages">Pages: ',
                    'after'  => '</nav>',
                ));
                ?>
            </div>

            <?php if (has_tag()) : ?>
                <div class="article-tags">
                    <span class="tags-label">Topics</span>
                    <?php the_tags('', ' ', ''); ?>
                </div>
            <?php endif; ?>

            <?php
            the_post_navigation(array(
                'prev_text' =>
                    '<span class="post-nav-label">Previous article</span>'
                    . '<span class="post-nav-title">%title</span>',

                'next_text' =>
                    '<span class="post-nav-label">Next article</span>'
                    . '<span class="post-nav-title">%title</span>',
            ));
            ?>
        </article>

    <?php endwhile; ?>

    <?php
        $current_post_id = get_queried_object_id();
        $category_ids = wp_get_post_categories($current_post_id);

        if (!empty($category_ids) && !is_wp_error($category_ids)) :

            $related_query = new WP_Query(array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => 3,
                'post__not_in'        => array($current_post_id),
                'category__in'        => $category_ids,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
            ));

            if ($related_query->have_posts()) :
                ?>

                <section class="related-posts" aria-labelledby="related-heading">
                    <h2 id="related-heading" class="section-title">
                        More on this topic
                    </h2>

                    <div class="posts-grid">
                        <?php
                        while ($related_query->have_posts()) :
                            $related_query->the_post();
                            ?>

                            <article class="post-card">
                                <a class="post-image"
                                href="<?php the_permalink(); ?>"
                                aria-label="<?php the_title_attribute(); ?>">

                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    <?php else : ?>
                                        <div class="image-placeholder">
                                            <span>NextMind</span>
                                            <small>IDEAS FOR WHAT COMES NEXT</small>
                                        </div>
                                    <?php endif; ?>
                                </a>

                                <div class="post-card-content">
                                    <div class="post-categories">
                                        <?php the_category(' · '); ?>
                                    </div>

                                    <h3>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <p class="post-meta">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </p>

                                    <a class="read-more"
                                    href="<?php the_permalink(); ?>">
                                        Read article &rarr;
                                    </a>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>
                </section>

                <?php
            endif;

            wp_reset_postdata();
        endif;
    ?>
</main>

<?php get_footer(); ?>