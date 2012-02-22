<!-- Duncan Keller -->
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"> -->
<LINK href="style.css" rel="stylesheet" type="text/css">

<html>

	<body>
	

<?php



require("webauth_vars.php");
$info = getInfo(); 

$ibutton = $info[0]['ibutton'][0];

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if(socket_connect($socket, "drink.csh.rit.edu", 4242) == false)
{
    echo "failed at connect";
}

$buf = "";
$msg = "";

while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}

//print_r($msg);

$commmand = "IBUTTON " . $ibutton . "\n";

socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";

while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}

print_r($msg);

$commmand = "STAT\n";

socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";
$arr;

while(socket_recv($socket, $buf, 1, 0))
{
    if (strpos($msg ,"OK"))
    {
	break;
    }

    if($buf == "\n")
    {
	print_r($msg);
	print_r("___");
	$index = substr($msg, 1, 1);
	$status = substr($msg, -3, 1);

	$arr[$index] = $status ;
	$msg = "";
    }

    $msg .= $buf;
 
}

//print_r($arr );
$arr[1] = $arr[" "];


$buf = "";
$msg = "";

while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}


$num = $msg[0];
$randomSlot = 0;


do
{
    $randomSlot = rand(1,$num);
}
while ($arr[$randomSlot] == 0);


$commmand = "DROP " . $randomSlot . " [0]" . "\n";

//socket_send($socket, $commmand , 1024, 0);

print_r($commmand );


socket_close($socket);

?>