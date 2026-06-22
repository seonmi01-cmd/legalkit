<?php
$cats_footer = [
  'gov-support'  => '정부지원금',
  'tax'          => '세금·연말정산',
  'real-estate'  => '부동산',
  'invest'       => '재테크',
  'retirement'   => '노후·가족',
];
$calc_url = get_permalink(get_page_by_path('calculator')) ?: home_url('/calculator/');
?>
<footer class="mi-footer">
  <div class="mi-footer-grid">
    <div class="mi-footer-brand">
      <div class="mi-footer-logo">머니인포<span class="mi-logo-dot"></span></div>
      <p>복잡한 금융 계산과 최신 정보를<br>누구나 쉽게. 세금·부동산·재테크까지<br>한곳에서 확인하세요.</p>
    </div>
    <div class="mi-footer-col">
      <h4>계산기</h4>
      <ul>
        <li><a href="<?php echo esc_url($calc_url); ?>#cat-budongsan">부동산</a></li>
        <li><a href="<?php echo esc_url($calc_url); ?>#cat-jikjang">직장인·4대보험</a></li>
        <li><a href="<?php echo esc_url($calc_url); ?>#cat-segeum">세금·신고</a></li>
        <li><a href="<?php echo esc_url($calc_url); ?>#cat-daechul">대출·금융</a></li>
        <li><a href="<?php echo esc_url($calc_url); ?>">전체 보기 →</a></li>
      </ul>
    </div>
    <div class="mi-footer-col">
      <h4>콘텐츠</h4>
      <ul>
        <?php foreach ($cats_footer as $slug => $label): ?>
        <li><a href="<?php echo esc_url(home_url('/category/' . $slug . '/')); ?>"><?php echo esc_html($label); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="mi-footer-col">
      <h4>머니인포</h4>
      <ul>
        <?php
        $footer_pages = [
          'about'   => '서비스 소개',
          'terms'   => '이용약관',
          'privacy' => '개인정보처리방침',
          'contact' => '광고·제휴 문의',
        ];
        foreach ($footer_pages as $slug => $label):
          $page = get_page_by_path($slug);
          $url  = $page ? get_permalink($page) : '#';
        ?>
        <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="mi-footer-bar">
    <p>© <?php echo date('Y'); ?> 머니인포. All rights reserved.</p>
    <p>본 계산 결과와 시세 정보는 참고용이며 실제와 다를 수 있습니다.</p>
  </div>
</footer>
