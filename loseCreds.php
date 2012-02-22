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

//print_r($msg);

//transfer credits to drinklotto account
$commmand = "SENDCREDITS 2 drinklotto\n";

socket_send($socket, $commmand , 1024, 0);

socket_close($socket);

?>