<?php get_header(); ?>

<main class="container main-content">
    <section class="not-found">
        <p class="error-code">404</p>

        <h1>This page is off the grid.</h1>

        <p class="error-description">
            We couldn't find the page you're looking for.
            Try searching for an article or head back to NextMind.
        </p>

        <form class="header-search error-search"
              role="search"
              method="get"
              action="<?php echo esc_url(home_url('/')); ?>">

            <label class="screen-reader-text" for="error-search-input">
                Search articles
            </label>

            <input
                id="error-search-input"
                type="search"
                name="s"
                placeholder="Search articles..."
                required
            >

            <input type="hidden" name="post_type" value="post">

            <button type="submit">Search</button>
        </form>

        <a class="featured-button"
           href="<?php echo esc_url(home_url('/')); ?>">
            &larr; Back to home
        </a>
    </section>
</main>

<?php get_footer(); ?>