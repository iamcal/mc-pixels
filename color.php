<?php
	https://matkl.github.io/average-color/

	$blocks = [
		['oak log',		'6d 55 32'],
		['oak plank',		'a2 82 4e'],
		['oak log str',		'b1 90 56'],
		['oak log str top',	'a0 81 4d'],
	#	['oak log top',		'97 79 49'],

		['jung log',		'55 43 19'],
		['jung plank',		'a0 73 50'],
		['jung log str',	'ab 84 54'],
		['jung log str top',	'a5 7a 51'],
	#	['jung log top',	'95 6d 46'],

		['dk oak log',		'3c 2e 1a'],
		['dk oak plank',	'42 2b 14'],
		['dk oak log str',	'60 4c 31'],
		['dk oak log str top',	'41 2c 16'],
	#	['dk oak log top',	'40 2a 15'],

		['birch log',		'd8 d7 d2'],
		['birch plank',		'c0 af 79'],
		['birch log str',	'c4 b0 76'],
		['birch log str top',	'bf ab 74'],
	#	['birch log top',	'c1 b3 87'],

		['spruce log',		'3a 25 10'],
		['spruce plank',	'72 54 30'],
		['spruce log str',	'73 59 34'],
		['spruce log str top',	'69 50 2e'],
	#	['spruce log top',	'6c 50 2e'],

		['brn concrete',	'60 3b 1f'],
		['brn terracotta',	'4d 33 23'],
		['brn wool',		'72 47 28'],

		['sandstone top',	'df d6 aa'],
		['sandstone btm',	'd7 ca 9a'],
		['endstone',		'db de 9e'],
		['endstone bricks',	'da e0 a2'],
		['bone block',		'e5 e1 cf'],
		['bone block top',	'd1 ce b3'],
	];

	$targets = [
	#	'98 78 49',
	#	'91 71 42',
	#	'74 5A 36',
	#	'5F 4A 2B',
	#	'4C 3D 26',
	#	'38 2B 18',

		'C2 9D 62',
		'B8 94 5F',
		'AF 8F 55',
		'9F 84 4D',
		'96 74 41',
		'7E 62 37',
	];

#print_r(parse($targets[0]));
#exit;


	foreach ($targets as $col){
		$scores = [];
		foreach ($blocks as $bl){
			$scores[$bl[0]] = score($col, $bl[1]);
		}
		asort($scores);

		$list = array_keys($scores);

		#print_r($scores);
		#print_r($list);
		echo "$col -> {$list[0]} ({$scores[$list[0]]}) , {$list[1]} ({$scores[$list[1]]})\n";
	}



	function score($a, $b){

		list($r1, $g1, $b1) = parse($a);
		list($r2, $g2, $b2) = parse($b);

		return abs($r1-$r2) + abs($g1-$g2) + abs($b1-$b2);
	}

	function parse($str){
		$r = hexdec(substr($str, 0, 2));
		$g = hexdec(substr($str, 3, 2));
		$b = hexdec(substr($str, 6, 2));

		return [$r, $g, $b];
	}
