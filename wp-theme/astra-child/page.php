<?php
/**
 * 계산기 하위 페이지 → 커스텀 헤더/푸터
 * 그 외 페이지 → Astra 기본 page.php
 */
global $post;
$calc_page = get_page_by_path('calculator');
$calc_id   = $calc_page ? $calc_page->ID : 35;
$ancestors = $post ? get_post_ancestors($post) : [];
$is_calc   = in_array($calc_id, $ancestors) || ($post && $post->post_parent == $calc_id);

if (!$is_calc) {
    include get_template_directory() . '/page.php';
    return;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php the_title(); ?> — <?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>
<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<div style="min-height:80vh">
<?php while (have_posts()) { the_post(); the_content(); } ?>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
