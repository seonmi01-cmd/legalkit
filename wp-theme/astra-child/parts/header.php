<?php
$current_url = get_permalink();
$nav_items = [
  'calculator'  => ['label' => '계산기',      'url' => get_permalink(get_page_by_path('calculator')) ?: home_url('/calculator/')],
  'gov-support' => ['label' => '정부지원금',   'url' => get_category_link(get_category_by_slug('gov-support')) ?: home_url('/category/gov-support/')],
  'tax'         => ['label' => '세금·연말정산','url' => get_category_link(get_category_by_slug('tax')) ?: home_url('/category/tax/')],
  'real-estate' => ['label' => '부동산',       'url' => get_category_link(get_category_by_slug('real-estate')) ?: home_url('/category/real-estate/')],
  'invest'      => ['label' => '재테크',       'url' => get_category_link(get_category_by_slug('invest')) ?: home_url('/category/invest/')],
  'retirement'  => ['label' => '노후·가족',    'url' => get_category_link(get_category_by_slug('retirement')) ?: home_url('/category/retirement/')],
];
?>
<header class="mi-header">
  <div class="mi-header-inner">
    <a href="<?php echo home_url('/'); ?>" class="mi-logo">
      머니인포<span class="mi-logo-dot"></span>
    </a>
    <nav class="mi-nav">
      <?php foreach ($nav_items as $item): ?>
        <a href="<?php echo esc_url($item['url']); ?>"
           <?php if (rtrim($current_url, '/') === rtrim($item['url'], '/')) echo 'class="active"'; ?>>
          <?php echo esc_html($item['label']); ?>
        </a>
      <?php endforeach; ?>
    </nav>
  </div>
</header>
<div class="mi-ticker">
  <div class="mi-ticker-inner">
    <div class="mi-ticker-live">
      <span class="mi-ticker-dot"></span>
      <span class="mi-ticker-label-txt">실시간</span>
    </div>
    <div class="mi-ticker-items">
      <div class="mi-ticker-item"><span class="lbl">원/달러</span><span class="val" id="mi-t-usd">-</span><span class="chg" id="mi-tc-usd">-</span></div>
      <div class="mi-ticker-item"><span class="lbl">원/엔(100)</span><span class="val" id="mi-t-jpy">-</span><span class="chg" id="mi-tc-jpy">-</span></div>
      <div class="mi-ticker-item"><span class="lbl">원/유로</span><span class="val" id="mi-t-eur">-</span><span class="chg" id="mi-tc-eur">-</span></div>
      <div class="mi-ticker-item"><span class="lbl">KOSPI</span><span class="val">2,742.10</span><span class="chg up">▲ 0.62%</span></div>
      <div class="mi-ticker-item"><span class="lbl">KOSDAQ</span><span class="val">770.34</span><span class="chg down">▼ 0.41%</span></div>
      <div class="mi-ticker-item"><span class="lbl">나스닥</span><span class="val">19,630.2</span><span class="chg up">▲ 0.85%</span></div>
    </div>
    <div class="mi-ticker-time" id="mi-ticker-time"></div>
  </div>
</div>
