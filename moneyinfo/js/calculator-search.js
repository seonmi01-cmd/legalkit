/* MoneyInfo — Calculator Search & Filter */

const CALC_DATA = [
  { id:'cat-budongsan', name:'부동산', count:7, items:[
    {name:'취득세', desc:'주택·부동산 매입 시 취득세 계산'},
    {name:'중개수수료', desc:'매매·전월세 중개보수 상한 계산'},
    {name:'전월세 전환', desc:'전세↔월세 전환율로 환산'},
    {name:'임대수익률', desc:'임대 투자 연 수익률 계산'},
    {name:'등기비용', desc:'소유권 이전 등기비용 계산'},
    {name:'평수 환산', desc:'평↔제곱미터 면적 환산'},
    {name:'국민주택채권', desc:'매입 채권 본인부담금 계산'},
  ]},
  { id:'cat-jikjang', name:'직장인·4대보험', count:6, items:[
    {name:'연봉 실수령액', desc:'4대보험·세금 제외 실수령액'},
    {name:'실업급여', desc:'수급 기간·일액 계산'},
    {name:'퇴직금', desc:'평균임금 기준 퇴직금 계산'},
    {name:'국민연금', desc:'예상 수령액 추정'},
    {name:'건강보험료', desc:'직장·지역·피부양자 보험료'},
    {name:'연장·야간수당', desc:'가산수당 계산'},
  ]},
  { id:'cat-segeum', name:'세금·신고', count:11, items:[
    {name:'연말정산', desc:'환급·추가납부액 계산'},
    {name:'종합소득세', desc:'누진세율 기준 소득세 계산'},
    {name:'프리랜서 3.3%', desc:'원천징수 환급액 계산'},
    {name:'부가가치세', desc:'매출·매입 부가세 계산'},
    {name:'법인세', desc:'과세표준별 법인세 계산'},
    {name:'월세 세액공제', desc:'월세 세액공제액 계산'},
    {name:'카드 황금비율', desc:'소득공제 극대화 사용액'},
    {name:'부양가족 공제', desc:'인적공제 대상·금액 확인'},
    {name:'종합부동산세', desc:'종부세 과세표준·세액 계산'},
    {name:'증여세', desc:'증여재산 세액 계산'},
    {name:'양도소득세', desc:'양도차익 세액 계산'},
  ]},
  { id:'cat-daechul', name:'대출·금융', count:4, items:[
    {name:'대출이자', desc:'원리금·이자 상환액 계산'},
    {name:'예적금 이자', desc:'만기 이자·세후 수령액'},
    {name:'중도상환수수료', desc:'조기상환 수수료 계산'},
    {name:'DSR·DTI·LTV', desc:'대출 한도 지표 계산'},
  ]},
  { id:'cat-investment', name:'투자·절세', count:4, items:[
    {name:'코인 세금', desc:'가상자산 양도세 계산 (2027년 시행)'},
    {name:'ISA·IRP 절세', desc:'절세 혜택·환급 계산'},
    {name:'주식 배당세', desc:'배당소득세 계산'},
    {name:'해외주식 양도세', desc:'해외주식 매도 양도세 계산'},
  ]},
  { id:'cat-cheongnyeon', name:'청년·청약', count:4, items:[
    {name:'청년도약계좌', desc:'만기 수령액·매칭 계산'},
    {name:'청약 가점', desc:'청약 가점 산정'},
    {name:'청년전세대출 이자', desc:'버팀목·청년 전세대출 이자 계산'},
    {name:'청약 당첨확률', desc:'가점·추첨 당첨확률 시뮬레이션'},
  ]},
  { id:'cat-gajok', name:'가족·생활', count:5, items:[
    {name:'근로·자녀장려금', desc:'장려금 자격·금액 산정'},
    {name:'출산·부모급여', desc:'출산·부모급여 수령액 계산'},
    {name:'상속세', desc:'상속재산 세액 계산'},
    {name:'자동차세', desc:'배기량 기준 자동차세 계산'},
    {name:'최저임금', desc:'시급·월급 환산'},
  ]},
];

function initCalculatorSearch() {
  const input = document.getElementById('calc-search-input');
  const stickyNav = document.getElementById('sticky-cat-nav');
  const resultsInfo = document.getElementById('search-results-info');
  const matchCount = document.getElementById('match-count');
  const clearBtn = document.getElementById('clear-search');
  const emptyState = document.getElementById('empty-state');
  const sectionsContainer = document.getElementById('calc-sections');

  if (!input) return;

  function renderAllSections() {
    sectionsContainer.innerHTML = '';
    CALC_DATA.forEach(cat => {
      const section = buildCatSection(cat, cat.items);
      sectionsContainer.appendChild(section);
    });
  }

  function buildCatSection(cat, items) {
    const sec = document.createElement('section');
    sec.className = 'calc-section';
    sec.id = cat.id;
    const cards = items.map(item => `
      <a href="#" class="calc-card">
        <div class="calc-card-name">${item.name}</div>
        <div class="calc-card-desc">${item.desc}</div>
      </a>`).join('');
    sec.innerHTML = `
      <div class="calc-cat-hd">
        <span class="calc-cat-bar"></span>
        <span class="calc-cat-name">${cat.name}</span>
        <span class="calc-cat-count">${items.length}종</span>
      </div>
      <div class="calc-grid">${cards}</div>`;
    return sec;
  }

  function doSearch(q) {
    const query = q.trim().toLowerCase();
    if (!query) {
      // Reset
      stickyNav.style.display = '';
      resultsInfo.classList.remove('show');
      emptyState.classList.remove('show');
      renderAllSections();
      return;
    }
    stickyNav.style.display = 'none';
    // Flat search
    const results = [];
    CALC_DATA.forEach(cat => {
      const matched = cat.items.filter(item =>
        item.name.toLowerCase().includes(query) ||
        item.desc.toLowerCase().includes(query)
      );
      if (matched.length) results.push({ ...cat, items: matched });
    });
    const total = results.reduce((s, c) => s + c.items.length, 0);
    matchCount.textContent = `"${q}" 검색 결과 ${total}개`;
    resultsInfo.classList.add('show');
    sectionsContainer.innerHTML = '';
    if (!total) {
      emptyState.classList.add('show');
    } else {
      emptyState.classList.remove('show');
      results.forEach(cat => {
        sectionsContainer.appendChild(buildCatSection(cat, cat.items));
      });
    }
  }

  input.addEventListener('input', () => doSearch(input.value));

  if (clearBtn) {
    clearBtn.addEventListener('click', () => {
      input.value = '';
      doSearch('');
    });
  }

  // Popular chips
  document.querySelectorAll('.popular-chips .chip').forEach(chip => {
    chip.addEventListener('click', () => {
      input.value = chip.textContent.trim();
      doSearch(input.value);
      input.focus();
    });
  });

  // Initial render
  renderAllSections();
}

document.addEventListener('DOMContentLoaded', initCalculatorSearch);
