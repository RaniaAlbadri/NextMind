<footer class="site-footer">
    <div class="container">

        <?php
        $footer_pages = get_pages(array(
            'post_status' => 'publish',
            'sort_column' => 'post_title',
        ));

        if ($footer_pages) :
            ?>
            <nav class="footer-links" aria-label="Footer navigation">
                <?php foreach ($footer_pages as $footer_page) : ?>
                    <a href="<?php
                        echo esc_url(get_permalink($footer_page->ID));
                    ?>">
                        <?php echo esc_html($footer_page->post_title); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <p>
            &copy; <?php echo esc_html(wp_date('Y')); ?>
            NextMind. AI News, Tools &amp; Ideas.
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>