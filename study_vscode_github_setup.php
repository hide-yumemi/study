<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="今までレンタルサーバーを使用していましたが、自主的にGithubを使用しようと考えソースコードをアップロード（コミット・プッシュ）した手順の記録です。">
    <title>VSCodeとGitHubの連携手順 | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    <!-- ノート・共通追加CSSを読み込み -->
    <link rel="stylesheet" href="scl_style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <main class="main-content">

            <!-- 最上部の見出しタイトル（他の学習ノートのルールに準拠） -->
            <h2>VSCodeとGitHubの連携・初アップロード手順</h2>

            <!-- 概要セクション -->
            <div class="note-section">
                <h3 class="note-title">連携の概要</h3>
                <p>ローカル環境（XAMPP）で作ったプログラムを、コマンドを使わずにVSCodeの基本機能だけでGitHubへ公開する手順のまとめです。</p>
            </div>

            <!-- ステップ1 -->
            <div class="note-section">
                <h3 class="note-title">STEP 1. リポジトリの初期化とコミット</h3>
                <p>VSCodeの「ソース管理」タブ（左メニューの上から3つ目）を開き、リポジトリを初期化します。メッセージ欄に「最初のコミット」等の要約を入力し、青い「✓ コミット」ボタンを押して変更をローカル（PC内）に記録します。</p>
                <div class="note-img-container">
                    <img src="img/step1.png" alt="初期化とコミット" class="note-img">
                </div>
            </div>

            <!-- ステップ2 -->
            <div class="note-section">
                <h3 class="note-title">STEP 2. ブランチの発行とサインイン確認</h3>
                <p>コミットが完了すると「ブランチの発行」ボタンがタスクバーやブラウザに表示されるのでクリックします。公開範囲（Public）を選択すると、GitHubへのサインインを求められるので「Sign in with your browser」をクリックします。</p>
                <div class="note-img-container">
                    <img src="img/step2.png" alt="サインイン画面" class="note-img">
                </div>
            </div>

            <!-- ステップ3 -->
            <div class="note-section">
                <h3 class="note-title">STEP 3. ブラウザでの拡張機能・エコシステム承認</h3>
                <p>自動的にブラウザが起動し、GitHubの認証ページが開きます。右下にある緑色の「gitエコシステムを承認する（Authorize git-ecosystem）」ボタンをクリックして連携を許可します。</p>
                <div class="note-img-container">
                    <img src="img/step3.png" alt="エコシステム承認" class="note-img">
                </div>
            </div>

            <!-- ステップ4 -->
            <div class="note-section">
                <h3 class="note-title">STEP 4. GitHubへのパブリッシュ完了</h3>
                <p>VSCodeの画面に戻ると自動的にデータ送信が始まります。右下に「GitHubにリポジトリが正常に発行されました」と通知が出れば、無事ネット上へのアップロードは完了です！</p>
                <div class="note-img-container">
                    <img src="img/step4.png" alt="パブリッシュ完了" class="note-img">
                </div>
            </div>

            <!-- 戻るリンクの位置をボックス外に統一 -->
            <p style="margin-top: 25px;">
                <a href="study_index.php" class="td-link">←前のページへ</a>
            </p>
            
        </main>
    </div>

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>
