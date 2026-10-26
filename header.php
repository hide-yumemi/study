<header class="site-header">
    <div class="site-title">
        <!-- 変更点：タイトルと検索窓を横並びにするための専用の枠（title-area）を追加 -->
        <div class="title-area">
            <a href="index.php" style="color: inherit; text-decoration: none; font-weight: inherit;">職業訓練及び自主学習</a>
            
            <!-- 🔍 メニューからここに引っ越し -->
            <form action="search_result.php" method="GET" class="header-search-form">
                <input type="text" name="keyword" class="header-search-input" placeholder="サイト内検索..." required>
                <button type="submit" class="header-search-btn">検索</button>
            </form>
        </div>
        
        <span class="site-desc">IT未経験の私が思い切ってIT業界へ転職する為の第一歩となる議事録・及び訓練校での学びを更新するサイトです。</span>
    </div>

    <nav class="nav-menu">
        <!-- 授業内容 -->
        <div class="menu-item">
            <button class="menu-btn">授業内容</button>
            <div class="dropdown-content">
                <a href="./0609_0703.php">2026/06/09～07/03<br>基本情報処理（60時間）</a>
                <a href="./0706_0914.php">2026/07/06～09/14<br>html/css/js(220時間)</a>
                <a href="./0915_1119.php">2026/09/15～11/19<br>データベース・php(208時間)</a>
            </div>
        </div>

        <!-- 定期テスト -->
        <div class="menu-item">
            <button class="menu-btn">定期テスト</button>
            <div class="dropdown-content">
                <a href="./test0629.php">第1回テスト問題</a>
                <a href="./test0803.php">第2回テスト問題</a>
                <a href="./test0903.php">第3回テスト問題</a>
                <a href="./test1005.php">第4回テスト問題</a>
            </div>
        </div>

        <!-- 自主学習 -->
        <div class="menu-item">
            <a href="./study_index.php" class="menu-btn study-link-btn">自主学習</a>
        </div>

        <!-- 作品 -->
        <div class="menu-item">
            <button class="menu-btn">作品</button>
            <div class="dropdown-content">
                <a href="./original_mannen.php">オリジナル万年カレンダー</a>
                <a href="./original_squash.php">オリジナルスカッシュ</a>
            </div>
        </div>
        </div>
    </nav>
</header>