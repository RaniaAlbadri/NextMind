<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-inner">
        <a class="site-logo"
           href="<?php echo esc_url(home_url('/')); ?>">
            Next<span>Mind</span>
        </a>

        <form class="header-search"
              role="search"
              method="get"
              action="<?php echo esc_url(home_url('/')); ?>">

            <label class="screen-reader-text" for="header-search-input">
                Search articles
            </label>

            <input
                id="header-search-input"
                type="search"
                name="s"
                placeholder="Search articles..."
                value="<?php echo esc_attr(get_search_query()); ?>"
            >

            <input type="hidden" name="post_type" value="post">

            <button type="submit">Search</button>
        </form>
    </div>

    <nav class="category-nav" aria-label="Main navigation">
        <div class="container category-nav-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               <?php if (is_home()) : ?>
                   aria-current="page"
               <?php endif; ?>>
                Home
            </a>

            <?php
            $category_slugs = array(
                'ai-news',
                'ai-tools',
                'explained',
                'reviews-tutorials',
            );

            foreach ($category_slugs as $category_slug) :
                $category = get_category_by_slug($category_slug);

                if (!$category) {
                    continue;
                }

                $category_url = get_category_link($category->term_id);

                if (is_wp_error($category_url)) {
                    continue;
                }
                ?>

                <a href="<?php echo esc_url($category_url); ?>"
                   <?php if (is_category($category->term_id)) : ?>
                       aria-current="page"
                   <?php endif; ?>>
                    <?php echo esc_html($category->name); ?>
                </a>

            <?php endforeach; ?>
        </div>
    </nav>
</header>