<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('astra-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('moneyinfo-style', get_stylesheet_directory_uri() . '/assets/css/moneyinfo.css', [], '1.10');
    wp_enqueue_script('moneyinfo-js', get_stylesheet_directory_uri() . '/assets/js/moneyinfo.js', [], '1.2', true);
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
// 단일 글(블로그 포스트)에도 커스텀 헤더/푸터 적용
function mi_use_custom_chrome() {
    return mi_is_calc_child() || is_single();
}
add_filter('body_class', function($classes) {
    if (mi_is_calc_child()) {
        $classes[] = 'mi-custom-page';
        $classes[] = 'mi-calc-child';
    } elseif (is_single()) {
        $classes[] = 'mi-custom-page';
        $classes[] = 'mi-single-post';
    }
    return $classes;
});
add_action('wp_body_open', function() {
    if (mi_is_calc_child()) {
        include get_stylesheet_directory() . '/parts/header.php';
        echo '<div class="mi-calc-child-wrap">';
    } elseif (is_single()) {
        include get_stylesheet_directory() . '/parts/header.php';
        echo '<div class="mi-single-wrap">';
    }
}, 5);
add_action('wp_footer', function() {
    if (mi_use_custom_chrome()) echo '</div>';
}, 4);
add_action('wp_footer', function() {
    if (mi_use_custom_chrome()) {
        echo '<style>.site-header,.ast-header,.ast-primary-header-bar,.site-footer,.ast-footer-widget-area,.footer-widget-area{display:none!important}</style>';
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

// ===== SEO 메타데이터 중앙 처리 =====
function mi_seo_data() {
    $og_image = get_stylesheet_directory_uri() . '/assets/og-image.png';
    $defaults = [
        'title'       => '머니인포',
        'description' => '취득세·연봉 실수령액·연말정산·대출이자 등 금융 계산기 41종을 한곳에서 빠르게 사용해보세요.',
        'og_type'     => 'website',
        'og_image'    => $og_image,
        'url'         => home_url('/'),
    ];

    if (is_front_page() || is_home()) {
        $defaults['title']       = '머니인포 — 복잡한 돈 계산, 1분이면 끝납니다';
        $defaults['description'] = '취득세·연봉 실수령액·연말정산·대출이자 등 금융 계산기 41종을 한곳에. 정부지원금·세금·부동산·재테크·노후 정보까지.';
        $defaults['url']         = home_url('/');
        return $defaults;
    }

    if (is_page_template('page-calculator.php')) {
        $defaults['title']       = '금융 계산기 41종 — 머니인포';
        $defaults['description'] = '취득세·연봉 실수령액·연말정산·대출이자 등 금융 계산기 41종. 7개 분야 검색으로 빠르게 찾으세요.';
        $defaults['url']         = get_permalink();
        return $defaults;
    }

    if (is_category()) {
        $cat_desc = [
            'gov-support' => '청년도약계좌·복지지원금 등 정부지원금 최신 정보를 한눈에 확인하세요.',
            'tax'         => '연말정산·종합소득세·양도세 등 세금 절세 전략과 최신 세법 변경사항을 정리합니다.',
            'real-estate' => '취득세·종부세·청약 등 부동산 시장의 최신 정책과 투자 정보를 분석합니다.',
            'invest'      => '예금·주식·ETF·ISA 등 재테크 전략과 금리 비교 정보를 매주 업데이트합니다.',
            'retirement'  => '국민연금·퇴직연금·노후 준비 전략과 가족·생활 금융 정보를 제공합니다.',
        ];
        $cat = get_queried_object();
        if ($cat) {
            $defaults['title']       = $cat->name . ' — 머니인포';
            $defaults['description'] = $cat_desc[$cat->slug] ?? ($cat->description ?: $defaults['description']);
            $defaults['url']         = get_category_link($cat);
        }
        return $defaults;
    }

    if (is_single()) {
        $cats     = get_the_category();
        $cat_name = $cats ? $cats[0]->name : '';
        $title    = get_the_title();
        $defaults['title']       = $title . ($cat_name ? ' — ' . $cat_name : '') . ' — 머니인포';
        $excerpt = get_the_excerpt();
        if (!$excerpt) {
            $excerpt = wp_strip_all_tags(get_the_content(), true);
        }
        $defaults['description'] = mb_substr(trim(preg_replace('/\s+/u', ' ', $excerpt)), 0, 155);
        $defaults['url']         = get_permalink();
        $defaults['og_type']     = 'article';
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if ($thumb) $defaults['og_image'] = $thumb;
        return $defaults;
    }

    if (is_page()) {
        $title = get_the_title();
        if (mi_is_calc_child()) {
            $base = preg_replace('/\s*계산기\s*$/u', '', $title);
            $defaults['title']       = $base . ' 계산기 — 머니인포';
            $defaults['description'] = $base . ' 계산기 — 머니인포에서 빠르고 정확하게 계산해보세요. 무료, 가입 없이 바로 사용 가능합니다.';
        } else {
            $defaults['title'] = $title . ' — 머니인포';
            $excerpt = get_the_excerpt();
            if ($excerpt) {
                $defaults['description'] = mb_substr(trim(preg_replace('/\s+/u', ' ', $excerpt)), 0, 155);
            }
        }
        $defaults['url'] = get_permalink();
        return $defaults;
    }

    return $defaults;
}

// 타이틀 태그를 SEO 함수에서 생성
add_filter('pre_get_document_title', function() {
    $data = mi_seo_data();
    return $data['title'];
}, 99);

// wp_head에 메타 태그 출력
add_action('wp_head', function() {
    $data = mi_seo_data();
    $site = get_bloginfo('name');
    echo "\n<!-- 머니인포 SEO -->\n";
    printf('<meta name="description" content="%s">' . "\n", esc_attr($data['description']));
    printf('<meta property="og:type" content="%s">' . "\n", esc_attr($data['og_type']));
    printf('<meta property="og:site_name" content="%s">' . "\n", esc_attr($site));
    printf('<meta property="og:title" content="%s">' . "\n", esc_attr($data['title']));
    printf('<meta property="og:description" content="%s">' . "\n", esc_attr($data['description']));
    printf('<meta property="og:url" content="%s">' . "\n", esc_url($data['url']));
    printf('<meta property="og:image" content="%s">' . "\n", esc_url($data['og_image']));
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta property="og:locale" content="ko_KR">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    printf('<meta name="twitter:title" content="%s">' . "\n", esc_attr($data['title']));
    printf('<meta name="twitter:description" content="%s">' . "\n", esc_attr($data['description']));
    printf('<meta name="twitter:image" content="%s">' . "\n", esc_url($data['og_image']));
}, 1);

// ===== Schema.org JSON-LD =====
function mi_breadcrumb_schema($items) {
    $list = [];
    foreach ($items as $i => $item) {
        $list[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $item[0],
            'item'     => $item[1],
        ];
    }
    return [
        '@context'        => 'https://schema.org',
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $list,
    ];
}

add_action('wp_head', function() {
    $data     = mi_seo_data();
    $og_image = get_stylesheet_directory_uri() . '/assets/og-image.png';
    $home     = home_url('/');

    $organization = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => '머니인포',
        'url'      => $home,
        'logo'     => $og_image,
    ];

    $schemas = [$organization];

    if (is_front_page() || is_home()) {
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type'    => 'WebSite',
            'name'     => '머니인포',
            'url'      => $home,
            'potentialAction' => [
                '@type'       => 'SearchAction',
                'target'      => $home . 'calculator/?q={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];
    } elseif (is_page_template('page-calculator.php')) {
        $schemas[] = mi_breadcrumb_schema([
            ['홈', $home],
            ['금융 계산기', get_permalink()],
        ]);
        $schemas[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'CollectionPage',
            'name'        => '금융 계산기 41종',
            'description' => $data['description'],
            'url'         => get_permalink(),
        ];
    } elseif (is_category()) {
        $cat = get_queried_object();
        if ($cat) {
            $schemas[] = mi_breadcrumb_schema([
                ['홈', $home],
                [$cat->name, get_category_link($cat)],
            ]);
            $schemas[] = [
                '@context'    => 'https://schema.org',
                '@type'       => 'CollectionPage',
                'name'        => $cat->name,
                'description' => $data['description'],
                'url'         => get_category_link($cat),
            ];
        }
    } elseif (is_single()) {
        $cats     = get_the_category();
        $cat      = $cats ? $cats[0] : null;
        $bc_items = [['홈', $home]];
        if ($cat) $bc_items[] = [$cat->name, get_category_link($cat)];
        $bc_items[]  = [get_the_title(), get_permalink()];
        $schemas[]   = mi_breadcrumb_schema($bc_items);
        $schemas[]   = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Article',
            'headline'      => get_the_title(),
            'description'   => $data['description'],
            'datePublished' => get_the_date('c'),
            'dateModified'  => get_the_modified_date('c'),
            'author'        => ['@type' => 'Organization', 'name' => '머니인포 편집팀'],
            'publisher'     => $organization,
            'image'         => $data['og_image'],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id'   => get_permalink(),
            ],
        ];
    } elseif (is_page()) {
        if (mi_is_calc_child()) {
            $title = get_the_title();
            $base  = preg_replace('/\s*계산기\s*$/u', '', $title);
            $calc_parent = get_page_by_path('calculator');
            $calc_url    = $calc_parent ? get_permalink($calc_parent) : ($home . 'calculator/');
            $schemas[] = mi_breadcrumb_schema([
                ['홈', $home],
                ['금융 계산기', $calc_url],
                [$base . ' 계산기', get_permalink()],
            ]);
            $schemas[] = [
                '@context'            => 'https://schema.org',
                '@type'               => 'WebApplication',
                'name'                => $base . ' 계산기',
                'url'                 => get_permalink(),
                'description'         => $data['description'],
                'applicationCategory' => 'FinanceApplication',
                'operatingSystem'     => 'All',
                'offers'              => [
                    '@type'         => 'Offer',
                    'price'         => '0',
                    'priceCurrency' => 'KRW',
                ],
                'provider' => $organization,
            ];
        } else {
            $schemas[] = mi_breadcrumb_schema([
                ['홈', $home],
                [get_the_title(), get_permalink()],
            ]);
            $schemas[] = [
                '@context'    => 'https://schema.org',
                '@type'       => 'WebPage',
                'name'        => get_the_title(),
                'description' => $data['description'],
                'url'         => get_permalink(),
            ];
        }
    }

    foreach ($schemas as $s) {
        echo "\n" . '<script type="application/ld+json">'
           . wp_json_encode($s, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
           . '</script>';
    }
    echo "\n";
}, 2);

// ===== 사이트맵 + robots.txt 보강 =====
// 저자(users) 사이트맵 제거 - SEO 가치 없음 + 사용자명 노출 방지
add_filter('wp_sitemaps_add_provider', function($provider, $name) {
    return $name === 'users' ? false : $provider;
}, 10, 2);

// robots.txt에 검색/xmlrpc 차단 추가
add_filter('robots_txt', function($output, $public) {
    if ($public != '1') return $output;
    $extra = "Disallow: /?s=\nDisallow: /xmlrpc.php\n";
    if (strpos($output, "\nSitemap:") !== false) {
        $output = str_replace("\nSitemap:", "\n" . $extra . "\nSitemap:", $output);
    } else {
        $output .= "\n" . $extra;
    }
    return $output;
}, 10, 2);
