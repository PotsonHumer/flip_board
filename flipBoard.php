<?php

	# 翻牌式跑馬燈 keyframes 組成

	/**
	* 產生 翻牌式跑馬燈 使用的 css3 keyframes
	* @param string $bindTo 定義的元素 (id or class)
	* @param integer $num 跑馬燈的數量
	* @param integer $baseSec 每個項目的停留時間 (秒)
	* @param integer $moveSec 每個項目的移動時間 (秒)
	* @param integer $slice 每個項目的高度
	* @param integer $unit 每個項目高度的單位
	* @return string css keyframes
	*/

	function marqueeStyle($bindTo=false,$num=0,$baseSec=1,$moveSec=0.5,$slice=1,$unit='rem'){
		if(empty($bindTo) || empty($num)) return false;

		++$num;

		$nowPercent = '0';
		$sec = $baseSec * $num + $moveSec * $num;

		$movePercent = round($moveSec / $sec * 100,2);
		$stopPercent = round($baseSec / $sec * 100,2);


		$style[] = $bindTo.'{';
		$style[] = '	-webkit-animation: mymove '.$sec.'s infinite;';
		$style[] = '	animation: mymove '.$sec.'s infinite;';
		$style[] = '}';

		$keyframes[] = "0% {margin-top: 0{$unit};}";
		$nowPercent = $nowPercent + $stopPercent;
		$keyframes[] = "{$nowPercent}% {margin-top: 0{$unit};}";

		while(++$i <= $num){
			$nowPercent = $nowPercent + $movePercent;
			$keyframes[] = "{$nowPercent}% {margin-top: -".$slice * $i."{$unit};}";
			$nowPercent = $nowPercent + $stopPercent;
			$keyframes[] = "{$nowPercent}% {margin-top: -".$slice * $i."{$unit};}";
		}

		$style[] = '@-webkit-keyframes mymove { '.implode("\n",$keyframes).' }';
		$style[] = '@keyframes mymove { '.implode("\n",$keyframes).' }';

		return implode("\n",$style);
	}

?>