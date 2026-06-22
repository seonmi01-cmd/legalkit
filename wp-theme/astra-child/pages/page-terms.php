<?php
/**
 * Template Name: 이용약관
 */
$updated = '2026년 6월 22일';
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
  <div class="mi-static-hero mi-static-hero--sm">
    <div class="mi-container">
      <div class="mi-breadcrumb" style="margin-bottom:16px">
        <a href="<?php echo home_url('/'); ?>">홈</a>
        <span class="sep">›</span>
        <span class="cur">이용약관</span>
      </div>
      <h1 class="mi-static-title" style="font-size:28px">이용약관</h1>
      <p style="color:#9fb0c0;font-size:14px;margin-top:8px">시행일: <?php echo $updated; ?></p>
    </div>
  </div>

  <div class="mi-container mi-static-body mi-legal-body">

    <section>
      <h2>제1조 (목적)</h2>
      <p>이 약관은 NSIA Lab(이하 "운영자")이 제공하는 머니인포(infolabm.com, 이하 "서비스")의 이용 조건 및 절차, 운영자와 이용자의 권리·의무 및 책임사항을 규정함을 목적으로 합니다.</p>
    </section>

    <section>
      <h2>제2조 (정의)</h2>
      <ul>
        <li><strong>"서비스"</strong>란 운영자가 제공하는 금융 계산기, 금융 정보 콘텐츠, 시세 정보 등 일체의 서비스를 의미합니다.</li>
        <li><strong>"이용자"</strong>란 서비스에 접속하여 이 약관에 따라 서비스를 이용하는 자를 말합니다.</li>
      </ul>
    </section>

    <section>
      <h2>제3조 (약관의 효력 및 변경)</h2>
      <p>① 이 약관은 서비스 화면에 게시함으로써 효력이 발생합니다.<br>
      ② 운영자는 합리적인 사유가 있을 경우 약관을 개정할 수 있으며, 변경 시 시행일 7일 전에 공지합니다.</p>
    </section>

    <section>
      <h2>제4조 (서비스 이용)</h2>
      <p>① 서비스는 별도의 회원가입 없이 무료로 이용할 수 있습니다.<br>
      ② 이용자는 서비스를 개인적·비상업적 목적으로만 이용할 수 있습니다.<br>
      ③ 서비스의 콘텐츠를 무단으로 복제·배포·수정하거나 상업적으로 이용하는 것을 금지합니다.</p>
    </section>

    <section>
      <h2>제5조 (면책사항)</h2>
      <p>① 서비스가 제공하는 계산 결과, 금융 정보, 시세 정보는 <strong>참고용</strong>이며 실제 세액·수령액·시세와 다를 수 있습니다.<br>
      ② 운영자는 이용자가 서비스를 이용하여 발생한 손해에 대해 법령에서 정한 경우를 제외하고 책임을 지지 않습니다.<br>
      ③ 운영자는 천재지변, 서버 장애 등 불가항력으로 인한 서비스 중단에 대해 책임을 지지 않습니다.</p>
    </section>

    <section>
      <h2>제6조 (지식재산권)</h2>
      <p>서비스 내 콘텐츠(계산기, 글, 디자인 등)에 대한 지식재산권은 운영자에게 있습니다. 이용자는 서비스를 이용하여 얻은 정보를 운영자의 사전 승낙 없이 복제·전송·배포할 수 없습니다.</p>
    </section>

    <section>
      <h2>제7조 (광고)</h2>
      <p>운영자는 서비스 운영을 위해 광고를 게재할 수 있습니다. 광고 클릭 및 외부 사이트 이동으로 인한 손해에 대해 운영자는 책임지지 않습니다.</p>
    </section>

    <section>
      <h2>제8조 (준거법 및 관할)</h2>
      <p>이 약관은 대한민국 법령에 따라 해석되며, 분쟁 발생 시 관할 법원은 민사소송법에 따릅니다.</p>
    </section>

    <div class="mi-legal-contact">
      <p>약관 관련 문의: <a href="mailto:nsialab@daum.net">nsialab@daum.net</a></p>
    </div>

  </div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>
<?php wp_footer(); ?>
</body>
</html>
