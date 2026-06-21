<?php
/**
 * 콘텐츠 카테고리 공통 템플릿
 * (category-gov-support.php 등에서 include해서 사용)
 *
 * 필요 변수:
 *   $mi_accent     - 포인트 컬러 (hex)
 *   $mi_accent_bg  - 배경 컬러 (hex)
 *   $mi_topics     - 토픽 배열 ['전체', '청년', ...]
 *   $mi_dummy      - 더미 글 배열 (실제 글 없을 때)
 */

$cat_obj   = get_queried_object();
$cat_name  = $cat_obj ? $cat_obj->name : '콘텐츠';
$cat_slug  = $cat_obj ? $cat_obj->slug : '';
$calc_url  = get_permalink(get_page_by_path('calculator')) ?: home_url('/calculator/');

// 실제 글 가져오기
$wp_posts = get_posts([
  'category'    => $cat_obj ? $cat_obj->term_id : 0,
  'numberposts' => 12,
  'post_status' => 'publish',
]);

// 실제 글이 있으면 사용, 없으면 더미
if (!empty($wp_posts)) {
  $articles = array_map(function($p) use ($cat_obj, $mi_accent, $mi_accent_bg) {
    $tags = get_the_tags($p->ID);
    $topic = $tags ? $tags[0]->name : ($cat_obj ? $cat_obj->name : '');
    return [
      'title'    => get_the_title($p),
      'excerpt'  => wp_trim_words(get_the_excerpt($p) ?: strip_tags($p->post_content), 30),
      'topic'    => $topic,
      'date'     => get_the_date('Y.m.d', $p),
      'url'      => get_permalink($p),
      'readtime' => max(1, ceil(str_word_count(strip_tags($p->post_content)) / 200)),
    ];
  }, $wp_posts);
} else {
  $articles = $mi_dummy ?? [];
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo esc_html($cat_name); ?> — 머니인포</title>
  <style>
    :root {
      --accent:    <?php echo esc_attr($mi_accent ?? '#0ca678'); ?>;
      --accent-bg: <?php echo esc_attr($mi_accent_bg ?? '#e9f8f1'); ?>;
    }
  </style>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>

<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<!-- ===== 인트로 ===== -->
<div class="mi-content-intro">
  <div class="mi-content-intro-inner">
    <nav class="mi-breadcrumb">
      <a href="<?php echo home_url('/'); ?>">홈</a>
      <span class="sep">›</span>
      <span class="cur" style="color:var(--accent)"><?php echo esc_html($cat_name); ?></span>
    </nav>
    <h1 class="mi-page-title" style="margin:14px 0 10px"><?php echo esc_html($cat_name); ?></h1>
    <p class="mi-intro-desc"><?php echo esc_html($mi_intro_desc ?? $cat_name . ' 관련 최신 금융 정보를 매일 업데이트합니다.'); ?></p>
    <div class="mi-topic-chips">
      <?php
      $all_topics = array_merge(['전체'], $mi_topics ?? []);
      foreach ($all_topics as $idx => $topic): ?>
        <span class="mi-topic-chip <?php echo $idx === 0 ? 'active' : ''; ?>"
              data-topic="<?php echo esc_attr($topic); ?>">
          <?php echo esc_html($topic); ?>
        </span>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ===== 글 목록 ===== -->
<div class="mi-content-body">
  <!-- 대표글 -->
  <div class="mi-featured-card" id="mi-featured"></div>

  <div class="mi-posts-label">최신 글</div>
  <div class="mi-posts-grid" id="mi-posts-grid"></div>

  <div class="mi-more-btn">
    <?php if ($cat_obj): ?>
    <a href="<?php echo get_category_link($cat_obj); ?>">글 더보기 →</a>
    <?php endif; ?>
  </div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>

<script>
window.MI_CONTENT_DATA = <?php echo json_encode(array_values($articles)); ?>;
</script>
<?php wp_footer(); ?>
</body>
</html>
