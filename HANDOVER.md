# 머니인포 프로젝트 인계서

## 접속 정보

| 항목 | 값 |
|------|-----|
| 사이트 URL | https://infolabm.com |
| WP 관리자 이메일 | seonmi01@gmail.com |
| WP 관리자 비밀번호 | Epdkorea*1 |
| WP 관리자 URL | https://infolabm.com/wp-admin/ |
| Git 브랜치 | `claude/stoic-fermat-vcra2f` |
| 저장소 | seonmi01-cmd/legalkit |

## 서버 파일 업로드 방법

WordPress 테마 에디터 Ajax API를 사용합니다:

```python
import requests, re

WP = 'https://infolabm.com'
session = requests.Session()
session.post(WP + '/wp-login.php', data={
    'log': 'seonmi01@gmail.com', 'pwd': 'Epdkorea*1', 'wp-submit': 'Log In',
    'redirect_to': '/wp-admin/', 'testcookie': '1'
}, cookies={'wordpress_test_cookie': 'WP Cookie check'}, allow_redirects=True)

def upload(rel_path, local_path):
    nr = session.get(WP + f'/wp-admin/theme-editor.php?file={rel_path.replace("/","%2F")}&theme=astra-child')
    idx = nr.text.find('id="newcontent"')
    chunk = nr.text[max(0,idx-5000):idx+200]
    m = re.search(r'name="nonce"[^>]*value="([^"]+)"', chunk)
    nonce = m.group(1) if m else None
    with open(local_path) as f:
        content = f.read()
    pr = session.post(WP + '/wp-admin/admin-ajax.php', data={
        'action': 'edit-theme-plugin-file',
        'file': rel_path, 'theme': 'astra-child',
        'newcontent': content, 'nonce': nonce,
    })
    print(f'{rel_path}: {pr.json().get("success")}')
```

- `rel_path`: 테마 루트 기준 상대경로 (예: `functions.php`, `assets/css/moneyinfo.css`)
- `local_path`: 로컬 파일 경로 (예: `wp-theme/astra-child/functions.php`)
- **주의**: 신규 파일은 먼저 Hostinger 파일 관리자에서 빈 파일 생성 후 업로드 가능

---

## 프로젝트 구조

```
wp-theme/astra-child/
├── functions.php              # 훅 등록, CSS/JS 로드
├── front-page.php             # 홈페이지 커스텀 템플릿
├── page.php                   # 일반 페이지 (계산기 자식 → 커스텀)
├── page-calculator.php        # 계산기 목록 (41종)
├── single.php                 # 블로그 글 커스텀 템플릿
├── category-gov-support.php   # 정부지원금 카테고리
├── category-tax.php           # 세금·연말정산
├── category-real-estate.php   # 부동산
├── category-invest.php        # 재테크
├── category-retirement.php    # 노후·가족
├── category-content.php       # 카테고리 공통 렌더러
├── parts/
│   ├── header.php             # 커스텀 헤더 (네비 + 시세 띠)
│   └── footer.php             # 커스텀 푸터
├── pages/
│   ├── page-about.php         # 서비스 소개
│   ├── page-terms.php         # 이용약관
│   ├── page-privacy.php       # 개인정보처리방침
│   └── page-contact.php       # 광고·제휴 문의
└── assets/
    ├── css/moneyinfo.css      # 전체 스타일 (현재 ver 1.6)
    └── js/moneyinfo.js        # 인터랙션 JS (현재 ver 1.2)
```

---

## 주요 설계 사항

### 커스텀 헤더/푸터 적용 범위
`functions.php`의 `wp_body_open` / `wp_footer` 훅으로 처리:
- **홈페이지**: `front-page.php`에서 직접 include
- **카테고리 페이지**: `category-*.php`에서 직접 include
- **계산기 목록**: `page-calculator.php`에서 직접 include
- **계산기 하위 페이지**: `mi_is_calc_child()` 함수로 감지 → 훅으로 주입
- **블로그 글 (single)**: `is_single()` 조건 → 훅으로 주입
- **static 페이지 (소개/약관 등)**: `pages/page-*.php` 템플릿에서 직접 include

Astra 기본 헤더/푸터는 CSS로 강제 숨김:
```css
body.mi-custom-page #masthead,
body.mi-custom-page .ast-above-header-wrap { display: none !important; }
```

### 계산기 카드 URL 구조
```
/calculator/acquisition-tax/   취득세
/calculator/net-salary/        연봉 실수령액
/calculator/capital-gains/     양도소득세
... (총 41종, page-calculator.php 참고)
```
WordPress 관리자에서 계산기 하위 페이지로 등록되어 있음 (parent: calculator, ID=35)

### CSS/JS 버전 관리
버전 올리면 브라우저 캐시 무효화:
- CSS: `functions.php` 4번째 줄 `'1.6'` → 올리면 됨
- JS: `functions.php` 5번째 줄 `'1.2'` → 올리면 됨

---

## 완료된 작업 목록

- [x] 커스텀 헤더/푸터 전 페이지 적용
- [x] 실시간 시세 띠 (환율, KOSPI, KOSDAQ, 나스닥)
- [x] 계산기 목록 페이지 (41종, 검색·필터·카테고리 탭)
- [x] 계산기 하위 페이지 커스텀 헤더/푸터
- [x] 카테고리 페이지 (정부지원금·세금·부동산·재테크·노후·가족)
- [x] 카테고리 최신 대표글 클릭 연결 수정
- [x] 블로그 단일 글 커스텀 헤더/푸터 적용
- [x] static 페이지 emoji 아이콘 → SVG 교체 (이메일 아이콘 유지)
- [x] 홈페이지 푸터 링크 동적 처리

## 미해결 이슈

- [ ] **시세 띠 시간 겹침**: 나스닥 수치 끝에 `13:37 기준` 텍스트가 겹침
  - `header.php`의 `.mi-ticker-time` 요소가 `.mi-ticker-inner` 안 마지막에 위치
  - 시도한 방법: `position: absolute; right: var(--px)` → 여전히 겹침
  - 원인 추정: ticker 아이템들이 flex로 늘어나 시간 요소를 밀어냄
  - 권장 해결 방법: `mi-ticker-items`에 `padding-right: 100px` 추가하거나 시간을 ticker 바깥으로 분리

---

## SEO 최적화 (진행 예정)

사용자가 SEO 작업을 요청한 상태. 예정 작업:
1. 메타 태그 (title, description, og:image) 각 페이지별
2. Schema.org JSON-LD (계산기, 기사, 조직)
3. 사이트맵 XML + robots.txt
4. H태그 구조 정리
