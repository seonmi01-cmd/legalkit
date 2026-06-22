<?php
/**
 * Template Name: 광고·제휴문의
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>광고·제휴 문의 — <?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>
<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<div class="mi-static-wrap">
  <div class="mi-static-hero">
    <div class="mi-container">
      <div class="mi-breadcrumb" style="margin-bottom:20px">
        <a href="<?php echo home_url('/'); ?>">홈</a>
        <span class="sep">›</span>
        <span class="cur">광고·제휴 문의</span>
      </div>
      <h1 class="mi-static-title">광고·제휴 문의</h1>
      <p class="mi-static-lead">머니인포와 함께 성장할 파트너를 찾습니다.<br>광고 게재·콘텐츠 제휴·공동 기획 등 다양한 형태의 협업을 환영합니다.</p>
    </div>
  </div>

  <div class="mi-container mi-static-body">

    <!-- 문의 방법 -->
    <div class="mi-contact-card">
      <div class="mi-contact-icon">✉</div>
      <h2>이메일로 문의해 주세요</h2>
      <a href="mailto:nsialab@daum.net" class="mi-contact-email">nsialab@daum.net</a>
      <p class="mi-contact-guide">문의 이메일에 아래 내용을 포함해 주시면 빠르게 검토하고 답변드립니다.</p>
    </div>

    <!-- 문의 안내 -->
    <div class="mi-contact-guide-box">
      <h3>이메일에 포함할 내용</h3>
      <ol>
        <li><strong>문의 유형</strong> — 광고 게재 / 콘텐츠 제휴 / 기타</li>
        <li><strong>회사명 및 담당자명</strong></li>
        <li><strong>연락처</strong> (이메일 또는 전화)</li>
        <li><strong>제안 내용</strong> — 원하시는 협업 방식을 간략히 설명해 주세요</li>
        <li><strong>예산 또는 규모</strong> (광고인 경우, 선택 사항)</li>
      </ol>
    </div>

    <!-- 협업 유형 -->
    <div class="mi-contact-types">
      <div class="mi-contact-type-card">
        <div class="mi-contact-type-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a5 5 0 0 1 0 8"/><path d="M14 10.5a2 2 0 0 1 0 3"/><path d="M3 11v2a1 1 0 0 0 1 1h2l4 4V7L6 11H4a1 1 0 0 0-1 1z"/></svg></div>
        <h4>광고 게재</h4>
        <p>배너·콘텐츠 광고 등 다양한 광고 형식을 검토합니다. 금융·부동산·보험 관련 업종을 우대합니다.</p>
      </div>
      <div class="mi-contact-type-card">
        <div class="mi-contact-type-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
        <h4>콘텐츠 제휴</h4>
        <p>금융 정보, 시뮬레이터, 계산기 등 콘텐츠 공동 제작 또는 상호 링크 제휴를 논의합니다.</p>
      </div>
      <div class="mi-contact-type-card">
        <div class="mi-contact-type-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><line x1="9" y1="18" x2="15" y2="18"/><line x1="10" y1="22" x2="14" y2="22"/><path d="M12 2a7 7 0 0 1 7 7c0 2.38-1.19 4.47-3 5.74V17a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2.26A7 7 0 0 1 12 2z"/></svg></div>
        <h4>기타 협업</h4>
        <p>서비스 기획·데이터 제공·API 연동 등 다양한 협업 제안도 언제든지 환영합니다.</p>
      </div>
    </div>

    <!-- 제작사 안내 -->
    <div class="mi-contact-maker">
      <p>머니인포는 <strong>NSIA Lab</strong>이 제작·운영합니다.<br>
      NSIA Lab은 정보 콘텐츠 · 홈페이지 제작 · 콘텐츠 기획 · 영상 제작 분야에서 활동 중입니다.</p>
      <a href="https://nsialaw.com" target="_blank" rel="noopener">법률길잡이도 둘러보기 →</a>
    </div>

  </div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
