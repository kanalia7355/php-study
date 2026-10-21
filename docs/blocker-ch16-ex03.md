# 判断待ち: 第16章 問題3

## 元の要求と実行結果

`exercises/chapter_16_namespaces_exercise.ipynb` は、グローバル名前空間で独自の`date()`と`strlen()`を作成するよう要求する。既存解答も同じ再定義を含む。

PHP 8.3.6で以下を実行し、両方とも終了コード255となることを確認した。

```sh
php -r 'function date(string $format = "Y-m-d"): string { return "example"; }'
# Fatal error: Cannot redeclare date()
php -r 'function strlen(string $s): int { return 1; }'
# Fatal error: Cannot redeclare strlen()
```

## 提案（まだ適用しない）

問題文の修正案は`ch16-ex03-proposed.patch`。独自関数を`App\Custom`名前空間へ移し、グローバル側から独自関数とPHP組込み関数を呼び分ける。同名関数・名前空間・完全修飾名の学習目的を維持する。既存解答も、この変更に必要な範囲だけ整合させる。学習者workspaceへの解答の記入は行わない。

元の要件を保ったまま標準PHPで実行することはできないため、指示書の「要求仕様の実現が技術的に困難」の判断待ちとして扱う。承認前に当該課題の採点基準を独断で変更しない。

## 現在の実装・検証範囲

- 全18章のファイル対応を調査。基本104課題＋発展1課題を台帳に登録。
- 7つのNotebookのJSON構文を修復。教材内容の意味上の修正は未実施。
- 第1章5課題の採点CLI・未着手workspace・正答/誤答/再提出の検証を実装。
- 固定出力による模倣の拒否、無限ループの打切りをローカルとCIで検証。
- 第1章のGitHub Actions: https://github.com/kanalia7355/php-study/actions/runs/39589357536 — gradeジョブsuccess。
- 第2〜18章の採点・進捗永続化・README・全章統合テスト・独立レビューは未完了。PRは作成しておらず、mainは変更しない。
