<?php
/**
 * Template Name: 금융 계산기 목록
 *
 * 이 파일을 WordPress 페이지에 적용하면
 * Astra 헤더를 완전히 대체하는 풀커스텀 레이아웃이 적용됩니다.
 */
$calc_url = get_permalink();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>금융 계산기 41종 — <?php bloginfo('name'); ?></title>
  <meta name="description" content="취득세·연봉 실수령액·연말정산·대출이자 등 금융 계산기 41종. 8개 분야 검색으로 빠르게 찾으세요.">
  <style>html { scroll-behavior: smooth; } .mi-calc-section-block { scroll-margin-top: 140px; }</style>
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?>>
<?php wp_body_open(); ?>

<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<!-- ===== 인트로 ===== -->
<div class="mi-intro-section">
  <div class="mi-intro-inner">
    <nav class="mi-breadcrumb">
      <a href="<?php echo home_url('/'); ?>">홈</a>
      <span class="sep">›</span>
      <span class="cur">계산기</span>
    </nav>
    <div class="mi-intro-hd">
      <h1 class="mi-page-title">금융 계산기</h1>
      <span class="mi-page-badge">41종 · 7개 분야</span>
    </div>
    <p class="mi-intro-desc">세금·부동산·대출부터 청약까지, 자주 쓰는 금융 계산기를 한곳에. 찾는 항목을 검색하거나 분야에서 골라 바로 계산하세요.</p>
    <div class="mi-search-wrap">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5b6876" stroke-width="2" stroke-linecap="round">
        <circle cx="11" cy="11" r="7"/><line x1="20.5" y1="20.5" x2="16.5" y2="16.5"/>
      </svg>
      <input id="mi-calc-input" type="text" placeholder="계산기 검색 (예: 연봉 실수령액, 취득세)" autocomplete="off">
      <button class="mi-search-clear" id="mi-clear-btn">초기화</button>
    </div>
    <div class="mi-popular-chips">
      <span class="mi-popular-label">인기 검색</span>
      <span class="mi-chip" data-q="연봉 실수령액">연봉 실수령액</span>
      <span class="mi-chip" data-q="취득세">취득세</span>
      <span class="mi-chip" data-q="양도소득세">양도소득세</span>
      <span class="mi-chip" data-q="퇴직금">퇴직금</span>
      <span class="mi-chip" data-q="전월세 전환">전월세 전환</span>
    </div>
  </div>
</div>

<!-- 검색 결과 수 -->
<div class="mi-container" style="padding-top:0">
  <div class="mi-search-info" id="mi-search-info"></div>
</div>

<!-- ===== 스티키 분야 탭 ===== -->
<nav class="mi-sticky-nav" id="mi-sticky-nav">
  <div class="mi-sticky-nav-inner">
    <a href="#cat-budongsan"   class="mi-cat-chip">부동산 7</a>
    <a href="#cat-jikjang"     class="mi-cat-chip">직장인·4대보험 6</a>
    <a href="#cat-segeum"      class="mi-cat-chip">세금·신고 11</a>
    <a href="#cat-daechul"     class="mi-cat-chip">대출·금융 4</a>
    <a href="#cat-investment"  class="mi-cat-chip">투자·절세 4</a>
    <a href="#cat-cheongnyeon" class="mi-cat-chip">청년·청약 4</a>
    <a href="#cat-gajok"       class="mi-cat-chip">가족·생활 5</a>
  </div>
</nav>

<!-- ===== 계산기 카드 (JS로 렌더링) ===== -->
<div class="mi-calc-section-page">
  <div class="mi-empty-state" id="mi-empty-state">
    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#c0cbd6" stroke-width="2" stroke-linecap="round">
      <circle cx="17" cy="17" r="11"/><line x1="26" y1="26" x2="36" y2="36"/>
    </svg>
    <p>검색 결과가 없습니다. 다른 키워드로 검색해보세요.</p>
  </div>
  <div id="mi-calc-sections"></div>
</div>

<?php include get_stylesheet_directory() . '/parts/footer.php'; ?>

<script>
window.MI_CALC_DATA = <?php echo json_encode([
  ['id'=>'cat-budongsan','name'=>'부동산','items'=>[
    ['name'=>'취득세',       'desc'=>'주택·부동산 매입 시 취득세 계산',     'url'=>home_url('/calculator/acquisition-tax/')],
    ['name'=>'중개수수료',   'desc'=>'매매·전월세 중개보수 상한 계산',       'url'=>home_url('/calculator/brokerage/')],
    ['name'=>'전월세 전환',  'desc'=>'전세↔월세 전환율로 환산',             'url'=>home_url('/calculator/rent-conversion/')],
    ['name'=>'임대수익률',   'desc'=>'임대 투자 연 수익률 계산',             'url'=>home_url('/calculator/rental-yield/')],
    ['name'=>'등기비용',     'desc'=>'소유권 이전 등기비용 계산',             'url'=>home_url('/calculator/registration/')],
    ['name'=>'평수 환산',    'desc'=>'평↔제곱미터 면적 환산',               'url'=>home_url('/calculator/pyeong/')],
    ['name'=>'국민주택채권', 'desc'=>'매입 채권 본인부담금 계산',             'url'=>home_url('/calculator/housing-bond/')],
  ]],
  ['id'=>'cat-jikjang','name'=>'직장인·4대보험','items'=>[
    ['name'=>'연봉 실수령액', 'desc'=>'4대보험·세금 제외 실수령액',          'url'=>home_url('/calculator/net-salary/')],
    ['name'=>'실업급여',      'desc'=>'수급 기간·일액 계산',                 'url'=>home_url('/calculator/unemployment/')],
    ['name'=>'퇴직금',        'desc'=>'평균임금 기준 퇴직금 계산',           'url'=>home_url('/calculator/severance/')],
    ['name'=>'국민연금',      'desc'=>'예상 수령액 추정',                     'url'=>home_url('/calculator/pension/')],
    ['name'=>'건강보험료',    'desc'=>'직장·지역·피부양자 보험료',           'url'=>home_url('/calculator/health-insurance/')],
    ['name'=>'연장·야간수당', 'desc'=>'가산수당 계산',                        'url'=>home_url('/calculator/overtime/')],
  ]],
  ['id'=>'cat-segeum','name'=>'세금·신고','items'=>[
    ['name'=>'연말정산',       'desc'=>'환급·추가납부액 계산',               'url'=>home_url('/calculator/yearend-tax/')],
    ['name'=>'종합소득세',     'desc'=>'누진세율 기준 소득세 계산',           'url'=>home_url('/calculator/income-tax/')],
    ['name'=>'프리랜서 3.3%', 'desc'=>'원천징수 환급액 계산',                'url'=>home_url('/calculator/freelancer/')],
    ['name'=>'부가가치세',     'desc'=>'매출·매입 부가세 계산',               'url'=>home_url('/calculator/vat/')],
    ['name'=>'법인세',         'desc'=>'과세표준별 법인세 계산',              'url'=>home_url('/calculator/corp-tax/')],
    ['name'=>'월세 세액공제',  'desc'=>'월세 세액공제액 계산',                'url'=>home_url('/calculator/rent-credit/')],
    ['name'=>'카드 황금비율',  'desc'=>'소득공제 극대화 사용액',              'url'=>home_url('/calculator/card-ratio/')],
    ['name'=>'부양가족 공제',  'desc'=>'인적공제 대상·금액 확인',             'url'=>home_url('/calculator/dependents/')],
    ['name'=>'종합부동산세',   'desc'=>'종부세 과세표준·세액 계산',           'url'=>home_url('/calculator/jongbu-tax/')],
    ['name'=>'증여세',         'desc'=>'증여재산 세액 계산',                  'url'=>home_url('/calculator/gift-tax/')],
    ['name'=>'양도소득세',     'desc'=>'양도차익 세액 계산',                  'url'=>home_url('/calculator/capital-gains/')],
  ]],
  ['id'=>'cat-daechul','name'=>'대출·금융','items'=>[
    ['name'=>'대출이자',       'desc'=>'원리금·이자 상환액 계산',            'url'=>home_url('/calculator/loan-interest/')],
    ['name'=>'예적금 이자',    'desc'=>'만기 이자·세후 수령액',              'url'=>home_url('/calculator/savings/')],
    ['name'=>'중도상환수수료', 'desc'=>'조기상환 수수료 계산',                'url'=>home_url('/calculator/prepayment/')],
    ['name'=>'DSR·DTI·LTV',  'desc'=>'대출 한도 지표 계산',                 'url'=>home_url('/calculator/dsr-dti-ltv/')],
  ]],
  ['id'=>'cat-investment','name'=>'투자·절세','items'=>[
    ['name'=>'코인 세금',      'desc'=>'가상자산 양도세 계산 (2027년 시행)', 'url'=>home_url('/calculator/crypto-tax/')],
    ['name'=>'ISA·IRP 절세',  'desc'=>'절세 혜택·환급 계산',                'url'=>home_url('/calculator/isa-irp/')],
    ['name'=>'주식 배당세',    'desc'=>'배당소득세 계산',                     'url'=>home_url('/calculator/dividend-tax/')],
    ['name'=>'해외주식 양도세','desc'=>'해외주식 매도 양도세 계산',           'url'=>home_url('/calculator/crypto-tax/')],
  ]],
  ['id'=>'cat-cheongnyeon','name'=>'청년·청약','items'=>[
    ['name'=>'청년도약계좌',       'desc'=>'만기 수령액·매칭 계산',          'url'=>home_url('/calculator/youth-leap/')],
    ['name'=>'청약 가점',          'desc'=>'청약 가점 산정',                  'url'=>home_url('/calculator/housing-score/')],
    ['name'=>'청년전세대출 이자',  'desc'=>'버팀목·청년 전세대출 이자 계산', 'url'=>home_url('/calculator/loan-interest/')],
    ['name'=>'청약 당첨확률',      'desc'=>'가점·추첨 당첨확률 시뮬레이션', 'url'=>home_url('/calculator/housing-score/')],
  ]],
  ['id'=>'cat-gajok','name'=>'가족·생활','items'=>[
    ['name'=>'근로·자녀장려금', 'desc'=>'장려금 자격·금액 산정',            'url'=>home_url('/calculator/eitc/')],
    ['name'=>'출산·부모급여',   'desc'=>'출산·부모급여 수령액 계산',         'url'=>home_url('/calculator/birth-benefit/')],
    ['name'=>'상속세',           'desc'=>'상속재산 세액 계산',               'url'=>home_url('/calculator/gift-tax/')],
    ['name'=>'자동차세',         'desc'=>'배기량 기준 자동차세 계산',         'url'=>home_url('/calculator/car-tax/')],
    ['name'=>'최저임금',         'desc'=>'시급·월급 환산',                   'url'=>home_url('/calculator/min-wage/')],
  ]],
], JSON_UNESCAPED_UNICODE); ?>;
</script>
<?php wp_footer(); ?>
</body>
</html>
