# Pâtisserie Lara

English follows Japanese.

## アプリについて
Pâtisserie Laraは洋菓子店の売上管理アプリケーションです。  
商品とカテゴリの登録が出来ます。  
毎朝6時にダミーの売上とレシート情報が作成されます。  
![スクリーンショット 2023-07-06 23 21 12](https://github.com/YutaManaka/patisserieLara/assets/54618797/b117cb2f-386a-4167-936a-e81b3f10a6ed)

## URL
https://www.yutamanaka.work/login

下記のアカウントでログインしてください。
ID: sample@pl.com
pass: sample

## 使用技術
- 言語/フレームワーク
    - PHP 8.2
    - Laravel 10.13.5
    - Inertia.js 0.6.9
    - Vue.js 3.2.47
    - Vite 4.1.1
    - tailwindcss 3.2.7
    - Husky 8.0.3
- データベース
    - MySQL 8.0
- 開発環境
    - Docker for Mac
- 本番環境
    - AWS Lightsail
- バージョン管理
    - Github

## ER図
<img width="717" alt="ER図" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/9e10d82a-e6de-4eab-abcb-04fea20ef4c9">


## インフラ構成図
![AWS構成図](https://github.com/YutaManaka/patisserieLara/assets/54618797/b6ccb6b4-61a6-48e0-985b-c1c9c564f1e8)


## 機能一覧
1. ログイン、ログアウト機能
2. 売上
    - 本日の売上確認
    - 提供済みボタン
        - <img width="800" alt="提供済" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/0cdfa1c3-30a5-49ce-937b-02fedbc07dc0">
    - レシート確認
        - <img width="300" alt="レシート" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/367eac50-2838-41df-94f9-62b8e26b85c1">
3. カテゴリ
    - カテゴリの新規作成
    - カテゴリの更新
        - 名称
        - 提供開始/終了時間
        - 表示順
        - 画像アップロード
        - 表示/非表示
    - カテゴリの削除
4. 商品
    - 商品の新規作成
    - 商品の更新
        - 画像のアップロード
        - 商品コード
        - 商品説明
        - レシート名称
        - 価格(税込価格、税額、税抜価格)
        - カテゴリとの紐付け
        - 表示順
        - 表示/非表示
    - 商品の削除
5. アカウント
    - アカウントの新規作成
    - アカウントの更新
        - ユーザー名
        - ログインID
        - 権限
        - パスワード
    - アカウントの削除
6. 各種設定
    - 設定の新規作成
    - 設定の更新
        - 項目名
        - 値
    - 設定の削除

## 参考サイト
1. 環境構築
    - Laravel, Vue.js
        - [Inertia.jsでLaravel9 + Vue3環境を手順を追って構築する](https://qiita.com/uehatsu/items/98b258bddb961d01627a)
    - Inertia.js
        - [Inertia.jsインストール方法(サーバー側)](https://inertiajs.com/server-side-setup)
        - [Inertia.jsインストール方法(フロント側)](https://inertiajs.com/client-side-setup)
        - [inertiaのshared dataがpropsで受け取れない問題を解決-1](https://inertiajs.com/shared-data)
        - [inertiaのshared dataがpropsで受け取れない問題を解決-2](https://larainfo.com/blogs/laravel-9-with-inertia-vue-3-implement-flash-message)
    - Vite
        - [viteインストール](https://github.com/laravel/vite-plugin/blob/main/UPGRADE.md#migrating-from-laravel-mix-to-vite)
        - [npm run に m1 で失敗した](https://zenn.dev/gin_nazo/scraps/7a7c21e52eabad)
    - 認証
        - [Laravel Jetstream(認証) + Inertia(Vue3)環境を構築する](https://qiita.com/uehatsu/items/c95376101cef23b4f84c)  
    - ESLint
        - [ESLint をプロジェクトに追加する](https://www.techpit.jp/courses/210/curriculums/213/sections/1402/parts/5679)
        - [ESLintに'defineProps' is not defined.(no-undef)と言われる](https://commis.hatenablog.com/entry/2021/10/21/113831)
        - [vue/multi-word-component-namesのエラー解消](https://qiita.com/Jimonull/items/1032c46f519e085eb922)
        - [Node.jsで開発環境をセットアップする（ESLint、Prettier、husky）](https://t0k0sh1.com/node-js-setup-enrionment-eslint-prettier-husky)
2. AWS Lightsail
    - [【AWS】Laravelアプリを公開【Lightsail】](https://chigusa-web.com/blog/aws-laravel-lightsail/)
    - [GitHubの既存プロジェクトをlightsailにインストール](https://juno-engineer.com/article/amazon-lightsail-lamp-php8-laravel/#autoid-6)
    - [「"storage/logs/laravel.log" could not be opened: failed to open stream: ...」が出た時の対処方法](https://akizora.tech/laravel-log-error-4495)
    - [SQLSTATE[HY000] [1045] Access denied for user](https://inouelog.com/access-denied-user/)
    - [Connect to a WordPress Lightsail Database from a GUI](https://mead.io/2022/06/30/connect-to-a-wordpress-lightsail-database-from-a-gui/)
3. ロゴ作成
    - [app.logo.com](https://app.logo.com/business-name)
4. デザイン参考
   - [モンサンクレール](https://www.ms-clair.co.jp/product)
   - [ダロワイヨ](https://www.dalloyau.co.jp/)
   - [自由が丘ロール屋](https://www.jiyugaoka-rollya.jp/product)



## About this application
Pâtisserie Lara is a sales management application for small stores.  
Categories and items can be created, updated, and deleted.  
Dummy data of orders and receipts will be created daily at 6:00.  
![スクリーンショット 2023-07-06 23 21 12](https://github.com/YutaManaka/patisserieLara/assets/54618797/b117cb2f-386a-4167-936a-e81b3f10a6ed)

# URL
https://www.yutamanaka.work/login

Please use following id and password to login.
ID: sample@pl.com
pass: sample

## Dependency
- Language / Framework
    - PHP 8.2
    - Laravel 10.13.5
    - Inertia.js 0.6.9
    - Vue.js 3.2.47
    - Vite 4.1.1
    - tailwindcss 3.2.7
    - Husky 8.0.3
- Database
    - MySQL 8.0
- Development environment
    - Docker for Mac
- Production environment
    - AWS Lightsail
- Version management
    - Github

## ER Diagram
<img width="717" alt="ER図" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/9e10d82a-e6de-4eab-abcb-04fea20ef4c9">

## Infrastructure Diagram
![AWS構成図](https://github.com/YutaManaka/patisserieLara/assets/54618797/f0ed1912-32e1-41fc-93d8-b28149404dbc)


## Function
1. Login / Logout
2. Order
    - Today's total Orders
    - Delivered button
        - <img width="800" alt="提供済" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/0cdfa1c3-30a5-49ce-937b-02fedbc07dc0">
    - Receipt
        - <img width="300" alt="レシート" src="https://github.com/YutaManaka/patisserieLara/assets/54618797/367eac50-2838-41df-94f9-62b8e26b85c1">
3. Categories
    - Create new category
    - Update category
        - name
        - order start time / order end time
        - sort order
        - updoad image
        - display / hide
    - Delete category
4. Items
    - Create new item
    - Update item
        - upload image
        - item code
        - description
        - receipt name
        - price
        - relation with categories
        - sort order
        - display / hide
    - Delete item
5. Accounts
    - Create new account
    - Update account
        - user name
        - login id
        - permission
        - password
    - Delete account
6. Configs
    - Create new config
    - Update config
        - key
        - value
    - Delete config

## Reference
1. Building an environment
    - Laravel, Vue.js
        - [Inertia.jsでLaravel9 + Vue3環境を手順を追って構築する](https://qiita.com/uehatsu/items/98b258bddb961d01627a)
    - Inertia.js
        - [Inertia.jsインストール方法(サーバー側)](https://inertiajs.com/server-side-setup)
        - [Inertia.jsインストール方法(フロント側)](https://inertiajs.com/client-side-setup)
        - [inertiaのshared dataがpropsで受け取れない問題を解決-1](https://inertiajs.com/shared-data)
        - [inertiaのshared dataがpropsで受け取れない問題を解決-2](https://larainfo.com/blogs/laravel-9-with-inertia-vue-3-implement-flash-message)
    - Vite
        - [viteインストール](https://github.com/laravel/vite-plugin/blob/main/UPGRADE.md#migrating-from-laravel-mix-to-vite)
        - [npm run に m1 で失敗した](https://zenn.dev/gin_nazo/scraps/7a7c21e52eabad)
    - Certification
        - [Laravel Jetstream(認証) + Inertia(Vue3)環境を構築する](https://qiita.com/uehatsu/items/c95376101cef23b4f84c)  
    - ESLint
        - [ESLint をプロジェクトに追加する](https://www.techpit.jp/courses/210/curriculums/213/sections/1402/parts/5679)
        - [ESLintに'defineProps' is not defined.(no-undef)と言われる](https://commis.hatenablog.com/entry/2021/10/21/113831)
        - [vue/multi-word-component-namesのエラー解消](https://qiita.com/Jimonull/items/1032c46f519e085eb922)
        - [Node.jsで開発環境をセットアップする（ESLint、Prettier、husky）](https://t0k0sh1.com/node-js-setup-enrionment-eslint-prettier-husky)
2. AWS Lightsail
    - [【AWS】Laravelアプリを公開【Lightsail】](https://chigusa-web.com/blog/aws-laravel-lightsail/)
    - [GitHubの既存プロジェクトをlightsailにインストール](https://juno-engineer.com/article/amazon-lightsail-lamp-php8-laravel/#autoid-6)
    - [「"storage/logs/laravel.log" could not be opened: failed to open stream: ...」が出た時の対処方法](https://akizora.tech/laravel-log-error-4495)
    - [SQLSTATE[HY000] [1045] Access denied for user](https://inouelog.com/access-denied-user/)
    - [Connect to a WordPress Lightsail Database from a GUI](https://mead.io/2022/06/30/connect-to-a-wordpress-lightsail-database-from-a-gui/)
3. Creating logo
    - [app.logo.com](https://app.logo.com/business-name)
4. Design
   - [モンサンクレール](https://www.ms-clair.co.jp/product)
   - [ダロワイヨ](https://www.dalloyau.co.jp/)
   - [自由が丘ロール屋](https://www.jiyugaoka-rollya.jp/product)
