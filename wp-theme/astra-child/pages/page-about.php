<?php
/**
 * Template Name: 서비스 소개
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>
<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<div class="mi-static-wrap">

  <!-- 히어로 배너 -->
  <div class="mi-static-hero">
    <div class="mi-container">
      <div class="mi-breadcrumb" style="margin-bottom:20px">
        <a href="<?php echo home_url('/'); ?>">홈</a>
        <span class="sep">›</span>
        <span class="cur">서비스 소개</span>
      </div>
      <h1 class="mi-static-title">머니인포는 <span style="color:var(--mint)">무엇</span>을 합니다</h1>
      <p class="mi-static-lead">복잡하고 흩어져 있는 금융 정보를 누구나 쉽게 쓸 수 있는 형태로 정리합니다.<br>계산기 41종과 5개 분야 콘텐츠로, 돈에 관한 답을 1분 안에 찾을 수 있게 합니다.</p>
    </div>
  </div>

  <div class="mi-container mi-static-body">

    <!-- 핵심 가치 3가지 -->
    <section class="mi-about-values">
      <div class="mi-about-value-card">
        <div class="mi-about-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="7" x2="16" y2="7"/><line x1="8" y1="11" x2="10" y2="11"/><line x1="12" y1="11" x2="14" y2="11"/><line x1="16" y1="11" x2="16" y2="11"/><line x1="8" y1="15" x2="10" y2="15"/><line x1="12" y1="15" x2="14" y2="15"/><line x1="16" y1="15" x2="16" y2="15"/><line x1="8" y1="19" x2="10" y2="19"/><line x1="12" y1="19" x2="14" y2="19"/></svg></div>
        <h3>금융 계산기 41종</h3>
        <p>취득세·연봉 실수령액·연말정산·대출이자·퇴직금까지. 부동산·세금·직장인·대출·투자·청약·가족 7개 분야 41종의 계산기를 무료로 제공합니다.</p>
      </div>
      <div class="mi-about-value-card">
        <div class="mi-about-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><line x1="10" y1="7" x2="18" y2="7"/><line x1="10" y1="11" x2="18" y2="11"/><line x1="10" y1="15" x2="14" y2="15"/></svg></div>
        <h3>매일 업데이트되는 금융 정보</h3>
        <p>정부지원금·세금·부동산·재테크·노후 5개 분야의 최신 정보를 매일 정리합니다. 복잡한 정책 변화를 쉬운 언어로 풀어드립니다.</p>
      </div>
      <div class="mi-about-value-card">
        <div class="mi-about-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></div>
        <h3>신뢰할 수 있는 출처</h3>
        <p>국세청·국토교통부·금융감독원 등 공식 출처를 기반으로 작성합니다. 모든 계산 결과에는 참고 기준과 면책 안내를 명시합니다.</p>
      </div>
    </section>

    <!-- 제작 주체 -->
    <section class="mi-about-maker">
      <h2 class="mi-about-section-title">누가 만드나요</h2>
      <div class="mi-about-maker-card">
        <div class="mi-about-maker-logo">NSIA Lab</div>
        <p>머니인포는 <strong>NSIA Lab</strong>이 기획·운영하는 금융 정보 포털입니다.<br>
        NSIA Lab은 흩어진 공공 정보를 누구나 쉽게 쓸 수 있는 형태로 정리하는 일을 합니다.<br>
        정보 콘텐츠 제작 · 홈페이지 제작 · 콘텐츠 기획 · 영상 제작 분야에서 활동 중입니다.</p>
        <div class="mi-about-maker-links">
          <a href="https://nsialaw.com" target="_blank" rel="noopener">법률길잡이 →</a>
          <a href="mailto:nsialab@daum.net">nsialab@daum.net</a>
        </div>
      </div>
    </section>

    <!-- 면책 안내 -->
    <section class="mi-about-disclaimer">
      <h2 class="mi-about-section-title">이용 안내</h2>
      <ul class="mi-about-list">
        <li>머니인포의 계산 결과는 <strong>참고용</strong>이며 실제 세액·수령액과 다를 수 있습니다.</li>
        <li>세법·정책은 수시로 개정됩니다. 중요한 의사결정 전에는 세무사·공인중개사 등 전문가에게 확인하세요.</li>
        <li>시세 정보(환율·주가지수)는 외부 API 기준으로 실시간과 차이가 있을 수 있습니다.</li>
        <li>머니인포는 특정 금융상품을 추천하거나 중개하지 않습니다.</li>
      </ul>
    </section>

  </div><!-- /.mi-static-body -->
</div><!-- /.mi-static-wrap -->

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
