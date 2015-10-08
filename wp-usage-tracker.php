<?php
/**
 * WPTracker
 * Track plugin usage
 *
 * This function gathers plugin usage variables and sends them to an offsite/external tracker.
 *
 * @param string $plugin The plugin name
 * @param string $version The plugin version
 *
 * @version 0.1.4
 * @author Ciprian Popescu <getbutterfly@gmail.com>
 * @copyright 2014-2015 Ciprian Popescu
 * @license GPLv3
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 *
 * @return void
 */
function wp_usage_tracker($plugin, $version) {
    global $wpdb;

    // Set default version and separator
    $t_ver = '0.1.5';
    $t_sep = '|';

    // Gather plugin data
    $usage_get_data = $plugin . $t_sep;
    $usage_get_data .= $version . $t_sep;
    $usage_get_data .= get_bloginfo('version') . $t_sep;
    $usage_get_data .= get_bloginfo('charset') . $t_sep;
    $usage_get_data .= get_bloginfo('url') . $t_sep;
    $usage_get_data .= wptracker_get_ip() . $t_sep;
    $usage_get_data .= get_option('admin_email') . $t_sep;
    $usage_get_data .= sanitize_text_field($_SERVER['SERVER_SOFTWARE']) . $t_sep;
    $usage_get_data .= PHP_VERSION . $t_sep;
    $usage_get_data .= $wpdb->db_version() . $t_sep;
    $usage_get_data .= WP_MEMORY_LIMIT . $t_sep;
    $usage_get_data .= $t_ver;

    $args = array(
        'timeout'     => 120,
        'httpversion' => '1.1',
        'user-agent'  => 'WordPress/' . get_bloginfo('version') . '; ' . get_bloginfo('url'),
        'blocking'    => false,
    );
    $url = 'https://getbutterfly.com/tracker/track.php?data=' . $usage_get_data;

    $response = null;
    $response = wp_remote_get($url, $args);

    if(is_wp_error($response)) {
        $response = file_get_contents($url);
        if(false == $response) {
            $response = $this->curl($url);
            if(null == $response) {
                $response = 0;
            }
        }
    }

    // Discard response body
}

/**
 * Get client IP address
 *
 * This function gets the real IP address of the client
 *
 * @return string
 */
function wptracker_get_ip() {
    foreach(array(
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR'
    ) as $key) {
        if(array_key_exists($key, $_SERVER) === true) {
            foreach(array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
                if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
}

// Run usage tracker
wp_usage_tracker('My Plugin Name', '1.0');
?>
