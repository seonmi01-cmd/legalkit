<?php
/**
 * 단일 글(블로그 포스트) — 커스텀 헤더/푸터 적용
 */
$cats = get_the_category();
$cat  = $cats ? $cats[0] : null;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php the_title(); ?> — <?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page mi-single-post'); ?>>
<?php wp_body_open(); ?>

<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<article class="mi-single-wrap">
  <div class="mi-single-inner">
    <nav class="mi-breadcrumb">
      <a href="<?php echo home_url('/'); ?>">홈</a>
      <span class="sep">›</span>
      <?php if ($cat): ?>
        <a href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
        <span class="sep">›</span>
      <?php endif; ?>
      <span class="cur"><?php the_title(); ?></span>
    </nav>

    <?php while (have_posts()) : the_post(); ?>
      <header class="mi-single-head">
        <h1 class="mi-single-title"><?php the_title(); ?></h1>
        <div class="mi-single-meta">
          <span><?php echo get_the_date('Y.m.d'); ?></span>
          <span>· 머니인포 편집팀</span>
        </div>
      </header>
      <div class="mi-single-content">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</article>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
