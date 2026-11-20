<?php
/**
 * Plugin Name: NextMind Admin
 * Description: Custom dashboard styling and shortcuts for NextMind.
 * Version: 1.0.0
 * Author: Rania
 */

if (!defined('ABSPATH')) {
    exit;
}

function nextmind_admin_register_widget() {
    if (!current_user_can('edit_posts')) {
        return;
    }

    wp_add_dashboard_widget(
        'nextmind_studio',
        'NextMind Studio',
        'nextmind_admin_render_widget'
    );
}

add_action('wp_dashboard_setup', 'nextmind_admin_register_widget');

function nextmind_admin_render_widget() {
    $counts = wp_count_posts('post', 'readable');
    ?>
    <div class="nm-studio">
        <p class="nm-eyebrow">YOUR EDITORIAL DESK</p>
        <h3>Welcome to NextMind.</h3>
        <p>Create stories, explore ideas, and keep your readers informed.</p>

        <div class="nm-stats">
            <div>
                <strong>
                    <?php echo esc_html(number_format_i18n($counts->publish)); ?>
                </strong>
                <span>Published articles</span>
            </div>

            <div>
                <strong>
                    <?php echo esc_html(number_format_i18n($counts->draft)); ?>
                </strong>
                <span>Drafts</span>
            </div>
        </div>

        <div class="nm-actions">
            <a class="button button-primary"
               href="<?php echo esc_url(admin_url('post-new.php')); ?>">
                Write an article
            </a>

            <a class="button"
               href="<?php echo esc_url(admin_url('edit.php')); ?>">
                Manage articles
            </a>

            <a class="button"
               href="<?php echo esc_url(home_url('/')); ?>">
                View site
            </a>
        </div>
    </div>
    <?php
}

function nextmind_admin_load_styles($hook_suffix) {
    $css_path = plugin_dir_path(__FILE__) . 'admin.css';

    wp_enqueue_style(
        'nextmind-admin',
        plugin_dir_url(__FILE__) . 'admin.css',
        array(),
        file_exists($css_path) ? (string) filemtime($css_path) : '1.0.0'
    );
}

add_action('admin_enqueue_scripts', 'nextmind_admin_load_styles');

function nextmind_admin_login_styles() {
    $css_path = plugin_dir_path(__FILE__) . 'login.css';

    wp_enqueue_style(
        'nextmind-login',
        plugin_dir_url(__FILE__) . 'login.css',
        array(),
        file_exists($css_path) ? (string) filemtime($css_path) : '1.0.0'
    );
}

add_action('login_enqueue_scripts', 'nextmind_admin_login_styles');

function nextmind_admin_login_logo_url() {
    return home_url('/');
}

add_filter('login_headerurl', 'nextmind_admin_login_logo_url');

function nextmind_admin_login_logo_text() {
    return 'NextMind';
}

add_filter('login_headertext', 'nextmind_admin_login_logo_text');