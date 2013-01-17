<?php

//create socket to connect to drink
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

//check for failure
if(socket_connect($socket, "drink.csh.rit.edu", 4242) == false)
{
    echo "failed at connect";
}

//read in welcome message
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

//write and send user command
$commmand = "USER drinklotto\n";

socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";

//read message
while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}



socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";

//read message
while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}

//get drink status to determine available slots
$commmand = "STAT\n";

socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";
$arr;

//read in status
while(socket_recv($socket, $buf, 1, 0))
{
    //done reading
    if (strpos($msg ,"OK"))
    {
	break;
    }

    //grab index and droppable status
    if($buf == "\n")
    {
	$index = substr($msg, 1, 1);
	$status = substr($msg, -3, 1);

	$arr[$index] = $status ;
	$msg = "";
    }

    $msg .= $buf;
 
}

//first element of the arr has a blank index due to parsing. This is an easy way to compensate
$arr[1] = $arr[" "];


$buf = "";
$msg = "";

//get number of slots available and finish reading
while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}


$num = $msg[0];
//print_r($msg);
$randomSlot = 0;

//generate random number within range of open slots that have a status of 1
do
{
    $randomSlot = rand(1,intval($num));
}
while ($arr[$randomSlot] == 0);

//write drop command
$commmand = "DROP " . $randomSlot . "\n";

//drop dat drink
socket_send($socket, $commmand , 1024, 0);

$buf = "";
$msg = "";

//get messge
while(socket_recv($socket, $buf, 1, 0))
{
    if($buf == "\n")
    {
        break;
    }
    $msg .= $buf;
}

if(substr($msg, 0, 2) != "OK")
{
	print_r("ERROR: Problem with drop command");
}

//print_r($commmand );

//close socket
socket_close($socket);

?>
