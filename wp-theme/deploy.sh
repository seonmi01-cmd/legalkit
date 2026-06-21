#!/bin/bash
# 머니인포 아스트라 차일드 테마 배포 스크립트
# 사용법: bash deploy.sh

SSH_HOST="45.130.228.185"
SSH_USER="u176415596"
SSH_PORT="65002"
SSH_KEY="$HOME/.ssh/nsialaw_ed25519"
REMOTE_PATH="~/domains/infolabm.com/public_html/wp-content/themes/astra-child"
LOCAL_PATH="$(dirname "$0")/astra-child"

echo "📦 머니인포 테마 배포 시작..."

# 원격에 폴더 없으면 생성
ssh -i "$SSH_KEY" -p "$SSH_PORT" "$SSH_USER@$SSH_HOST" "mkdir -p $REMOTE_PATH/assets/css $REMOTE_PATH/assets/js $REMOTE_PATH/parts"

# 파일 전송
scp -i "$SSH_KEY" -P "$SSH_PORT" -r "$LOCAL_PATH"/* "$SSH_USER@$SSH_HOST:$REMOTE_PATH/"

echo "✅ 배포 완료!"
echo ""
echo "▶ 다음 단계 (WordPress 관리자):"
echo "  1. 외모 → 테마 → 'Astra Child — 머니인포' 활성화"
echo "  2. 설정 → 읽기 → 홈페이지 표시: '정적인 페이지' → 홈페이지: (아무 페이지나 선택)"
echo "  3. 계산기 페이지 생성: 페이지 → 새로 추가 → 제목 'calculator' → 템플릿 '금융 계산기 목록'"
echo "  4. 카테고리 슬러그 확인: gov-support / tax / real-estate / invest / retirement"
