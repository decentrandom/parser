<?

function get_simple_rand($hash, $min, $max) {

    $hash = trim($hash);
    $hash = preg_replace("/\W|_/", "", $hash);
    $hash = strtoupper($hash);
    
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

?>