#!/bin/sh

date

cd /var/www/html/public/test

# 現在チェックアウトされているブランチは？
#CUR_BRANCH=$(git branch --show-current)

# まずはfetch
git fetch

# 更新があるのでgit pull
echo "do git pull"
git pull

# ビルドが必要なファイルも更新されている
#echo "need build run npm build"
#npm run production

echo ""
