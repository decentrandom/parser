<?

function get_simple_rand($seed, $min, $max, $nonce) {

    $nonce = trim($nonce);
    $nonce = preg_replace("/\W|_/", "", $nonce);
    
    $seed = trim($seed);
    $seed = preg_replace("/\W|_/", "", $seed);
    
    $hash = strtoupper(hash("sha256", $seed.$nonce));

    $length = strlen($hash);

    if ($length == 0) {
        return false;
    }

    $range = $max - $min;

    if ($range < 0 || $range > $length * 36) { // 현재 버전에서는 추출 범위 제한이 있습니다.
        return false;
    } elseif ($range == 0) {
        return $min;
    }

    $array_alphabet = range ('A', 'Z');

    $sum = 0;

    for ($i = 0; $i < $length; $i++) {
        $character = substr($hash, $i, 1);

        if (ctype_alpha($character)) {
            $sum += array_search($character, $array_alphabet) + 10;
        } else {
            $sum += (int)$character;
        }
    }

    return ($sum % $range) + $min;
}


function make_simple_pick($seed, $target, $nonce) {
	
	$nonce = trim($nonce);
    $nonce = preg_replace("/\W|_/", "", $nonce);
    
	$seed = trim(hash("sha256", $seed));
    $seed = preg_replace("/\W|_/", "", $seed);
    
    $target = trim($target);
    $array_target = explode(",", $target);
    
    $number_of_tartets = count($array_target);
    
    $array_hash = array();
    $array_alphabet = range ('A', 'Z');
    
    for ($i = 0; $i < $number_of_tartets; $i++) {
	    
	    $hash = strtoupper(hash("sha256", $seed.$array_target[$i].$nonce));
	    $length = strlen($hash);
	    $sum = 0;
	    
	    for ($j = 0; $j < $length; $j++) {
		    
		    $character = substr($hash, $j, 1);
		    
		    if (ctype_alpha($character)) {
           		$sum += array_search($character, $array_alphabet) + 10;
			} else {
           		$sum += (int)$character;
		   	}
	    }
	    
	    $array_hash[$i] = $sum;
    }
    
    array_multisort($array_hash, SORT_DESC, $array_target);
    
    return $array_target;
    
}

?>