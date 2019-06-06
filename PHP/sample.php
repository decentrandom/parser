<?

// Parser Library
include "./lib_decentrand.php";

$_rand_hash = $_GET["rand_hash"];
$_range_min = $_GET["range_min"];
$_range_max = $_GET["range_max"];

?><!DOCTYPE html>
<html>

<head>
<title>DecentRandom Parser Sample</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form method="get" action="./sample.php">
    <div>검증인이 제시한 해시 : <input type="text" name="rand_hash" size="64" value="<?=$_rand_hash;?>"></div>
    <div>난수 범위(최소) : <input type="text" name="range_min" size="5" value="<?=$_range_min;?>"></div>
    <div>난수 범위(최대) : <input type="text" name="range_max" size="5" value="<?=$_range_max;?>"></div>
    <div><button type="submit">난수 구하기</button></div>
</form>
<?

if (trim($_rand_hash) != "" && $_range_min >= 0 && $_range_max > $_range_min) {

    $result = get_simple_rand($_rand_hash, $_range_min, $_range_max);
    echo "<div>선택된 난수 : <b>".$result."</b></div>";
}

?>
</body>

</html>