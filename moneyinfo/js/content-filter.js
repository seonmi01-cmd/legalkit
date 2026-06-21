/* MoneyInfo — Content Topic Filter */

function initContentFilter() {
  const chips = document.querySelectorAll('.topic-chip');
  const articles = Array.from(document.querySelectorAll('[data-topic]'));
  const featuredWrap = document.getElementById('featured-wrap');
  const restGrid = document.getElementById('rest-grid');

  if (!chips.length || !articles.length) return;

  function applyFilter(topic) {
    // Update chip active state
    chips.forEach(c => {
      if (c.dataset.topic === topic) {
        c.classList.add('active');
      } else {
        c.classList.remove('active');
      }
    });

    // Filter articles
    const filtered = topic === '전체'
      ? articles
      : articles.filter(a => a.dataset.topic === topic);

    if (!filtered.length) return;

    // Featured = first
    const featured = filtered[0];
    const rest = filtered.slice(1);

    // Render featured
    if (featuredWrap) {
      featuredWrap.innerHTML = '';
      const clone = featured.cloneNode(true);
      clone.classList.add('featured-card');
      clone.classList.remove('article-card', 'hidden');
      featuredWrap.appendChild(clone);
    }

    // Render rest
    if (restGrid) {
      restGrid.innerHTML = '';
      rest.forEach(a => {
        const clone = a.cloneNode(true);
        clone.classList.add('article-card');
        clone.classList.remove('featured-card', 'hidden');
        restGrid.appendChild(clone);
      });
    }

    // Hide all originals
    articles.forEach(a => a.classList.add('hidden'));
  }

  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      applyFilter(chip.dataset.topic);
    });
  });

  // Init with "전체"
  applyFilter('전체');
}

document.addEventListener('DOMContentLoaded', initContentFilter);
