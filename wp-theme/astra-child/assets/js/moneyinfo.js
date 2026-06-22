/* ===== 머니인포 공통 JS ===== */

/* --- 시세 띠 API 연동 --- */
(function() {
  var now = new Date();
  var mm = String(now.getMonth()+1).padStart(2,'0');
  var dd = String(now.getDate()).padStart(2,'0');
  var hh = String(now.getHours()).padStart(2,'0');
  var mi = String(now.getMinutes()).padStart(2,'0');
  var el = document.getElementById('mi-ticker-time');
  if (el) el.textContent = mm + '.' + dd + ' ' + hh + ':' + mi + ' 기준';

  function setTicker(id, value, change, up) {
    var vEl = document.getElementById('mi-t-' + id);
    var cEl = document.getElementById('mi-tc-' + id);
    if (vEl) vEl.textContent = value;
    if (cEl) {
      cEl.textContent = (up ? '▲ ' : '▼ ') + Math.abs(change);
      cEl.className = 'chg ' + (up ? 'up' : 'down');
    }
  }

  fetch('https://open.er-api.com/v6/latest/USD')
    .then(function(r) { return r.json(); })
    .then(function(data) {
      if (!data || !data.rates) return;
      var r = data.rates;
      var krw = r.KRW || 1380;
      var jpy = r.JPY || 145;
      var eur = r.EUR || 0.92;
      setTicker('usd', Math.round(krw).toLocaleString(), 4.2, true);
      setTicker('jpy', Math.round(krw / jpy * 100).toLocaleString(), 1.3, false);
      setTicker('eur', Math.round(krw / eur).toLocaleString(), 2.1, true);
    })
    .catch(function() {
      setTicker('usd', '1,386', 4.2, true);
      setTicker('jpy', '880', 1.3, false);
      setTicker('eur', '1,499', 2.1, true);
    });
})();

/* --- 히어로 검색 --- */
function miHeroSearch() {
  var q = document.getElementById('mi-hero-search');
  if (!q) return;
  var val = q.value.trim();
  var base = document.body.dataset.calcUrl || 'calculator.html';
  window.location.href = base + (val ? '?q=' + encodeURIComponent(val) : '');
}
function miHeroChip(q) {
  var base = document.body.dataset.calcUrl || 'calculator.html';
  window.location.href = base + '?q=' + encodeURIComponent(q);
}
(function() {
  var inp = document.getElementById('mi-hero-search');
  if (inp) inp.addEventListener('keydown', function(e) { if (e.key === 'Enter') miHeroSearch(); });
})();

/* --- 계산기 검색 필터 --- */
(function() {
  if (!window.MI_CALC_DATA) return;

  var inp    = document.getElementById('mi-calc-input');
  var info   = document.getElementById('mi-search-info');
  var clrBtn = document.getElementById('mi-clear-btn');
  var sticky = document.getElementById('mi-sticky-nav');
  var empty  = document.getElementById('mi-empty-state');
  var wrap   = document.getElementById('mi-calc-sections');

  if (!inp || !wrap) return;

  function render(q) {
    var lq = (q || '').toLowerCase().trim();
    var searching = lq.length > 0;

    if (sticky)  sticky.style.display = searching ? 'none' : '';
    if (clrBtn)  clrBtn.style.display = searching ? '' : 'none';
    if (info)    info.style.display   = searching ? '' : 'none';

    var html = '';
    var total = 0;

    MI_CALC_DATA.forEach(function(cat) {
      var items = searching
        ? cat.items.filter(function(it) { return (it.name + ' ' + it.desc).toLowerCase().includes(lq); })
        : cat.items;
      if (!items.length) return;
      total += items.length;
      html += '<div id="' + cat.id + '" class="mi-calc-section-block">'
            + '<div class="mi-calc-cat-hd">'
            + '<span class="mi-calc-cat-bar"></span>'
            + '<span class="mi-calc-cat-name">' + cat.name + '</span>'
            + '<span class="mi-calc-cat-count">' + items.length + '종</span>'
            + '</div>'
            + '<div class="mi-calc-grid">';
      items.forEach(function(it) {
        html += '<a href="' + (it.url || '#') + '" class="mi-calc-card">'
              + '<div class="mi-calc-card-name">' + it.name + '</div>'
              + '<div class="mi-calc-card-desc">' + it.desc + '</div>'
              + '</a>';
      });
      html += '</div></div>';
    });

    wrap.innerHTML = html;
    if (empty) empty.style.display = (searching && total === 0) ? '' : 'none';
    if (info && searching) {
      info.innerHTML = '<strong>\'' + q + '\'</strong> 검색 결과 <span class="cnt">' + total + '개</span>';
    }
  }

  inp.addEventListener('input', function() { render(this.value); });
  if (clrBtn) clrBtn.addEventListener('click', function() { inp.value = ''; render(''); inp.focus(); });

  // 팝 칩
  document.querySelectorAll('.mi-chip[data-q]').forEach(function(chip) {
    chip.addEventListener('click', function() { inp.value = this.dataset.q; render(this.dataset.q); });
  });

  // URL 쿼리 파라미터
  var params = new URLSearchParams(window.location.search);
  var q = params.get('q');
  if (q) { inp.value = q; render(q); } else { render(''); }
})();

/* --- 콘텐츠 토픽 필터 --- */
(function() {
  if (!window.MI_CONTENT_DATA) return;

  var chips    = document.querySelectorAll('.mi-topic-chip');
  var featured = document.getElementById('mi-featured');
  var grid     = document.getElementById('mi-posts-grid');
  var cur      = '전체';

  function renderFeatured(post) {
    if (!featured || !post) return;
    featured.innerHTML =
      '<a href="' + (post.url || '#') + '" class="mi-featured-link">'
      + '<div class="mi-featured-meta">'
      + '<span class="mi-featured-badge">최신</span>'
      + '<span class="mi-featured-topic">' + post.topic + '</span>'
      + '<span class="mi-featured-date">' + post.date + '</span>'
      + '</div>'
      + '<h2 class="mi-featured-title">' + post.title + '</h2>'
      + '<p class="mi-featured-excerpt">' + post.excerpt + '</p>'
      + '<div class="mi-featured-byline">' + post.readtime + '분 읽기 · 머니인포 편집팀</div>'
      + '</a>';
  }

  function renderGrid(posts) {
    if (!grid) return;
    grid.innerHTML = posts.map(function(p) {
      return '<a href="' + (p.url || '#') + '" class="mi-post-card">'
        + '<div class="mi-post-meta">'
        + '<span class="mi-post-topic">' + p.topic + '</span>'
        + '<span class="mi-post-date">' + p.date + '</span>'
        + '</div>'
        + '<div class="mi-post-title">' + p.title + '</div>'
        + '<div class="mi-post-excerpt">' + p.excerpt + '</div>'
        + '<div class="mi-post-read">' + p.readtime + '분 읽기</div>'
        + '</a>';
    }).join('');
  }

  function filter(topic) {
    var all = MI_CONTENT_DATA;
    var filtered = topic === '전체' ? all : all.filter(function(p) { return p.topic === topic; });
    if (!filtered.length) return;
    renderFeatured(filtered[0]);
    renderGrid(filtered.slice(1));
  }

  chips.forEach(function(chip) {
    chip.addEventListener('click', function() {
      chips.forEach(function(c) { c.classList.remove('active'); });
      this.classList.add('active');
      cur = this.dataset.topic;
      filter(cur);
    });
  });

  filter('전체');
})();
