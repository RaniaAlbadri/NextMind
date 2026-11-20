<?php get_header(); ?>
<main class="container main-content">

    <?php if (is_singular()) : ?>

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
                    <?php echo esc_html(get_the_date()); ?>
                    · By <?php echo esc_html(get_the_author()); ?>
                </p>

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

    <?php else : ?>

        <section class="intro">
            <p class="eyebrow">EXPLORE. UNDERSTAND. STAY INFORMED.</p>

            <?php if (is_home()) : ?>
                <h1>A clearer view of<br>artificial intelligence.</h1>
                <p>
                    Discover AI news, useful tools, and ideas
                    that make technology easier to understand.
                </p>
            <?php elseif (is_archive()) : ?>
                <h1><?php the_archive_title(); ?></h1>
            <?php elseif (is_search()) : ?>
                <h1>
                    Search: <?php echo esc_html(get_search_query()); ?>
                </h1>
            <?php else : ?>
                <h1>Page not found</h1>
                <p>Try searching for an article below.</p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </section>

        <?php
        if (is_home() && !is_paged()) :

            $sticky_ids = array_filter(
                array_map('absint', (array) get_option('sticky_posts', array()))
            );

            $featured_args = array(
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => 1,
                'ignore_sticky_posts' => true,
                'no_found_rows'       => true,
                'orderby'            => 'date',
                'order'              => 'DESC',
            );

            if (!empty($sticky_ids)) {
                $featured_args['post__in'] = $sticky_ids;
            }

            $featured_query = new WP_Query($featured_args);

            // إذا لم يوجد مقال مثبّت منشور، نعرض أحدث مقال.
            if (!$featured_query->have_posts() && !empty($sticky_ids)) {
                unset($featured_args['post__in']);
                $featured_query = new WP_Query($featured_args);
            }
            if ($featured_query->have_posts()) :
                while ($featured_query->have_posts()) :
                    $featured_query->the_post();
                    ?>

                    <section class="featured-story"
                            aria-labelledby="featured-title">

                        <a class="featured-visual"
                        href="<?php the_permalink(); ?>"
                        aria-label="<?php the_title_attribute(); ?>">

                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <div class="featured-placeholder">
                                    <span>NextMind</span>
                                    <p>A closer look at what comes next.</p>
                                </div>
                            <?php endif; ?>

                        </a>

                        <div class="featured-content">
                            <p class="eyebrow">FEATURED STORY</p>

                            <div class="post-categories">
                                <?php the_category(' · '); ?>
                            </div>

                            <h2 id="featured-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="post-meta">
                                <?php echo esc_html(get_the_date()); ?>
                                · By <?php echo esc_html(get_the_author()); ?>
                            </p>

                            <p class="featured-excerpt">
                                <?php
                                echo esc_html(
                                    wp_trim_words(get_the_excerpt(), 32)
                                );
                                ?>
                            </p>

                            <a class="featured-button"
                            href="<?php the_permalink(); ?>">
                                Read the story &rarr;
                            </a>
                        </div>
                    </section>

                    <?php
                endwhile;
            endif;

            wp_reset_postdata();
        endif;
        ?>

        <?php if (have_posts()) : ?>

            <h2 class="section-title">
                <?php echo is_home() ? 'Latest articles' : 'Articles'; ?>
            </h2>

            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>

                    <article class="post-card">
                        <a class="post-image"
                           aria-label="<?php the_title_attribute(); ?>"
                           href="<?php the_permalink(); ?>">

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

                            <p class="post-excerpt">
                                <?php
                                echo esc_html(
                                    wp_trim_words(get_the_excerpt(), 24)
                                );
                                ?>
                            </p>

                            <a class="read-more"
                               href="<?php the_permalink(); ?>">
                                Read article &rarr;
                            </a>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size'  => 1,
                'prev_text' => 'Previous',
                'next_text' => 'Next',
            ));
            ?>

        <?php elseif (!is_404()) : ?>
            <p>No articles found yet.</p>
        <?php endif; ?>

    <?php endif; ?>

</main>



<?php get_footer(); ?>
