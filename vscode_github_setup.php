<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="今までレンタルサーバーを使用していましたが、自主的にGithubを使用しようと考えソースコードをアップロード（コミット・プッシュ）した手順の記録です。">
    <title>VSCodeとGitHubの連携手順 | 職業訓練及び自主学習</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .note-step {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 1px dashed #eee;
        }

        .note-step h3 {
            color: #1e3a8a;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .note-img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .note-badge {
            background-color: #ff8c00;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-right: 5px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <main class="main-content">
            <h2>VSCodeとGitHubの連携・初アップロード手順</h2>
            <p style="color: #666; margin-bottom: 30px;">ローカル環境（XAMPP）で作ったプログラムを、コマンドを使わずにVSCodeの基本機能だけでGitHubへ公開する手順のまとめです。</p>

            <!-- ステップ1 -->
            <div class="note-step">
                <h3><span class="note-badge">STEP 1</span>リポジトリの初期化とコミット</h3>
                <p>VSCodeの「ソース管理」タブ（左メニューの上から3つ目）を開き、リポジトリを初期化します。メッセージ欄に「最初のコミット」等の要約を入力し、青い「✓ コミット」ボタンを押して変更をローカル（PC内）に記録します。</p>
                <img src="img/step1.png" alt="初期化とコミット" class="note-img">
            </div>

            <!-- ステップ2 -->
            <div class="note-step">
                <h3><span class="note-badge">STEP 2</span>ブランチの発行とサインイン確認</h3>
                <p>コミットが完了すると「ブランチの発行」ボタンがタスクバーやブラウザに表示されるのでクリックします。公開範囲（Public）を選択すると、GitHubへのサインインを求められるので「Sign in with your browser」をクリックします。</p>
                <img src="img/step2.png" alt="サインイン画面" class="note-img">
            </div>

            <!-- ステップ3 -->
            <div class="note-step">
                <h3><span class="note-badge">STEP 3</span>ブラウザでの拡張機能・エコシステム承認</h3>
                <p>自動的にブラウザが起動し、GitHubの認証ページが開きます。右下にある緑色の「gitエコシステムを承認する（Authorize git-ecosystem）」ボタンをクリックして連携を許可します。</p>
                <img src="img/step3.png" alt="エコシステム承認" class="note-img">
            </div>

            <!-- ステップ4 -->
            <div class="note-step">
                <h3><span class="note-badge">STEP 4</span>GitHubへのパブリッシュ完了</h3>
                <p>VSCodeの画面に戻ると自動的にデータ送信が始まります。右下に「GitHubにリポジトリが正常に発行されました」と通知が出れば、無事ネット上へのアップロードは完了です！</p>
                <img src="img/step4.png" alt="パブリッシュ完了" class="note-img">
            </div>
        </main>

    </div>

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>