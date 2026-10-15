<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2026/9/15 授業中の記述</title>
</head>
<body>
<pre><code>
&lt;html lang="ja"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;9/15(火)職業訓練授業&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;h1&gt;PHP&lt;/h1&gt;
&lt;!-- phpファイルだが、ブラウザで表示されるのは結果としてphpによって --&gt;
&lt;!-- 作成されるhtml構造なので、htmlの最初の記述は必須です。       --&gt;

&lt;!-- 入力テスト --&gt;
  &lt;p&gt;&lt;?php echo "Hello World"; ?&gt;&lt;/p&gt;

&lt;!-- 日本語の文字化けしないか確認　iniファイルを修正した事でバグがないか確認 --&gt;
  &lt;p&gt;&lt;?php echo "ひらがなカタカナ漢字　表示確認" ?&gt;&lt;/p&gt;

&lt;!-- PCの時刻と一致するか確認　iniファイルを修正した事でバグがないか確認 --&gt;
  &lt;p&gt;&lt;?php echo date("Y-m-d:H:i:s"); ?&gt;&lt;/p&gt;

&lt;!-- phpタグで書き出す事も可能だが、書き出されるソースが
      横一列になりバグの発見に支障が出たり、ソースが汚い為、非推奨 --&gt;
  &lt;?php
  echo "&lt;p&gt;テスト&lt;/p&gt;";
  echo "&lt;p&gt;テキストテキスト&lt;/p&gt;";
  ?&gt;

&lt;!-- MYSQLの画面よく使うからお気に入りブクマしましょう--&gt;
http://localhost/phpmyadmin

＜ページの左側のinfoなどtest以外は触ったらダメ。＞
xanmppの既存としてあるデータの為、test以外は触れない。

データベースのタグの作成ボタンの横にある
utf8mb4_general_ci は降順昇順の並び替えする時の内容

＜上部のタブの説明＞
SQL             :直接入力する事で命令できる
状態            :記録が残る所。あまり使わない。
ユーザーアカウント:権限別にアカウントを作成できる。
エクスポート      :データベースの取り出し →フォーマットの説明
インポート        :データベースの取入れ   →フォーマットの説明
インポートする方でエクスポートを合わせる。
インポートの横の設定からでも出来る。
文字セット       :使える文字
エンジン         ：データベースを構築する為のプログラム（設定）
主にInnoDBを選ぶ事がほとんど。

テストをクリックし
テーブル名にtestを入力、カラム4のまま作成を押す。
名前（一応日本語でも良い。が余り使わない。）
a
b
c
d
と入力しaの右側のAIの所に☑をいれる。
左下のSQLプレビューを押すと入力すべき項目がでて
テーブルを作成ができる。

&lt;/body&gt;
&lt;/html&gt;
&lt;!-- http://localhost/study/scl0915_lecture.php --&gt;
&lt;!-- ↑をコピペして外部のブラウザで開いて動作チェック --&gt;
</code></pre>
</body>
</html>