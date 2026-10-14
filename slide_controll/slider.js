let slide;//#slide取得
let image;//画像の親のli取得
let TimeID;//全体のsettimeout
let timeID;//見えてる２枚のsettimeout
let cnt=0;//左に消えていく画像番号
let cnt2=1;//右から見えてくる画像番号
let posi1,posi2;//見えてる２枚の画像の位置
let max_width,max_height;//スライダーのサイズ
let controll;//#controll取得
let btn;//コントロールボタンの親のli取得
let stop_time=2000;//画像の停止時間
let idou_time=10;//指定時間ごとに移動処理
let idou__kyori=5;//画像が上記idou_time＋処理時間で5px移動
let keika_time;//画像が完全に切り替わるまでの時間
let flag=true;//移動ボタンの有効無効判定
function disp(){//次の画像の準備をして指定時間後スライド開始
	cnt2=cnt+1;
	if(cnt2===image.length){
		cnt2=0;
	}
	image[cnt2].style.display="list-item";
	posi1=0;
	posi2=max_width;//２枚の画像の初期位置
	slider();
	timeID=setTimeout(disp,keika_time+stop_time);
//停止時間＋１枚移動が終わるまでにかかった時間ごとに繰り返し
}
function slider(){//見えてる２枚の画像の移動
	TimeID=setTimeout(slider,idou_time);
	posi1-=idou__kyori;
	posi2-=idou__kyori;
	image[cnt].style.left=posi1+"px";
	image[cnt2].style.left=posi2+"px";
	flag=false;//移動が開始したらボタン有効に
	if(posi2<=idou__kyori){//次の移動で停止位置を通り過ぎないかの判定
		image[cnt2].style.left="0px";
		btn[cnt].style.opacity="1.0";
		btn[cnt2].style.opacity="0.5";
/*
	opacity・・・不透明度指定（0～1）
	表示されてから左に消えていく間その画像のボタンのみ薄くしてどの画像かわかるように
*/
		image[cnt].style.display="none";//画面から外れたらdisplayをnone
		cnt++;
		if(cnt===image.length){
			cnt=0;
		}
		clearTimeout(TimeID);
	}
}
window.onload=function(){//画像を表示終わったら自動スタート
	let con="<ul id='controll'>";
	max_width=0;
	max_height=0;
	slide=document.getElementById("slide")
	image=slide.getElementsByTagName("li");
	for(i=0;i<image.length;i++){
		let width=image[i].getElementsByTagName("img")[0].naturalWidth;
		let height=image[i].getElementsByTagName("img")[0].naturalHeight;
//naturalWidth・naturalHeight・・・画像のサイズ取得
		if(max_width<width){
			max_width=width;
		}
		if(max_height<height){
			max_height=height;
		}
//スライドショーに設定された画像の最大サイズを確認
		con+="<li onclick='idou("+i+")'>●</li>";
//画像の枚数分、選択用の●設置
	}
	con+="</ul><div id='back' onclick='idou(cnt-1)'></div><div id='next' onclick='idou(cnt+1)'></div>";
	slide.insertAdjacentHTML ("afterend",con);
	controll=document.getElementById("controll");
	btn=controll.getElementsByTagName("li");
	controll.style.width=max_width+"px";
	slide.style.width=max_width+"px";
	slide.style.height=max_height+"px";
	changeSet();
	keika_time=(Math.floor(max_width/idou__kyori))*(idou_time+10);//10は処理時間10ms目安
	setTimeout(disp,stop_time);//停止時間経過後にスライド開始
}
function idou(x){//コントロールボタンでの移動や前後の画像への移動
	if(flag){//ボタン連打によるバグ回避
		return;
	}
	else{
		flag=!flag;
	}
	clearTimeout(TimeID);
	clearTimeout(timeID);
//表示画像切り替えるので、いったん現状のsettimeoutは両方終了
//以下、指定された画像へ表示を切り替えてスライド再開
	if(x<0){
		x=image.length-1;
	}
	if(x>=image.length){
		x=0;
	}
	image[x].style.left="0px";
	image[cnt].style.display="none";
	image[cnt2].style.display="none";
	image[x].style.display="list-item";
	btn[cnt].style.opacity="1";
	btn[x].style.opacity="0.5";
	cnt=x;
	setTimeout(disp,stop_time);
}

function changeSet(){//next、backボタンの位置決め
	let clientRect=slide.getBoundingClientRect();
	let slide_x=window.pageXOffset+clientRect.left;
	let slide_y=window.pageYOffset+clientRect.top;
/*
	getBoundingClientRect()・・・要素の座標取得
	上記の.left・.top・・・画面端からの指定方向距離
	window.pageXOffset・window.pageYOffset・・・windowのスクロール量
	これを利用し以下で移動ボタンの表示場所指定
	window.scrollX,window.scrollYのエイリアスなので同じ結果
	VScodeではpageXOffsetは非推奨と出るが、以前はクロスブラウザ対策で
	使用していたが、今はその必要ないから古い書き方という意味
	ただし、mozillaではクロスブラウザ対策としてpageXOffsetを記載している
*/
	const next=document.getElementById("next");
	const back=document.getElementById("back");
	next.style.left=(slide_x+max_width-30)+"px";
	back.style.left=(slide_x-20)+"px";
	next.style.top=(slide_y+(max_height/2)-25)+"px";
	back.style.top=(slide_y+(max_height/2)-25)+"px";
}

window.onresize=changeSet;//画面サイズが変更されたらイベント発火