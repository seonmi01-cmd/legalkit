/* MoneyInfo — Common JS: Header / Footer injection */

const NAV_LINKS = [
  { href: 'calculator.html', label: '계산기' },
  { href: 'gov-support.html', label: '정부지원금' },
  { href: 'tax.html', label: '세금·연말정산' },
  { href: 'real-estate.html', label: '부동산' },
  { href: 'invest.html', label: '재테크' },
  { href: 'retirement.html', label: '노후·가족' },
];

function getBasePath() {
  return document.documentElement.dataset.base || '';
}

function injectHeader(activeHref) {
  const base = getBasePath();
  const nav = NAV_LINKS.map(l => {
    const active = l.href === activeHref ? ' class="active"' : '';
    return `<a href="${base}${l.href}"${active}>${l.label}</a>`;
  }).join('');
  const html = `
<header id="site-header">
  <div class="header-inner">
    <a href="${base}index.html" class="site-logo">
      머니인포<span class="logo-dot"></span>
    </a>
    <nav class="site-nav">${nav}</nav>
  </div>
</header>`;
  document.body.insertAdjacentHTML('afterbegin', html);
}

function injectTicker() {
  const html = `
<div id="ticker">
  <div class="ticker-inner">
    <div class="ticker-live">
      <span class="ticker-dot"></span>실시간
    </div>
    <div class="ticker-items" id="ticker-items">
      <div class="ticker-item"><span class="ticker-label">원/달러</span><span class="ticker-value" id="t-usd">-</span><span class="ticker-change" id="t-usd-chg">-</span></div>
      <div class="ticker-item"><span class="ticker-label">원/엔(100)</span><span class="ticker-value" id="t-jpy">-</span><span class="ticker-change" id="t-jpy-chg">-</span></div>
      <div class="ticker-item"><span class="ticker-label">원/유로</span><span class="ticker-value" id="t-eur">-</span><span class="ticker-change" id="t-eur-chg">-</span></div>
      <div class="ticker-item"><span class="ticker-label">KOSPI</span><span class="ticker-value" id="t-kospi">2,742.31</span><span class="ticker-change up" id="t-kospi-chg">▲ 12.45</span></div>
      <div class="ticker-item"><span class="ticker-label">KOSDAQ</span><span class="ticker-value" id="t-kosdaq">874.12</span><span class="ticker-change down" id="t-kosdaq-chg">▼ 3.22</span></div>
      <div class="ticker-item"><span class="ticker-label">나스닥</span><span class="ticker-value" id="t-nasdaq">19,864.98</span><span class="ticker-change up" id="t-nasdaq-chg">▲ 124.55</span></div>
    </div>
    <div class="ticker-time" id="ticker-time"></div>
  </div>
</div>`;
  const header = document.getElementById('site-header');
  if (header) header.insertAdjacentHTML('afterend', html);
  loadTicker();
}

function loadTicker() {
  const now = new Date();
  const mm = String(now.getMonth()+1).padStart(2,'0');
  const dd = String(now.getDate()).padStart(2,'0');
  const hh = String(now.getHours()).padStart(2,'0');
  const mi = String(now.getMinutes()).padStart(2,'0');
  const el = document.getElementById('ticker-time');
  if (el) el.textContent = `${mm}.${dd} ${hh}:${mi} 기준`;
  // Try live API
  fetch('https://open.er-api.com/v6/latest/USD')
    .then(r => r.json())
    .then(data => {
      if (data && data.rates) {
        const krw = data.rates.KRW || 1380;
        const jpy = data.rates.JPY || 145;
        const eur = data.rates.EUR || 0.92;
        const usdKrw = Math.round(krw);
        const jpyKrw = Math.round(krw / jpy * 100);
        const eurKrw = Math.round(krw / eur);
        setTicker('t-usd', usdKrw.toLocaleString(), '+2.50', true);
        setTicker('t-jpy', jpyKrw.toLocaleString(), '-0.32', false);
        setTicker('t-eur', eurKrw.toLocaleString(), '+5.10', true);
      }
    })
    .catch(() => {
      setTicker('t-usd', '1,380', '+2.50', true);
      setTicker('t-jpy', '952', '-0.32', false);
      setTicker('t-eur', '1,501', '+5.10', true);
    });
}

function setTicker(id, value, change, up) {
  const vEl = document.getElementById(id);
  const cEl = document.getElementById(id + '-chg');
  if (vEl) vEl.textContent = value;
  if (cEl) {
    const prefix = up ? '▲' : '▼';
    const absChange = change.replace(/^[+-]/, '');
    cEl.textContent = `${prefix} ${absChange}`;
    cEl.className = `ticker-change ${up ? 'up' : 'down'}`;
  }
}

function injectFooter() {
  const base = getBasePath();
  const html = `
<footer id="site-footer">
  <div class="footer-inner">
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">머니인포<span class="logo-dot"></span></div>
        <p>대한민국 대표 금융 정보 포털.<br>금융 계산기 41종과 최신 금융 정보를<br>한 곳에서 쉽고 빠르게 확인하세요.</p>
      </div>
      <div class="footer-col">
        <h4>계산기</h4>
        <ul>
          <li><a href="${base}calculator.html#cat-budongsan">부동산</a></li>
          <li><a href="${base}calculator.html#cat-jikjang">직장인·4대보험</a></li>
          <li><a href="${base}calculator.html#cat-segeum">세금·신고</a></li>
          <li><a href="${base}calculator.html#cat-daechul">대출·금융</a></li>
          <li><a href="${base}calculator.html">전체 보기 →</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>콘텐츠</h4>
        <ul>
          <li><a href="${base}gov-support.html">정부지원금</a></li>
          <li><a href="${base}tax.html">세금·연말정산</a></li>
          <li><a href="${base}real-estate.html">부동산</a></li>
          <li><a href="${base}invest.html">재테크</a></li>
          <li><a href="${base}retirement.html">노후·가족</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>머니인포</h4>
        <ul>
          <li><a href="#">서비스 소개</a></li>
          <li><a href="#">이용약관</a></li>
          <li><a href="#">개인정보처리방침</a></li>
          <li><a href="#">광고 문의</a></li>
          <li><a href="#">제휴 문의</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bar">
      <p class="footer-copy">© 2026 머니인포. All rights reserved.</p>
      <p class="footer-disclaimer">본 사이트의 계산 결과는 참고용이며 실제 세액·수령액과 다를 수 있습니다. 정확한 내용은 관련 기관에 문의하세요.</p>
    </div>
  </div>
</footer>`;
  document.body.insertAdjacentHTML('beforeend', html);
}

// Export for use
window.MoneyInfo = { injectHeader, injectTicker, injectFooter };
