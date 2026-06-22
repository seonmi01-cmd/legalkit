<?php
/**
 * 머니인포 홈페이지 템플릿
 */
$calc_url = get_permalink(get_page_by_path('calculator'));
if (!$calc_url) $calc_url = home_url('/calculator/');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('mi-custom-page'); ?> data-calc-url="<?php echo esc_url($calc_url); ?>">
<?php wp_body_open(); ?>

<?php include get_stylesheet_directory() . '/parts/header.php'; ?>

<!-- ===== 히어로 ===== -->
<section class="mi-hero">
  <div class="mi-hero-inner">
    <div class="mi-hero-left">
      <div class="mi-hero-badge">
        <span class="mi-hero-badge-dot"></span>
        금융 계산기 41종 · 매일 업데이트
      </div>
      <h1>복잡한 돈 계산,<br>머니인포에서 <span class="mint">1분</span>이면 끝납니다</h1>
      <p class="mi-hero-desc">취득세부터 연봉 실수령액까지, 자주 쓰는 금융 계산을 한곳에서.</p>
      <div class="mi-search-box">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5b6876" stroke-width="2" stroke-linecap="round">
          <circle cx="11" cy="11" r="7"/><line x1="20.5" y1="20.5" x2="16.5" y2="16.5"/>
        </svg>
        <input id="mi-hero-search" type="text" placeholder="예) 연봉 실수령액, 취득세, 양도세" autocomplete="off">
        <button class="mi-search-btn" onclick="miHeroSearch()">검색</button>
      </div>
      <div class="mi-hero-popular">
        <span>인기 검색</span>
        <span class="mi-hero-chip" onclick="miHeroChip('연봉 실수령액')">연봉 실수령액</span>
        <span class="mi-hero-chip" onclick="miHeroChip('취득세')">취득세</span>
        <span class="mi-hero-chip" onclick="miHeroChip('퇴직금')">퇴직금</span>
      </div>
    </div>
    <div>
      <div class="mi-top5-card">
        <div class="mi-top5-hd">
          <span class="mi-top5-hd-name">실시간 인기 계산기</span>
          <span class="mi-top5-hd-badge">TOP 5</span>
        </div>
        <ul class="mi-top5-list">
          <?php
          $top5 = [
            ['연봉 실수령액', '직장인·4대보험', home_url('/calculator/net-salary/')],
            ['취득세',        '부동산',         home_url('/calculator/acquisition-tax/')],
            ['양도소득세',    '세금·신고',      home_url('/calculator/capital-gains/')],
            ['퇴직금',        '직장인·4대보험', home_url('/calculator/severance/')],
            ['전월세 전환',   '부동산',         home_url('/calculator/rent-conversion/')],
          ];
          foreach ($top5 as $i => $item): ?>
          <li class="mi-top5-item">
            <a href="<?php echo esc_url($item[2]); ?>" class="mi-top5-link">
              <span class="mi-top5-rank"><?php echo $i+1; ?></span>
              <div class="mi-top5-info">
                <div class="mi-top5-name"><?php echo esc_html($item[0]); ?></div>
                <div class="mi-top5-cat"><?php echo esc_html($item[1]); ?></div>
              </div>
              <span class="mi-top5-arr">›</span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ===== 분야별 계산기 ===== -->
<div class="mi-calc-section">
  <div class="mi-section-hd">
    <div>
      <div class="mi-section-title">분야별 계산기</div>
      <p class="mi-section-sub">필요한 분야를 골라 바로 계산해보세요</p>
    </div>
    <a href="<?php echo esc_url($calc_url); ?>" class="mi-section-link">전체 41종 보기 →</a>
  </div>

  <?php
  $calc_cats_home = [
    ['name' => '부동산', 'count' => 7, 'items' => [
      ['취득세',        '주택·부동산 매입 시 취득세 계산'],
      ['중개수수료',    '매매·전월세 중개보수 상한 계산'],
      ['전월세 전환',   '전세↔월세 전환율로 환산'],
      ['임대수익률',    '임대 투자 연 수익률 계산'],
    ]],
    ['name' => '직장인·4대보험', 'count' => 6, 'items' => [
      ['연봉 실수령액', '4대보험·세금 제외 실수령액'],
      ['실업급여',      '수급 기간·일액 계산'],
      ['퇴직금',        '평균임금 기준 퇴직금 계산'],
      ['건강보험료',    '직장·지역·피부양자 보험료'],
    ]],
    ['name' => '세금·신고', 'count' => 11, 'items' => [
      ['연말정산',      '환급·추가납부액 계산'],
      ['종합소득세',    '누진세율 기준 소득세 계산'],
      ['양도소득세',    '양도차익 세액 계산'],
      ['증여세',        '증여재산 세액 계산'],
    ]],
    ['name' => '대출·금융', 'count' => 4, 'items' => [
      ['대출이자',      '원리금·이자 상환액 계산'],
      ['예적금 이자',   '만기 이자·세후 수령액'],
      ['중도상환수수료','조기상환 수수료 계산'],
      ['DSR·DTI·LTV',  '대출 한도 지표 계산'],
    ]],
  ];
  foreach ($calc_cats_home as $cat): ?>
  <div class="mi-calc-cat">
    <div class="mi-calc-cat-hd">
      <span class="mi-calc-cat-bar"></span>
      <span class="mi-calc-cat-name"><?php echo esc_html($cat['name']); ?></span>
      <span class="mi-calc-cat-count"><?php echo $cat['count']; ?>종</span>
    </div>
    <div class="mi-calc-grid">
      <?php foreach ($cat['items'] as $item): ?>
      <a href="<?php echo esc_url($calc_url); ?>" class="mi-calc-card">
        <div class="mi-calc-card-name"><?php echo esc_html($item[0]); ?></div>
        <div class="mi-calc-card-desc"><?php echo esc_html($item[1]); ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="mi-calc-more">
    <a href="<?php echo esc_url($calc_url); ?>">전체 41종 계산기 보기 →</a>
  </div>
</div>

<!-- ===== 오늘의 최신 글 ===== -->
<section class="mi-latest-section">
  <div class="mi-latest-inner">
    <div class="mi-section-hd">
      <div>
        <div class="mi-section-title">오늘의 최신 글</div>
        <p class="mi-section-sub">5개 분야의 따끈한 정보를 매일 한 편씩</p>
      </div>
      <span style="font-size:13px;color:#8a94a0;"><?php echo date('Y. m. d'); ?> 업데이트</span>
    </div>
    <div class="mi-latest-grid">
      <?php
      $cats_meta = [
        'gov-support'  => ['label' => '정부지원금',   'color' => '#0ca678', 'bg' => '#e9f8f1'],
        'tax'          => ['label' => '세금·연말정산', 'color' => '#11243a', 'bg' => '#eef1f5'],
        'real-estate'  => ['label' => '부동산',        'color' => '#0c8599', 'bg' => '#e6f4f6'],
        'invest'       => ['label' => '재테크',        'color' => '#a8761a', 'bg' => '#f8f1e2'],
        'retirement'   => ['label' => '노후·가족',     'color' => '#5c6b7a', 'bg' => '#eef1f4'],
      ];
      $shown = [];
      foreach ($cats_meta as $slug => $meta) {
        $cat_obj = get_category_by_slug($slug);
        if ($cat_obj) {
          $posts = get_posts(['category' => $cat_obj->term_id, 'numberposts' => 1]);
          if (!empty($posts)) {
            $p = $posts[0];
            $shown[$slug] = $p;
          }
        }
      }
      // 글이 없으면 더미 표시
      $dummy = [
        'gov-support'  => '2026년 청년도약계좌, 5년 만기 수령액과 가입 조건 총정리',
        'tax'          => '연말정산 미리보기로 13월의 월급 늘리는 공제 7가지',
        'real-estate'  => '2026년 달라지는 취득세·종부세, 1주택자 체크포인트',
        'invest'       => '6월 셋째 주 예금금리 비교 — 연 4%대 특판 어디에',
        'retirement'   => '국민연금 예상 수령액 조회법과 임의가입 전략',
      ];
      foreach ($cats_meta as $slug => $meta):
        $url   = isset($shown[$slug]) ? get_permalink($shown[$slug]) : home_url('/category/' . $slug . '/');
        $title = isset($shown[$slug]) ? get_the_title($shown[$slug]) : $dummy[$slug];
        $date  = isset($shown[$slug]) ? get_the_date('Y.m.d', $shown[$slug]) : date('Y.m.d');
      ?>
      <a href="<?php echo esc_url($url); ?>" class="mi-latest-card">
        <div class="mi-latest-tag" style="color:<?php echo esc_attr($meta['color']); ?>;background:<?php echo esc_attr($meta['bg']); ?>">
          <?php echo esc_html($meta['label']); ?>
        </div>
        <div class="mi-latest-title"><?php echo esc_html($title); ?></div>
        <div class="mi-latest-date"><?php echo esc_html($date); ?></div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== 푸터 ===== -->
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
        <?php foreach ($cats_meta as $slug => $meta): ?>
        <li><a href="<?php echo esc_url(home_url('/category/' . $slug . '/')); ?>"><?php echo esc_html($meta['label']); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="mi-footer-col">
      <h4>머니인포</h4>
      <ul>
        <?php
        $footer_pages = ['about'=>'서비스 소개','terms'=>'이용약관','privacy'=>'개인정보처리방침','contact'=>'광고·제휴 문의'];
        foreach ($footer_pages as $slug => $label):
          $p = get_page_by_path($slug);
          $url = $p ? get_permalink($p) : home_url('/' . $slug . '/');
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

<?php wp_footer(); ?>
</body>
</html>
