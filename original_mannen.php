<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="自作万年カレンダー">
    <title>自作万年カレンダー</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="scl_style.css">
</head>

<style>
    /* VSCode風のダークテーマ・コード表示用スタイル */
    .code-viewer-container {
        background-color: #1e1e1e;
        color: #d4d4d4;
        font-family: 'Consolas', 'Courier New', monospace;
        font-size: 14px;
        line-height: 20px;
        padding: 20px;
        border-radius: 8px;
        overflow-x: auto;
        margin: 20px 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .code-viewer-table {
        border-collapse: collapse;
        width: 100%;
    }

    .code-viewer-table tr {
        counter-increment: line-number;
    }

    /* 行番号のエリア（コピーされない設定） */
    .code-line-num {
        width: 40px;
        text-align: right;
        padding-right: 15px;
        color: #858585;
        user-select: none;
        -webkit-user-select: none;
        border-right: 1px solid #3c3c3c;
        vertical-align: top;
    }

    .code-line-num::before {
        content: counter(line-number);
    }

    /* コード本文のエリア */
    .code-line-content {
        padding-left: 15px;
        white-space: pre-wrap;
        vertical-align: top;
        text-align: left;
    }
</style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <main class="main-content">

            <!-- リアルに動く画面パーツ -->
            <h1>万年カレンダー</h1>
            <div class="input-area">
                <input id="year" type="text" placeholder="西暦を入力"> 年
                <input id="month" type="text" placeholder="月を入力"> 月
                <button id="btn">カレンダーを表示</button>
            </div>
            <h3>基本構成のみなので、前月、翌月の機能は実装しておりません。</h3>
            <p>補足1：年の入力値は基準1600年としているので、それ以上の数値を入力下さい。</p>
            <p>補足2：月の入力値は1～12月までなので、それ以外の数字は回答がありません</p>
            <table id="calendar"></table>

            <!-- 実際の動作プログラム -->
            <script>
                const btn = document.getElementById("btn");

                btn.addEventListener("click", (e) => {
                    const is_year = parseInt(document.getElementById("year").value);
                    const is_month = parseInt(document.getElementById("month").value);
                    let month_days = ;

                    if (is_year % 400 === 0 || (is_year % 4 === 0 && is_year % 100 !== 0)) {
                        month_days[1] = 29;
                    }
                    let uru_year = 0;
                    let uru_not_year = 0;
                    for (let y = 1600; y < is_year; y++) {
                        if (y % 400 === 0 || (y % 4 === 0 && y % 100 !== 0)) {
                            uru_year++;
                        } else {
                            uru_not_year++;
                        }
                    }

                    let Total_days = (uru_year * 366) + (uru_not_year * 365);

                    for (let i = is_month - 2; i >= 0; i--) {
                        Total_days = Total_days + month_days[i];
                    }

                    let youbi = Total_days % 7;
                    let day_shift = 0;

                    if (youbi === 0) {
                        day_shift = -6;
                    } else if (youbi === 6) {
                        day_shift = -5;
                    } else if (youbi === 5) {
                        day_shift = -4;
                    } else if (youbi === 4) {
                        day_shift = -3;
                    } else if (youbi === 3) {
                        day_shift = -2;
                    } else if (youbi === 2) {
                        day_shift = -1;
                    } else if (youbi === 1) {
                        day_shift = 0;
                    }

                    let day = 1 + day_shift;
                    let end_day = month_days[is_month - 1];

                    let box_table = "";
                    box_table += "<tr><th>日</th><th>月</th><th>火</th><th>水</th><th>木</th><th>金</th><th>土</th></tr>";

                    while (day <= end_day) {
                        box_table += "<tr>";
                        for (let i = 0; i < 7; i++) {
                            if (day < 1 || day > end_day) {
                                box_table += "<td></td>";
                            } else {
                                box_table += "<td>" + day + "</td>";
                            }
                            day++;
                        }
                        box_table += "</tr>";
                    }

                    document.getElementById("calendar").innerHTML = box_table;
                });
            </script>



            <div class="code-viewer-container">
                <table class="code-viewer-table">
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">const btn = document.getElementById("btn");</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">btn.addEventListener("click", (e) =&gt; {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> const is_year = parseInt(document.getElementById("year").value);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> const is_month = parseInt(document.getElementById("month").value);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let month_days =;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (is_year % 400 === 0 || (is_year % 4 === 0 &amp;&amp; is_year % 100 !== 0)) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> month_days = 29;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let uru_year = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let uru_not_year = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> for (let y = 1600; y &lt; is_year; y++) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (y % 400 === 0 || (y % 4 === 0 &amp;&amp; y % 100 !== 0)) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> uru_year++;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> uru_not_year++;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let Total_days = (uru_year * 366) + (uru_not_year * 365);</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> for (let i = is_month - 2; i &gt;= 0; i--) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> Total_days = Total_days + month_days[i];</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let youbi = Total_days % 7;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let day_shift = 0;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (youbi === 0) { day_shift = -6; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 6) { day_shift = -5; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 5) { day_shift = -4; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 4) { day_shift = -3; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 3) { day_shift = -2; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 2) { day_shift = -1; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> else if (youbi === 1) { day_shift = 0; }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let day = 1 + day_shift;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let end_day = month_days[is_month - 1];</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> let box_table = "";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> box_table += "&lt;tr&gt;&lt;th&gt;日&lt;/th&gt;&lt;th&gt;月&lt;/th&gt;&lt;th&gt;火&lt;/th&gt;&lt;th&gt;水&lt;/th&gt;&lt;th&gt;木&lt;/th&gt;&lt;th&gt;金&lt;/th&gt;&lt;th&gt;土&lt;/th&gt;&lt;/tr&gt;";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> while (day &lt;= end_day) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> box_table += "&lt;tr&gt;";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> for (let i = 0; i &lt; 7; i++) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> if (day &lt; 1 || day &gt; end_day) {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> box_table += "&lt;td&gt;&lt;/td&gt;";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> } else {</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> box_table += "&lt;td&gt;" + day + "&lt;/td&gt;";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> day++;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> box_table += "&lt;/tr&gt;";</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> }</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"></td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content"> document.getElementById("calendar").innerHTML = box_table;</td>
                    </tr>
                    <tr>
                        <td class="code-line-num"></td>
                        <td class="code-line-content">});</td>
                    </tr>
                </table>
            </div>

        </main>
    </div>

    <a href="#" class="top-button" aria-label="ページトップへ戻る">▲ TOP</a>

</body>

</html>