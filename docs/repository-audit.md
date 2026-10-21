# Phase 1 — 原教材調査

対象コミット: `bd7ea74`。18章、基本104課題＋第18章発展1課題。第8章の小問は親課題の全問成功を1セーブとする。

|章|演習数|難易度|前提|
|---|---:|---|---|
|1|5|初級|PHPタグ・実行環境|
|2|6|初級|前章までの構文|
|3|7|初級|前章までの構文|
|4|6|初級|前章までの構文|
|5|7|初級|前章までの構文|
|6|8|初級|前章までの構文|
|7|7|初級〜中級|前章までの構文、HTTP・HTML|
|8|7|初級〜中級|前章までの構文|
|9|8|初級〜中級|前章までの構文|
|10|8|初級〜中級|前章までの構文|
|11|3|中級〜上級|前章までの構文|
|12|3|中級〜上級|前章までの構文|
|13|3|中級〜上級|前章までの構文|
|14|3|中級〜上級|前章までの構文|
|15|6|中級〜上級|前章までの構文|
|16|6|中級〜上級|前章までの構文|
|17|6|中級〜上級|前章までの構文|
|18|6|中級〜上級|前章までの構文、SQL・MySQL|

## 原教材の問題

- 7ファイルでJSON構文破損。字句の引用符・エスケープとコメントの文字列化を修復。課題・章の削除は行わない。
- 第14章の課題2には正答コードがなく、課題3も部分実装。既存解答だけでは全課題の正答テストを構成できない。
- 第16章ではグローバルdate関数の再定義、文字列エスケープ、catchブロック等の問題。
- 第17章では文字列補間内の演算、callable型のプロパティなどPHP 8.3非対応のコード。
- 第18章の接続例は設定配列とクラスを単一セルに含み、ファイル分割しないと構文エラー。DBはMySQL固有のスキーマを含むため、SQLiteへ無断置換しない。
- Notebookセルには`<language>php</language>`が含まれる。workspace抽出時にこの実行用でないマーカーを除去する。
- 未実装のテンプレートには構文エラーや空の戻り値がある。未着手を合格扱いせずskipで区別する。

## 課題対応表

### 第1章

教材: `chapters/chapter_01_php_intro.ipynb`  演習: `exercises/chapter_01_php_intro_exercise.ipynb`  解答: `solutions/chapter_01_php_intro_solution.ipynb`

- `ch01-ex01` 最初のPHPプログラム（演習セル: 1）
- `ch01-ex02` 変数を使った自己紹介（演習セル: 4）
- `ch01-ex03` データ型の理解（演習セル: 7）
- `ch01-ex04` コメントの書き方（演習セル: 10）
- `ch01-ex05` 総合演習 - プロフィール作成（演習セル: 13）
### 第2章

教材: `chapters/chapter_02_basics.ipynb`  演習: `exercises/chapter_02_basics_exercise.ipynb`  解答: `solutions/chapter_02_basics_solution.ipynb`

- `ch02-ex01` 四則演算（演習セル: 1）
- `ch02-ex02` 比較演算子の理解（演習セル: 4）
- `ch02-ex03` 論理演算子を使った条件判定（演習セル: 7）
- `ch02-ex04` 文字列操作（演習セル: 10）
- `ch02-ex05` 定数と変数（演習セル: 13）
- `ch02-ex06` 総合演習 - 成績計算プログラム（演習セル: 16）
### 第3章

教材: `chapters/chapter_03_conditionals.ipynb`  演習: `exercises/chapter_03_conditionals_exercise.ipynb`  解答: `solutions/chapter_03_conditionals_solution.ipynb`

- `ch03-ex01` 基本的なif文（演習セル: 1）
- `ch03-ex02` 年齢による区分判定（演習セル: 4）
- `ch03-ex03` switch文で曜日を判定（演習セル: 7）
- `ch03-ex04` 三項演算子を使った条件式（演習セル: 10）
- `ch03-ex05` 複合条件を使ったログイン認証（演習セル: 13）
- `ch03-ex06` ネストした条件分岐 - 成績評価システム（演習セル: 16）
- `ch03-ex07` 総合演習 - 料金計算システム（演習セル: 19）
### 第4章

教材: `chapters/chapter_04_arrays.ipynb`  演習: `exercises/chapter_04_arrays_exercise.ipynb`  解答: `solutions/chapter_04_arrays_solution.ipynb`

- `ch04-ex01` 基本的な配列操作（演習セル: 1）
- `ch04-ex02` 連想配列で商品情報を管理（演習セル: 4）
- `ch04-ex03` 多次元配列 - 成績表（演習セル: 7）
- `ch04-ex04` 配列のソートと検索（演習セル: 10）
- `ch04-ex05` 配列の結合と分割（演習セル: 13）
- `ch04-ex06` 総合演習 - ショッピングカート（演習セル: 16）
### 第5章

教材: `chapters/chapter_05_loops.ipynb`  演習: `exercises/chapter_05_loops_exercise.ipynb`  解答: `solutions/chapter_05_loops_solution.ipynb`

- `ch05-ex01` for文の基本（演習セル: 1）
- `ch05-ex02` while文を使った条件付き繰り返し（演習セル: 4）
- `ch05-ex03` foreachで配列を処理（演習セル: 7）
- `ch05-ex04` breakとcontinue（演習セル: 10）
- `ch05-ex05` 九九表の作成（演習セル: 13）
- `ch05-ex06` 総合演習 - FizzBuzz問題（演習セル: 16）
- `ch05-ex07` 実践演習 - 料金表と統計（演習セル: 19）
### 第6章

教材: `chapters/chapter_06_functions.ipynb`  演習: `exercises/chapter_06_functions_exercise.ipynb`  解答: `solutions/chapter_06_functions_solution.ipynb`

- `ch06-ex01` 基本的な関数の定義（演習セル: 2）
- `ch06-ex02` 引数と戻り値（演習セル: 4）
- `ch06-ex03` デフォルト引数（演習セル: 6）
- `ch06-ex04` 複数の戻り値（演習セル: 8）
- `ch06-ex05` 型宣言（演習セル: 10）
- `ch06-ex06` スコープの理解（演習セル: 12）
- `ch06-ex07` 無名関数（クロージャ）（演習セル: 14）
- `ch06-ex08` 実践問題 - バリデーション関数（演習セル: 16）
### 第7章

教材: `chapters/chapter_07_contact_form.ipynb`  演習: `exercises/chapter_07_contact_form_exercise.ipynb`  解答: `solutions/chapter_07_contact_form_solution.ipynb`

- `ch07-ex01` POSTとGETの違い（演習セル: 2）
- `ch07-ex02` フォームデータの受け取り（演習セル: 4）
- `ch07-ex03` 入力バリデーション（演習セル: 6）
- `ch07-ex04` サニタイズ（XSS対策）（演習セル: 8）
- `ch07-ex05` CSRFトークンの実装（演習セル: 10）
- `ch07-ex06` ファイルアップロード（演習セル: 12）
- `ch07-ex07` 実践問題 - アンケートフォーム（演習セル: 14）
### 第8章

教材: `chapters/chapter_08_basics_review.ipynb`  演習: `exercises/chapter_08_basics_review_exercise.ipynb`  解答: `solutions/chapter_08_basics_review_solution.ipynb`

- `ch08-ex01` 変数と型（演習セル: 2, 4）
- `ch08-ex02` 文字列操作（演習セル: 6）
- `ch08-ex03` 配列操作（演習セル: 8）
- `ch08-ex04` 制御構造（演習セル: 10）
- `ch08-ex05` 関数の定義（演習セル: 12）
- `ch08-ex06` 総合問題 - 簡易Todoアプリ（一部実装）（演習セル: 14）
- `ch08-ex07` バグ修正チャレンジ（演習セル: 17, 19, 21, 23）
### 第9章

教材: `chapters/chapter_09_basics_mastery.ipynb`  演習: `exercises/chapter_09_basics_mastery_exercise.ipynb`  解答: `solutions/chapter_09_basics_mastery_solution.ipynb`

- `ch09-ex01` クラスの定義とプロパティ（演習セル: 2）
- `ch09-ex02` メソッドの実装（演習セル: 4）
- `ch09-ex03` アクセス修飾子とカプセル化（演習セル: 6）
- `ch09-ex04` 継承（演習セル: 8）
- `ch09-ex05` 例外処理（演習セル: 10）
- `ch09-ex06` 日付・時刻の操作（演習セル: 12）
- `ch09-ex07` ファイル操作（演習セル: 14）
- `ch09-ex08` 実践問題 - Loggerクラスの強化（演習セル: 16）
### 第10章

教材: `chapters/chapter_10_array_manipulation.ipynb`  演習: `exercises/chapter_10_array_manipulation_exercise.ipynb`  解答: `solutions/chapter_10_array_manipulation_solution.ipynb`

- `ch10-ex01` array_map - 全要素の変換（演習セル: 2）
- `ch10-ex02` array_filter - 条件によるフィルタリング（演習セル: 4）
- `ch10-ex03` array_reduce - 単一値への集約（演習セル: 6）
- `ch10-ex04` ソート - 様々な並べ替え（演習セル: 8）
- `ch10-ex05` 配列の結合・分割・抽出（演習セル: 10）
- `ch10-ex06` 実践問題1 - 商品データの集計（演習セル: 12）
- `ch10-ex07` 実践問題2 - タグシステム（演習セル: 14）
- `ch10-ex08` 実践問題3 - 配列ユーティリティクラス（演習セル: 16）
### 第11章

教材: `chapters/chapter_11_associative_array_manipulation.ipynb`  演習: `exercises/chapter_11_associative_array_exercise.ipynb`  解答: `solutions/chapter_11_associative_array_solution.ipynb`

- `ch11-ex01` 商品カタログシステム（基礎レベル）（演習セル: 2）
- `ch11-ex02` アンケート集計システム（中級レベル）（演習セル: 4）
- `ch11-ex03` 多言語対応メッセージシステム（上級レベル）（演習セル: 6）
### 第12章

教材: `chapters/chapter_12_classes_and_objects.ipynb`  演習: `exercises/chapter_12_classes_and_objects_exercise.ipynb`  解答: `solutions/chapter_12_classes_and_objects_solution.ipynb`

- `ch12-ex01` 図書館管理システム（基礎レベル）（演習セル: 2）
- `ch12-ex02` RPGゲームキャラクター（中級レベル）（演習セル: 4）
- `ch12-ex03` 銀行口座システム（上級レベル）（演習セル: 6）
### 第13章

教材: `chapters/chapter_13_properties_and_methods.ipynb`  演習: `exercises/chapter_13_properties_and_methods_exercise.ipynb`  解答: `solutions/chapter_13_properties_and_methods_solution.ipynb`

- `ch13-ex01` バリューオブジェクト（基礎レベル）（演習セル: 2）
- `ch13-ex02` ユーザークラス（中級レベル）（演習セル: 4）
- `ch13-ex03` QueryBuilder（上級レベル）（演習セル: 6）
### 第14章

教材: `chapters/chapter_14_inheritance.ipynb`  演習: `exercises/chapter_14_inheritance_exercise.ipynb`  解答: `solutions/chapter_14_inheritance_solution.ipynb`

- `ch14-ex01` 支払いシステム（基礎レベル）（演習セル: 2）
- `ch14-ex02` 通知システム（中級レベル）（演習セル: 4）
- `ch14-ex03` ECサイトの割引計算システム（上級レベル）（演習セル: 6）
### 第15章

教材: `chapters/chapter_15_access_modifiers.ipynb`  演習: `exercises/chapter_15_access_modifiers_exercise.ipynb`  解答: `solutions/chapter_15_access_modifiers_solution.ipynb`

- `ch15-ex01` カプセル化とアクセス制御（演習セル: 3）
- `ch15-ex02` 継承とアクセス修飾子（演習セル: 5）
- `ch15-ex03` マジックメソッド実装（演習セル: 7）
- `ch15-ex04` ユーザー権限管理システム（演習セル: 9）
- `ch15-ex05` データベースクエリビルダー（演習セル: 11）
- `ch15-ex06` CMSユーザーシステム（総合演習）（演習セル: 13）
### 第16章

教材: `chapters/chapter_16_namespaces.ipynb`  演習: `exercises/chapter_16_namespaces_exercise.ipynb`  解答: `solutions/chapter_16_namespaces_solution.ipynb`

- `ch16-ex01` 名前空間の基本（演習セル: 3）
- `ch16-ex02` useステートメントとエイリアス（演習セル: 5）
- `ch16-ex03` グローバル関数と名前空間（演習セル: 7）
- `ch16-ex04` 静的クラスと名前空間（演習セル: 9）
- `ch16-ex05` フェイス（インターフェース）の名前空間（演習セル: 11）
- `ch16-ex06` Composerシミュレーション（演習セル: 13）
### 第17章

教材: `chapters/chapter_17_exceptions.ipynb`  演習: `exercises/chapter_17_exceptions_exercise.ipynb`  解答: `solutions/chapter_17_exceptions_solution.ipynb`

- `ch17-ex01` ファイル操作の例外処理（演習セル: 3）
- `ch17-ex02` ユーザー認証システム（演習セル: 5）
- `ch17-ex03` REST API例外処理（演習セル: 7）
- `ch17-ex04` バッチ処理の例外処理（演習セル: 9）
- `ch17-ex05` 例外チェーン（演習セル: 11）
- `ch17-ex06` 非同期処理の例外処理（演習セル: 13）
### 第18章

教材: `chapters/chapter_18_database.ipynb`  演習: `exercises/chapter_18_database_exercise.ipynb`  解答: `solutions/chapter_18_database_solution.ipynb`

- `ch18-ex01` データベース接続クラスの作成（演習セル: 2）
- `ch18-ex02` ユーザー管理システムのCRUD操作（演習セル: 4）
- `ch18-ex03` トランザクション処理の実装（演習セル: 6）
- `ch18-ex04` 検索機能の高度化（演習セル: 8）
- `ch18-ex05` エラーハンドリングとログ出力（演習セル: 10）
- `ch18-extra01` リレーションシップの実装（演習セル: 12）
