<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="7/23(木)の職業訓練授業ノートです。ブロックレベル要素・インライン要素などの表示形式、vertical-alignプロパティ、calc()関数の注意点、およびFlexboxの基礎についてまとめています。">
    <title>CSSの表示形式（display）とFlexboxレイアウト・calc関数のルール | 職業訓練及び自主学習</title>
    <!-- 共通のベースCSSを読み込み -->
    <link rel="stylesheet" href="style.css">
    
    <!-- このページをさらに見やすくするための専用埋め込みスタイル -->
    <style>
        .note-section {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }
        .note-title {
            color: #1e3a8a;
            font-size: 18px;
            font-weight: bold;
            border-left: 5px solid #ff8c00; /* オレンジのアクセント縦線 */
            padding-left: 12px;
            margin-bottom: 15px;
            margin-top: 0;
        }
        .note-section p {
            font-size: 15px;
            color: #334155;
            line-height: 1.7;
            margin-bottom: 12px;
        }
        .note-section p:last-child {
            margin-bottom: 0;
        }
        .note-section ul, 
        .note-section ol {
            padding-left: 20px;
            margin: 12px 0;
        }
        .note-section li {
            font-size: 14.5px;
            color: #475569;
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .note-section li strong {
            color: #1e3a8a;
        }
        code {
            font-family: Consolas, Monaco, monospace;
            background-color: #f1f5f9;
            color: #b91c1c;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
        }
        pre {
            background: #f8fafc;
            padding: 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            overflow-x: auto;
            font-family: Consolas, Monaco, monospace;
            font-size: 14px;
            line-height: 1.5;
            margin: 15px 0;
            color: #334155;
        }
        .sub-heading {
            font-size: 16px;
            font-weight: bold;
            color: #1e3a8a;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
        }
        .info-box {
            background-color: #f0f4f8;
            border-radius: 6px;
            padding: 15px;
            margin-top: 15px;
            border-left: 4px solid #64748b;
        }
        .alert-box {
            background-color: #fff1f2;
            border-left: 4px solid #f43f5e;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            color: #b91c1c;
            font-weight: bold;
            font-size: 14.5px;
        }
    </style>
</head>
<body>

    <!-- 共通ヘッダー -->
    <?php include 'header.php'; ?>

    <!-- メインレイアウト（共通CSSの2カラム構造） -->
    <div class="container">
        <main class="main-content">
            <h2>7/23(木) 職業訓練授業ノート</h2>
            <p style="color: #666; font-size: 14px; margin-bottom: 35px;">要素の表示形式（display）による余白ルールの違い、縦位置の制御、calc関数の注意点、およびFlexboxレイアウトの基礎</p>

            <!-- セクション1 -->
            <div class="note-section">
                <h3 class="note-title">1. ボックスモデルとdisplayの初期値（表示形式）のルール</h3>
                <p>HTMLの各タグには、ブラウザで表示する際のはじめの見た目のルール（表示形式の初期値）が定められており、それによってボックスモデルの余白やサイズが効くかどうかが厳格に分かれます 。</p>
                
                <div class="sub-heading">■ ブロックレベル要素（<code>display: block</code>）</div>
                <p><strong>対象タグ：</strong> 見出し系（h1〜h6）、セクション系（section, mainなど）、<code>p</code>, <code>div</code>, <code>ul</code>, <code>ol</code>, <code>dl</code>, <code>dt</code>, <code>dd</code> など </p>
                <ul>
                    <li>上から下へ縦に積み重なるように配置される。</li>
                    <li>ボックスモデルの5種（<code>width</code>, <code>height</code>, <code>margin</code>, <code>padding</code>, <code>border</code>）の命令が**すべて有効**。</li>
                </ul>

                <div class="sub-heading">■ リストアイテム要素（<code>display: list-item</code>）</div>
                <p><strong>対象タグ：</strong> <code>li</code> </p>
                <ul>
                    <li>ブロックレベル要素とほぼ同じ性質を持ち、ボックスモデルの5種をすべて持ちます 。</li>
                </ul>

                <div class="sub-heading">■ インライン要素（<code>display: inline</code>）</div>
                <p><strong>対象タグ：</strong> <code>em</code>, <code>strong</code>, <code>a</code>, <code>span</code> など </p>
                <ul>
                    <li>文章の一部として左から右へ横並びに流れるように配置される。</li>
                    <li>原則としてボックスモデルの5種を**すべて持たない（<code>width</code>/<code>height</code>が完全に効かない）** 。</li>
                    <li><strong>💡 実務での補足・検証：</strong> 左右の <code>margin</code> / <code>padding</code>、および4方向 of <code>border</code> は実際には適用されます 。ただし、上下のパディングやマージンを指定しても、前後の行を上下に押し退けることはせず、周りの行と重なって表示されます 。</li>
                </ul>

                <div class="sub-heading">■ 特殊なインライン要素（置換要素：画像）</div>
                <p><strong>対象タグ：</strong> <code>img</code> </p>
                <ul>
                    <li>初期状態の表示形式は <code>inline</code> ですが、画像を表示させる特殊な性質を持っています 。</li>
                    <li>インラインでありながら、<code>width</code>, <code>height</code>, <code>border</code> をしっかりと保持してサイズ変更が可能です 。</li>
                    <li><strong>💡 実務での補足・検証：</strong> <code>img</code> タグは特殊なため、ブロック要素と同様に <code>margin</code> や <code>padding</code> もすべて指定可能です 。</li>
                    <li>値を <code>display: none;</code> に変更すると、要素の存在ごと画面から完全に非表示にできます 。</li>
                </ul>
            </div>

            <!-- セクション2 -->
            <div class="note-section">
                <h3 class="note-title">2. 文字・画像の縦位置（vertical-align プロパティ）</h3>
                <p>横に並んだ文字や画像に対して、上下の縦方向の配置の基準位置を揃えるために使用します 。※<code>display: inline;</code> または表（テーブル）関係のタグでのみ使用可能です 。</p>
                
                <div class="sub-heading">■ 主な設定値と位置（4本線と文字の基準）</div>
                <ul>
                    <li><code>baseline</code>（初期値）：通常の文字の底辺に揃える 。</li>
                    <li><code>top</code>：行の最上部に揃える 。</li>
                    <li><code>text-top</code>：文字の頭に揃える 。</li>
                    <li><code>middle</code>：エリアの中心と文字の中心を同じ位置にする（**縦の中央揃え**） 。</li>
                    <li><code>text-bottom</code>：文字の足元に揃える 。</li>
                    <li><code>bottom</code>：行の最下部に揃える 。</li>
                    <li><code>super</code>：上付き文字（ <code>sup</code> タグ）と同じ位置にする 。※実務補足：実際には1996年のCSS1から存在する非常に古い値で、どのブラウザでも昔から安定して動作します 。</li>
                </ul>

                <div class="sub-heading">💡 【重要Tips】imgタグの下に生まれる謎の隙間の解消対策</div>
                <p>写真を複数縦に並べた際、CSSでマージンやパディングを <code>0</code> に設定しているにもかかわらず、画像の下に数ピクセルの「謎の隙間」が空いてしまうバグが起きます 。これは初期値が <code>baseline</code> になっているため、下一本分の隙間を表示しようとしてしまうためです 。</p>
                <div class="alert-box" style="background-color: #f1f5f9; border-left: 4px solid #64748b; color: #334155;">
                    解決策：実務では、画像に対して以下のように値を統一し、ベースラインの縛りを解除して隙間バグを消し去る手法が定番となっています 。<br>
                    <code>img { vertical-align: bottom; } /* または top */</code>
                </div>
            </div>

            <!-- セクション3 -->
            <div class="note-section">
                <h3 class="note-title">3. CSSの値に計算式を使う（calc 関数）</h3>
                <p>CSSの数値や幅の指定の中に、数式を書いてブラウザに自動計算させることができる非常に便利な機能です 。</p>
                <ul>
                    <li><strong>割り切れない数値の時：</strong> 3分割したい時に <code>calc(100% / 3)</code> や <code>calc(100px / 3)</code> と書けば、33.3333...%のような曖昧な指定をせずピシッと割り振れます 。</li>
                    <li><strong>異なる単位の組み合わせ：</strong> 横幅いっぱいの画面から、特定の固定幅を引いた残りを指定したい時などに <code>calc(100% - 40px)</code> のように指定できます 。</li>
                </ul>

                <div class="alert-box">
                    ⚠️ 【超重要・最厳格ルール】<br>
                    足し算（ + ）と引き算（ - ）の前後には、必ず「半角スペース」を空けて記述しなければなりません！<br>
                    × calc(100%-40px) ➔ スペースがないとエラーになり機能しません 。<br>
                    ◯ calc(100% - 40px) ➔ 必ず前後にスペースを入れること 。<br>
                    ※「*」や「/」はスペースなしでも動きますが、ミスの防止と統一感のためにすべての演算子の前後にスペースを入れるのが実務の鉄則です 。
                </div>
            </div>
            <!-- セクション4 -->
            <div class="note-section">
                <h3 class="note-title">4. フレキシブルレイアウト（display: flex）</h3>
                <p>親要素（コンテナ）に対して <code>display: flex;</code> を指定することで、その直下にある子要素（アイテム）を一瞬で横並びに配置できる、現代のWeb制作で最も強力なレイアウト手法です 。</p>
                <ul>
                    <li>指定した瞬間、子要素の横幅の初期値は「100%（横いっぱいに広がる性質）」から「<code>auto</code>（中のコンテンツに必要な最小限の幅）」へと自動で書き換わります 。</li>
                </ul>

                <!-- 💡 ご提示いただいた解説画像をここに美しく組み込みました！ -->
                <div class="sub-heading">■ 【参考視覚資料】文字・画像の縦位置（vertical-align）の基準関係図</div>
                <div style="text-align: center; margin: 15px 0; background-color: #f8fafc; padding: 15px; border: 1px solid #cbd5e1; border-radius: 8px;">
                    <img src="img/vertical-align.png" alt="vertical-alignの基準位置関係図" style="max-width: 100%; height: auto; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 4px 8px rgba(0,0,0,0.05);">
                    <p style="font-size: 13px; color: #666; margin-top: 8px; margin-bottom: 0;">※インライン要素やテーブル要素における縦方向の揃え位置を示した解説図 </p>
                </div>

                <div class="sub-heading">⚠️ 【超重要概念】「主軸（Main Axis）」と「交差軸（Cross Axis）」</div>
                <p>Flexboxの各種配置プロパティを扱う上で、最も大切なのが「主軸」の理解です 。配置ルールは単なる絶対的な上下左右ではなく、<strong>向き（direction）によって縦横の役割がカチャカチャと入れ替わる動的な仕組み</strong>になっています 。</p>

                <p><strong>・ <code>flex-direction: row;</code> （横並び：初期値）のとき</strong></p>
                <p>主軸（並ぶ方向）は**「水平（横）方向」**、交差軸は**「垂直（縦）方向」**になります 。</p>
                
                <p style="margin-top: 15px;"><strong>・ <code>flex-direction: column;</code> （縦並び）のとき</strong></p>
                <p>主軸（並ぶ方向）は**「垂直（縦）方向」**、交差軸は**「水平（横）方向」**へと完全に反転します 。そのため、水平方向を揃えるはずのプロパティが縦方向の制御（上寄せ・下寄せ）に変化します 。</p>
                
                <div class="info-box" style="background-color: #fff1f2; border-left: 4px solid #f43f5e; color: #b91c1c;">
                    <strong>💡 flex-direction: column 時の横幅に関する補足：</strong><br>
                    縦並び（column）にした際、子要素が自動で横いっぱいにビシッと広がって配置される現象が起きます 。これはwidthの初期値が100%に変わったからではなく、交差軸方向（横方向）に対して初期値の「 <code>align-items: stretch</code> （隙間なく引き伸ばす）」という機能が自動で働くためです 。
                </div>

                <div class="sub-heading">■ flex-direction プロパティ（並び順・向き）</div>
                <ul>
                    <li><code>row</code>（初期値）： 左から右へ横並びに配置 。</li>
                    <li><code>row-reverse</code>： 右から左へ逆順で横並びに配置（親要素の右寄せのようになります） 。</li>
                    <li><code>column</code>： 上から下へ縦並びに配置 。</li>
                    <li><code>column-reverse</code>： 下から上へ逆順で縦並びに配置 。</li>
                </ul>

                <div class="sub-heading">■ flex-wrap プロパティ（折り返しのルール）</div>
                <ul>
                    <li><code>nowrap</code>（初期値）： 子要素のwidth指定をすべて無視して、強引に「1行」の中に強制表示します 。</li>
                    <li><code>wrap</code>： 1行に入り切らなくなった場合、子要素のwidthの数値を優先し、自動で「2行目」へと折り返します 。</li>
                </ul>

                <div class="sub-heading">■ justify-content プロパティ（主軸方向の配置バランス）</div>
                <ul>
                    <li><code>flex-start</code>（初期値）： 先頭寄せ（横並びなら左寄せ、縦並びなら上寄せ） 。</li>
                    <li><code>flex-end</code>： 末尾寄せ（横並びなら右寄せ、縦並びなら下寄せ） 。</li>
                    <li><code>center</code>： 中央揃え（横並びなら横の中央、縦並びなら縦の中央揃え） 。</li>
                    <li><code>space-between</code>： 最初と最後の子要素を両端の壁にピッタリとくっつけ、あいだの隙間を均等配置する 。</li>
                    <li><code>space-around</code>： 各子要素の左右に均等な余白を割り振る（端の隙間は狭くなります） 。</li>
                    <li><code>space-evenly</code>： 画面の両端の壁も含めて、すべての余白（隙間）を完全に均等配置します 。</li>
                </ul>

                <div class="sub-heading">■ flex-grow プロパティ（子要素の伸縮率）</div>
                <p>親ボックスに対して画面幅に余裕（余白）が余っている時、配置場所を決めるのではなく「メインの部分等にそのエリアを広く使わせる」という考え方の配置を行うプロパティです 。</p>
                <ul>
                    <li>特定の要素だけに <code>flex-grow: 1;</code> を指定 ➔ 余っているすべての空きスペースがその要素だけに100%割り振られ、横いっぱいに引き伸ばされます 。</li>
                    <li>要素Aと要素Bに <code>flex-grow: 1;</code> を指定 ➔ 空きスペースが「1：1」の比率で均等に割り振られます 。</li>
                    <li>要素Aに <code>1</code> 、要素Bに <code>2</code> を指定 ➔ 空きスペースが「1：2」の比率で細かく配分され、要素Bの方が2倍の勢いで余白を吸収して大きく広がります 。</li>
                </ul>
            </div>

        </main>

        <!-- 右側：更新履歴（共通パーツ history.php を呼び出し、右横並びにします） -->
        <?php include 'history.php'; ?>

    </div> <!-- .container -->

    <!-- 右下：トップボタン -->
    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>
</html>
