<?php
//header('Content-Type: image/png');

// Create image
$im = imagecreatetruecolor(900, 900);
//imageantialias($im, TRUE);
$white = imagecolorallocate($im, 255, 255, 255);

//Create security colour array
$security[10] = imagecolorallocate($im, 47, 239, 239);
$security[9] = imagecolorallocate($im, 72, 240, 192);
$security[8] = imagecolorallocate($im, 0, 239, 71);
$security[7] = imagecolorallocate($im, 0, 240, 0);
$security[6] = imagecolorallocate($im, 143, 239, 47);
$security[5] = imagecolorallocate($im, 239, 239, 0);
$security[4] = imagecolorallocate($im, 215, 119, 0);
$security[3] = imagecolorallocate($im, 240, 96, 0);
$security[2] = imagecolorallocate($im, 240, 72, 0);
$security[1] = imagecolorallocate($im, 215, 48, 0);
$security[0] = imagecolorallocate($im, 240, 0, 0);
$security[-1] = imagecolorallocate($im, 240, 0, 0);
$security[-2] = imagecolorallocate($im, 240, 0, 0);
$security[-3] = imagecolorallocate($im, 240, 0, 0);
$security[-4] = imagecolorallocate($im, 240, 0, 0);
$security[-5] = imagecolorallocate($im, 240, 0, 0);
$security[-6] = imagecolorallocate($im, 240, 0, 0);
$security[-7] = imagecolorallocate($im, 240, 0, 0);
$security[-8] = imagecolorallocate($im, 240, 0, 0);
$security[-9] = imagecolorallocate($im, 240, 0, 0);
$security[-10] = imagecolorallocate($im, 240, 0, 0);

//Get system list
$systems = json_decode(exec("php systemsesc.php"));

//Get jumps list
$jumps = json_decode(exec("php jumps.php"));

// Draw a white rectangle
//imagefilledrectangle($im, 4, 4, 50, 25, $white);

set_time_limit(300);

//Draw jumps
$linec = imagecolorallocate($im, 40, 0, 89);
for($i = 0; $i < count($jumps); $i++) {
	$x1 = xo(mToLy($jumps[$i]->originX));
	$y1 = yo(mToLy($jumps[$i]->originZ));
	$x2 = xo(mToLy($jumps[$i]->destX));
	$y2 = yo(mToLy($jumps[$i]->destZ));
	imageline($im, $x1, $y1, $x2, $y2, $linec);
}

//Draw capital jump ranges
$max = 50000000;
$sys = null;
$linec = imagecolorallocatealpha($im, 0, 156, 255, 125);
for($i = 0; $i < count($systems); $i++) {
	//If origin is low/null
	if($systems[$i]->security < 0.45) {
		$o = $systems[$i];
		//Check other systems
		$jumps = 0;
		for($ii = 0; $ii < count($systems); $ii++) {
			//If destination is low/null
			if($systems[$ii]->security < 0.45) {
				$d = $systems[$ii];

				//Check range
				$dist = mToLy(sqrt(pow($d->x - $o->x, 2) + pow($d->y - $o->y, 2) + pow($d->z - $o->z, 2)));
				if($dist <= 5) {
					$jumps++;
				}
			}
		}
		if($jumps < $max) {
			$sys = $systems[$i];
			$max = $jumps;
		}
	}
}

print_r($sys);
echo "\n\n" . $max;

//Draw dots
$systems = json_decode(exec("php systems.php"));
for($i = 0; $i < count($systems); $i++) {
	$x = xo(mToLy($systems[$i]->x));
	$y = yo(mToLy($systems[$i]->z));
	$sec = round($systems[$i]->security * 10);
	imagefilledellipse($im, $x, $y, 2, 2, $security[$sec]);
}


// Save the image
//imagepng($im);
imagedestroy($im);

echo json_encode($systems);

//print_r($security);



function xo($x) {
	return ($x * 8) + 500;
}

function yo($y) {
	return (-$y * 8) + 450;
}

function mToLy($m) {
	return $m / 9460730472580800;
}

function lyToM($ly) {
	return $ly * 9460730472580800;
}
?>
