<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('astra-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('moneyinfo-style', get_stylesheet_directory_uri() . '/assets/css/moneyinfo.css', [], '1.0');
    wp_enqueue_script('moneyinfo-js', get_stylesheet_directory_uri() . '/assets/js/moneyinfo.js', [], '1.0', true);
});

// 실시간 환율 AJAX (서버사이드 fallback)
add_action('wp_ajax_nopriv_mi_ticker', 'mi_ticker_handler');
add_action('wp_ajax_mi_ticker', 'mi_ticker_handler');
function mi_ticker_handler() {
    $response = wp_remote_get('https://open.er-api.com/v6/latest/USD', ['timeout' => 5]);
    if (is_wp_error($response)) {
        wp_send_json_error();
    }
    $data = json_decode(wp_remote_retrieve_body($response), true);
    wp_send_json_success($data['rates'] ?? []);
}

// 머니인포 페이지 템플릿 등록
add_filter('theme_page_templates', function($templates) {
    $templates['page-calculator-tpl.php'] = '금융 계산기 목록';
    return $templates;
});
