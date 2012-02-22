var counter = 0;
var MAX_COUNTER = 50;
var q = [];
var slots = new Array();
slots[0] = 0;
slots[1] = 0;
slots[2] = 0;
	

function reset(){

    if(counter <= 0){
        document.getElementById("win").style.visibility = 'hidden';
        document.getElementById("button").src =
            document.getElementById("lever2").src;
               
        counter = MAX_COUNTER;

        var win;

        jQuery.get('loseCreds.php');
	 var creds = document.getElementById("credits").innerHTML;
        creds = creds.substring(8);

	 var numCreds = parseInt(creds) - 2;

	 document.getElementById("credits").innerHTML = "Credits: " + numCreds;
	

        jQuery.get('rando.php', function ( data ) {
           win = data;
	    result(win)
        });
    }
}

function result(win){
    if(q.length == 0){
        for(var i = 0; i < counter; i++){
            var interval = function(){
                setTimeout(function(){
                    for(var j = 0; j < 3; j++){
                        if(counter < MAX_COUNTER - (MAX_COUNTER / 3) 
                            && j == 0 || j == 1
                            && counter < MAX_COUNTER / 3){
                                continue;
                        }
                        else if(win > -1){
                            if(counter == Math.floor(MAX_COUNTER - 
                                (MAX_COUNTER / 3) + 1) && j == 0){
                                swapImage(j.toString(), win);
                            }
                            else if(counter == Math.floor((MAX_COUNTER / 3) + 1)
                                && j == 1){
                                swapImage(j.toString(), win);
                            }
                            else if(counter == 1
                                && j == 2){
                                swapImage(j.toString(), win);
                            }
				            else{
                            	var randID  = Math.floor(Math.random() * 6).toString();
                            	swapImage(j.toString(), randID);
                            }
                        }
			            else{
                             var randID  = Math.floor(Math.random() * 6).toString();
                             swapImage(j.toString(), randID);
                            }
                        
                    }

			if(counter == 1){
				document.getElementById("button").src = 
								document.getElementById("lever1").src;
			       if(win > -1){
					document.getElementById("win").innerHTML = "WINNER!!!";
					document.getElementById("win").style.visibility = 'visible';
                    			jQuery.get('drop.php');
				}
				else{
                            	checkDuplicates();
					document.getElementById("win").innerHTML = "FAILURE";
					document.getElementById("win").style.visibility = 'visible'; 
				}
			}
                processQueue();                    
                counter--;
                }, 75);
            };
            q.push(interval);
        }
        processQueue();
    }
    else{
        processQueue();
    }

}


function processQueue(){
 	if(q.length > 0){
		var temp = q.pop();
		temp();
	}

}

function checkDuplicates(){
	if(slots[0] == slots[1] &&
	    slots[1] == slots[2]){
	    var randID  = slots[2];
           do{
		    randID  = Math.floor(Math.random() * 6).toString();
	    } while(randID == slots[2]);
	    swapImage(2, randID);
	}
}

function swapImage(id, newId){
	 slots[id] = newId;
        switch(id){
            case "0":
                document.getElementById("slot1").src =
                   document.getElementById(newId).src;
                break;
            case "1":
                document.getElementById("slot2").src =
                    document.getElementById(newId).src;
                break;
            case "2":
                document.getElementById("slot3").src =
                    document.getElementById(newId).src;
                break;
        }
}

function pullLever(){
     document.getElementById("button").src =
         document.getElementById("lever1").src;
}

