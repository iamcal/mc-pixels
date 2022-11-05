<?php
	#
	# load our color maps
	#

	$blocks = json_decode(file_get_contents(__DIR__.'/colors.json'), true);
	#print_r($blocks);


	#
	# parse target block
	#

	$target = 'gold_ore';
	$target = 'cobblestone';
	$target = 'block/tnt_side';
	$target = 'block/shulker_box';
	$target = 'shulker_simple';
	$target = 'simple_white_shulker';

	$src_img = imagecreatefrompng(__DIR__.'/'.$target.'.png');
	$w = imagesx($src_img);
	$h = imagesy($src_img);

	$img = imagecreatetruecolor($w, $h);
	imagecopy($img, $src_img, 0, 0, 0, 0, $w, $h);

	$colors = [];

	for ($x=0; $x<$w; $x++){
	for ($y=0; $y<$h; $y++){
		$rgb = imagecolorat($img, $x, $y);
		if (isset($colors[$rgb])){
			$colors[$rgb]++;
		}else{
			$colors[$rgb] = 1;
		}
	}
	}


	#
	# for each target block color, find the nearest block
	#

	foreach ($colors as $col_rgb => $num){
		$col = [
			($col_rgb >> 16) & 0xFF,
			($col_rgb >> 8) & 0xFF,
			$col_rgb & 0xFF,
		];

		$scores = [];
		foreach ($blocks as $bl_key => $bl_col){
			$scores[$bl_key] = score($col, $bl_col);
		}
		asort($scores);

		$list = array_keys($scores);

		$col_hex = sprintf('%06x', $col_rgb);

		echo "$col_hex -> \n";
		for ($i=0; $i<20; $i++){
			echo "\t{$list[$i]} ({$scores[$list[$i]]})\n";
		}
	}



	function score($a, $b){

		return abs($a[0]-$b[0]) + abs($a[1]-$b[1]) + abs($a[2]-$b[2]);
	}

