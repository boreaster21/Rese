# Rese
<img width="950" alt="image" src="https://github.com/boreaster21/Rese/assets/155618258/92c62f07-2e48-4aef-9bb6-8f178f8a933a">

どんなアプリか：ある企業のグループ会社の飲食店予約サービス

## 目的
なぜ作成したか：外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。

## URL
デプロイのURL
注意事項など

## 機能一覧
会員登録機能<br>
ログイン機能<br>
ログアウト機能<br>
ユーザー情報取得機能<br>
ユーザー飲食店お気に入り一覧取得機能<br>
ユーザー飲食店予約情報取得機能<br>
飲食店一覧取得機能<br>
飲食店詳細取得機能<br>
飲食店お気に入り追加機能<br>
飲食店お気に入り削除機能<br>
飲食店予約情報追加機能<br>
飲食店予約情報削除機能<br>
エリアでの検索機能<br>
ジャンルでの検索機能<br>
店名での検索機能<br>
メールでの本人確認機能<br>
予約内容変更機能機能<br>
店舗評価機能<br>
店舗情報作成機能<br>
店舗情報更新機能<br>
予約情報確認機能<br>
決済機能機能<br>
店舗画像ストレージ保存機能<br>
メール送信機能<br>
認証バリデーション機能<br>
認証バリデーション機能<br>
未実装；QRコード機能<br>
未実装：リマインダー機能<br>
未実装：レスポンシブデザイン機能<br>

## 使用技術
php8.3.6<br>
Laravel8<br>
docker<br>
nginx<br>
MySQL<br>
GitHub<br>

## ER図
![ReseTables drawio](https://github.com/boreaster21/ReseTest/assets/155618258/35e2eba2-a2b1-4de8-84b1-32c712dd93af)

## 環境構築
実行用コマンド
・下記コマンドでdatabase/csv/shops.csv ダミーの店舗情報を読み込む
php artisan db:seed --class=ShopSeeder

・3権限はUsersのroleカラムで分けています。
0 = 利用者
100 = 店舗代表者
999 = 管理者
管理者権限（999）はmysqlから直接付与してください。
そのほか２権限は管理者権限のあるアカウントでログイン後 http://localhost/admin から各ユーザーの権限管理ができます。

## 他リポジトリ
特になし
