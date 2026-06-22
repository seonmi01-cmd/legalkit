<?php
/**
 * Template Name: 개인정보처리방침
 */
$updated = '2026년 6월 22일';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>개인정보처리방침 — <?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>
<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<div class="mi-static-wrap">
  <div class="mi-static-hero mi-static-hero--sm">
    <div class="mi-container">
      <div class="mi-breadcrumb" style="margin-bottom:16px">
        <a href="<?php echo home_url('/'); ?>">홈</a>
        <span class="sep">›</span>
        <span class="cur">개인정보처리방침</span>
      </div>
      <h1 class="mi-static-title" style="font-size:28px">개인정보처리방침</h1>
      <p style="color:#9fb0c0;font-size:14px;margin-top:8px">시행일: <?php echo $updated; ?></p>
    </div>
  </div>

  <div class="mi-container mi-static-body mi-legal-body">

    <p>NSIA Lab(이하 "운영자")은 「개인정보 보호법」에 따라 이용자의 개인정보를 보호하고 이와 관련한 고충을 신속히 처리하기 위해 다음과 같이 개인정보처리방침을 수립·공개합니다.</p>

    <section>
      <h2>제1조 (수집하는 개인정보 항목 및 수집 방법)</h2>
      <p>머니인포(infolabm.com)는 <strong>회원가입 없이 이용 가능한 서비스</strong>로, 별도의 개인정보를 수집하지 않습니다.<br>
      다만, 다음의 정보가 자동으로 생성·수집될 수 있습니다.</p>
      <ul>
        <li>접속 IP 주소, 쿠키, 방문 일시, 서비스 이용 기록 (웹서버 로그)</li>
        <li>Google Analytics 등 분석 도구를 통한 익명 통계 정보</li>
      </ul>
      <p>광고·제휴 문의 이메일 발송 시에는 이용자가 직접 입력한 이메일 주소·성명이 수집됩니다.</p>
    </section>

    <section>
      <h2>제2조 (개인정보의 수집 및 이용 목적)</h2>
      <ul>
        <li>서비스 운영 현황 파악 및 품질 개선</li>
        <li>광고·제휴 문의 응대</li>
        <li>법령상 의무 이행</li>
      </ul>
    </section>

    <section>
      <h2>제3조 (개인정보의 보유 및 이용 기간)</h2>
      <p>수집한 개인정보는 목적 달성 후 즉시 파기합니다. 단, 관계 법령에 의해 보존이 필요한 경우 해당 기간 동안 보존합니다.</p>
      <ul>
        <li>전자상거래 관련 기록: 5년 (전자상거래 등에서의 소비자보호에 관한 법률)</li>
        <li>접속 로그: 3개월 (통신비밀보호법)</li>
      </ul>
    </section>

    <section>
      <h2>제4조 (개인정보의 제3자 제공)</h2>
      <p>운영자는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 법령의 규정에 의하거나 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우는 예외입니다.</p>
    </section>

    <section>
      <h2>제5조 (쿠키의 사용)</h2>
      <p>서비스는 이용 편의를 위해 쿠키(cookie)를 사용할 수 있습니다. 쿠키는 브라우저 설정에서 거부할 수 있으며, 거부 시 일부 서비스 이용이 제한될 수 있습니다.</p>
    </section>

    <section>
      <h2>제6조 (개인정보의 파기)</h2>
      <p>보유 기간이 경과하거나 처리 목적이 달성된 개인정보는 지체 없이 파기합니다. 전자적 파일은 복구 불가능한 방법으로 영구 삭제합니다.</p>
    </section>

    <section>
      <h2>제7조 (이용자의 권리)</h2>
      <p>이용자는 언제든지 개인정보 열람·정정·삭제·처리정지 요청을 할 수 있습니다. 요청은 아래 개인정보 보호책임자에게 이메일로 문의해 주세요.</p>
    </section>

    <section>
      <h2>제8조 (개인정보 보호책임자)</h2>
      <table class="mi-legal-table">
        <tr><th>구분</th><th>내용</th></tr>
        <tr><td>운영사</td><td>NSIA Lab</td></tr>
        <tr><td>이메일</td><td><a href="mailto:nsialab@daum.net">nsialab@daum.net</a></td></tr>
      </table>
    </section>

    <section>
      <h2>제9조 (개인정보처리방침의 변경)</h2>
      <p>이 방침은 시행일로부터 적용되며, 변경 시 서비스 화면을 통해 사전 공지합니다.</p>
    </section>

    <div class="mi-legal-contact">
      <p>개인정보 관련 문의: <a href="mailto:nsialab@daum.net">nsialab@daum.net</a></p>
    </div>

  </div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
