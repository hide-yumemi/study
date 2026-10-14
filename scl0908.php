<!-- 講師が用意したファイル -->
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>リバーシ</title>
</head>
<body>

<script>
    let Flag=false;       // 白黒手番フラグ (false:白, true:黒)
    let M=new Array(10);  // 盤面情報配列
    const body=document.getElementsByTagName("body")[0];
    
    function computer()  // コンピュータの手関数
    {
        let y,x,n,obj,ban;
        for (let i=0;i<500;i++){
            y=Math.floor(Math.random()*8)+1;
            x=Math.floor(Math.random()*8)+1;
            n=(y-1)*8+(x-1);
            obj=document.getElementById("img"+n);
            ban=document.getElementById("img64");
            ban.src="./revershi/white.jpg"; // 【修正】フォルダパスを追加
            if (M[y][x]==0 && ok(y,x)){
                obj.src="./revershi/black.jpg"; // 【修正】フォルダパスを追加
                M[y][x]=2;
                reverse(y,x);
                Flag=!Flag;
                return;
            }
        }
        Flag=!Flag;  // 手が見つからなければ相手に手を渡す
    }
    
    function reverse(y,x)  // 自動反転関数
    {
        let n,obj;
        for (let dx=-1;dx<=1;dx++){
            for (let dy=-1;dy<=1;dy++){
                if (!(dx==0 && dy==0) && M[y][x]!=M[y+dy][x+dx]){
                    let ry=y,rx=x;
                    while (1<=rx && rx<=8 && 1<=ry && ry<=8 && M[ry][rx]!=0){
                        ry+=dy;rx+=dx;
                        if (M[y][x]==M[ry][rx]){  // 同じ色の駒
                            ry-=dy;rx-=dx;        // 1つ戻す
                            while (!(x==rx && y==ry)){
                                n=(ry-1)*8+(rx-1);
                                obj=document.getElementById("img"+n);
                                if (M[ry][rx]==1){  // 白なら黒に
                                     obj.src="./revershi/black.jpg";
                                     M[ry][rx]=2;
                                }
                                else {              // 黒なら白に
                                    obj.src="./revershi/white.jpg";
                                    M[ry][rx]=1;
                                }
                                ry-=dy;rx-=dx;      // 逆戻り
                            }
                            break;
                        }
                    }
                }
            }
        }
    }
    
    function ok(y,x)  // 置けるか調べる関数
    {
        if (Flag)
            M[y][x]=2;  // 黒を置く
        else
            M[y][x]=1;  // 白を置く
        for (let dx=-1;dx<=1;dx++){
            for (let dy=-1;dy<=1;dy++){
                if (!(dx==0 && dy==0) && M[y][x]!=M[y+dy][x+dx]){
                    let rx=x,ry=y;
                    while (1<=rx && rx<=8 && 1<=ry && ry<=8 && M[ry][rx]!=0 ){
                        rx+=dx;
                        ry+=dy;
                        if (M[y][x]==M[ry][rx]){  // 同じ色の駒に出会ったとき
                            return true;
                        }
                    }
                }
            }
        }
        M[y][x]=0;  // 駒のない状態に戻す
        return false;
    }
    
    function arrayinit()  // 配列初期化関数
    {
        for (let i=0;i<10;i++){
            M[i]=new Array(10);  // ２次元配列にする
        }
        for (let i=0;i<10;i++){
            for (let j=0;j<10;j++){
                M[i][j]=0;    // 駒無し
            }
        }
        M[4][4]=1;M[5][5]=1;  // 白駒
        M[4][5]=2;M[5][4]=2;  // 黒駒
    }
    
    function yx(event)  // クリックイベント処理関数
    {
        let y,x,n,obj,ban;
        
        // 【修正】画面の絶対座標ではなく、クリックされた画像(ターゲット)を基準に計算するように改善
        // これにより、画面の余白やスクロールによる座標のズレが完全になくなります
        const rect = event.target.getBoundingClientRect();
        
        // 元のロジックに合わせるため、マスの位置（50px〜）を算出
        let clickX = event.clientX - rect.left + parseFloat(event.target.style.left);
        let clickY = event.clientY - rect.top + parseFloat(event.target.style.top);
        
        y = Math.floor(clickY / 50);
        x = Math.floor(clickX / 50);
        
        // 盤面の範囲外（1〜8以外）なら処理しない
        if (y < 1 || y > 8 || x < 1 || x > 8) return;

        n=(y-1)*8+(x-1);
        obj=document.getElementById("img"+n);
        ban=document.getElementById("img64");
        
        if (M[y][x]==0 && ok(y,x)) {
            obj.src="./revershi/white.jpg";
            M[y][x]=1;
            reverse(y,x);
            Flag=!Flag;
            ban.src="./revershi/black.jpg";
            setTimeout(computer,3000);  // コンピュータの手
        }
    }
    
    function init()  // 盤面初期化関数
    {
        let img,n=0;
        for (let y=50;y<=50*8;y+=50){
            for (let x=50;x<=50*8;x+=50){
                if (n==27 || n==36){       // 白い駒
                    img="<img src='./revershi/white.jpg'";
                }
                else if (n==28 || n==35){  // 黒い駒
                    img="<img src='./revershi/black.jpg'"; // 【修正】末尾の不要なシングルクォーテーションを削除
                }
                else {                     // 駒無し
                    img="<img src='./revershi/green.jpg'";
                }
                body.insertAdjacentHTML("beforeend",img+" class='banimg' id='img"+n+"' style='position:absolute;left:"+x+"px;top:"+y+"px'>");
                n++;
            }
        }
        // 【修正】手番表示用の駒画像もフォルダパスを変更
        body.insertAdjacentHTML("beforeend","<img id='img64' src='./revershi/white.jpg' style='position:absolute;left:500px;top:50px'>");
        body.insertAdjacentHTML("beforeend","<input type='button' id='btn' value='計測' style='position:absolute;left:500px;top:150px'>");
        
        const banimg=document.getElementsByClassName("banimg");
        for(let i=0;i<banimg.length;i++){
        	banimg[i].onclick=function(event){
        		yx(event);
        	};
        }
    }
    
    init();
    arrayinit();
    
    document.getElementById("img64").onclick=function(){
    	document.getElementById("img64").src="./revershi/black.jpg"; // 【修正】フォルダパスを追加
    	Flag=!Flag;
    	setTimeout(computer,3000);
    }
    
    document.getElementById("btn").onclick=function(){
    	let black=0,white=0;
    	for(let i=1;i<9;i++){
    		for(let j=1;j<9;j++){
    			switch(M[i][j]){
    				case 1:
    					white++;
    					break;
    				case 2:
    					black++;
    					break;
    			}
    		}
    	}
    	alert("白"+white+"枚、黒"+black+"枚");
    }
</script>
</body>
</html>
