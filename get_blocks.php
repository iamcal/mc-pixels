<?php
	$map = [];

	$img = glob(__DIR__.'/block/*');
	foreach ($img as $key => $value){
		$info = getimagesize($value);
		if ($info['mime'] != 'image/png') continue;
		if ($info[0] != 16) continue;
		if ($info[1] != 16) continue;

		$avg = imagecreatefrompng($value);
		$w = $info[0];
		$h = $info[1];

		$tmp = imagecreatetruecolor(1, 1);
		imagecopyresampled($tmp, $avg, 0, 0, 0, 0, 1, 1, $w, $h);
		$rgb = imagecolorat($tmp, 0, 0);
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;


		$parts = pathinfo($value);
		$name = $parts['filename'];

		$map[$name] = [$r, $g, $b];
	}

	$fh = fopen(__DIR__.'/colors.json', 'w');
	fputs($fh, json_encode($map));
	fclose($fh);
