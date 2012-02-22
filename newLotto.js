var counter = 0;
var MAX_COUNTER = 70;
var q = [];

function reset(){

	alert("fuck");

    document.getElementById("win").style.visibility = 'hidden';
    document.getElementById("button").src =
        document.getElementById("lever2").src;
               
    counter = MAX_COUNTER;

    int win = -1;

    jQuery.get('rando.php', function ( data ) {
        win = data;
    });

}

function result(){
    if(q.length == 0){
        for(int i = 0; i < counter; i++){
            var interval = function(){
                setTimeout(function(){
                    for(var j = 0; j < 3; j++){
                        if(counter < MAX_COUNTER - (MAX_COUNTER / 3) 
                            && j == 0 || j == 1
                            && counter < MAX_COUNTER / 3){
                                continue;
                        }
                        else if(win > -1){
                            if(counter == MAX_COUNTER - 
                                (MAX_COUNTER / 3) - 1 && j == 0){
                                swapImage(j.toString(), win);
                            }
                            else if(counter == (MAX_COUNTER / 3) - 1
                                && j == 1){
                                swapImage(j.toString(), win);
                            }
                            else if(counter == MAX_COUNTER - 1
                                && j == 2){
                                swapImage(j.toString(), win);
                            }
                        }
                        else{
                            var randID  = Math.floor(Math.random() * 6).toString();
                            swapImage(j.toString(), randID);
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
    if(q.length > 0{
            var temp = q.pop();
            temp();
    }
}

function swapImage(id, newId){
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

