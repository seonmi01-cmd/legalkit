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

// 계산기 하위 페이지에 커스텀 헤더/푸터 적용
function mi_is_calc_child() {
    global $post;
    if (!$post) return false;
    $calc = get_page_by_path('calculator');
    $calc_id = $calc ? $calc->ID : 35;
    $ancestors = get_post_ancestors($post);
    return in_array($calc_id, $ancestors) || $post->post_parent == $calc_id;
}
add_filter('body_class', function($classes) {
    if (mi_is_calc_child()) {
        $classes[] = 'mi-custom-page';
        $classes[] = 'mi-calc-child';
    }
    return $classes;
});
add_action('wp_body_open', function() {
    if (mi_is_calc_child()) {
        include get_stylesheet_directory() . '/parts/header.php';
        echo '<div class="mi-calc-child-wrap">';
    }
}, 5);
add_action('wp_footer', function() {
    if (mi_is_calc_child()) echo '</div>';
}, 4);
add_action('wp_footer', function() {
    if (mi_is_calc_child()) {
        echo '<style>.site-footer,.ast-footer-widget-area,.footer-widget-area{display:none!important}</style>';
        include get_stylesheet_directory() . '/parts/footer.php';
    }
}, 5);

// 머니인포 페이지 템플릿 등록
add_filter('theme_page_templates', function($templates) {
    $templates['page-calculator.php']        = '금융 계산기 목록';
    $templates['pages/page-about.php']       = '서비스 소개';
    $templates['pages/page-terms.php']       = '이용약관';
    $templates['pages/page-privacy.php']     = '개인정보처리방침';
    $templates['pages/page-contact.php']     = '광고·제휴 문의';
    return $templates;
});
