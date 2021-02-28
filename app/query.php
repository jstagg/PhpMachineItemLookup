<html>
<head>
<title>ItemID To SKU Lookup Result</title>
</head>
<body>

<?php

$idErr = $mfidErr = "";
$id = $mfid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["id"]))
    {
        $idErr = "Gotta have an itemid!";
        $id = "0";
    }else {
        $id = test_input($_POST["id"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('myDB.db');
    }
}

$db = new MyDB();

if (!$db)
{
    echo $db->lastErrorMsg();
}

$statement = $db->prepare('SELECT * from tbl where id = :id;');
$statement->bindValue(':id', $id);

$data = array();

$ret = $statement->execute();

while ($res = $ret->fetchArray(1))
{
    array_push($data, $res);
}

$db->close();

if (count($data) < 1)
{
    echo "<h2><font color=gray>ItemID </font>";
    echo "<font color=red>" . $id . "</font>";
    echo "<font color=gray> Not Found</font></h2>";
}

foreach ($data as $row)
{
    echo "<h2>";
    echo "<font color=gray>ItemID </font>";
    echo "<font color=purple>" . $row['id'] . "</font>";
    echo "<font color=gray> is really </font>";
    echo "<font color=purple>" . $row['mydata'] . "</font>";
    echo "</h2>";
}

echo "<p><a href=\"index.php\">Search again</a></p>";

?>

</body>
</html>
