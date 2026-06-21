<?php
/**
 * 콘텐츠 카테고리 공통 렌더러
 *
 * 각 category-{slug}.php 파일에서 변수를 설정하고 이 파일을 include합니다.
 * 필요 변수:
 *   string $mi_accent      포인트 컬러 HEX (예: '#0ca678')
 *   string $mi_accent_bg   배경 컬러 HEX  (예: '#e9f8f1')
 *   string $mi_intro_desc  인트로 소개 문구
 *   array  $mi_topics      토픽 칩 배열 (예: ['청년', '복지', '창업'])
 *   array  $mi_dummy       더미 글 배열 (실제 글 없을 때 표시)
 */

$cat_obj  = get_queried_object();
$cat_name = $cat_obj ? $cat_obj->name : '콘텐츠';

// 실제 WordPress 글 가져오기 (있으면 더미 대체)
$use_dummy = true;
if ($cat_obj && $cat_obj->count > 0) {
  $wp_posts = get_posts([
    'category'    => $cat_obj->term_id,
    'numberposts' => 12,
    'post_status' => 'publish',
  ]);
  if (!empty($wp_posts)) {
    $use_dummy = false;
    $articles = array_map(function($p) use ($cat_obj) {
      $tags  = get_the_tags($p->ID);
      $topic = $tags ? $tags[0]->name : ($cat_obj ? $cat_obj->name : '');
      return [
        'title'    => get_the_title($p),
        'excerpt'  => wp_trim_words(get_the_excerpt($p) ?: strip_tags($p->post_content), 28),
        'topic'    => $topic,
        'date'     => get_the_date('Y.m.d', $p),
        'url'      => get_permalink($p),
        'readtime' => max(1, (int) ceil(str_word_count(strip_tags($p->post_content)) / 200)),
      ];
    }, $wp_posts);
  }
}
if ($use_dummy) {
  $articles = $mi_dummy ?? [];
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo esc_html($cat_name); ?> — <?php bloginfo('name'); ?></title>
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
  <div class="mi-featured-card" id="mi-featured">
    <!-- JS로 채워짐 -->
  </div>

  <div class="mi-posts-label">최신 글</div>
  <div class="mi-posts-grid" id="mi-posts-grid">
    <!-- JS로 채워짐 -->
  </div>

  <div class="mi-more-btn">
    <?php if ($cat_obj): ?>
    <a href="<?php echo esc_url(get_category_link($cat_obj)); ?>">글 더보기 →</a>
    <?php endif; ?>
  </div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>

<script>
window.MI_CONTENT_DATA = <?php echo json_encode(array_values($articles), JSON_UNESCAPED_UNICODE); ?>;
</script>
<?php wp_footer(); ?>
</body>
</html>
