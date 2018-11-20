window.onload = main;

//accepts a country and requests data
function ajax_request(request){
    var xhr = new XMLHttpRequest();
    var url = "/world.php?"+request;
    
	xhr.open("GET", url, true);
   
    xhr.onload=function(){
        
        if(this.status == 200){
            document.getElementById('result').innerHTML = this.responseText;
         }else if(this.status=404){
             document.getElementById('result').innerHTML = " Error Not Found";
            }
        
    }
    
    
    xhr.send();
}

function main(){
    $("#country").after("<label for='all'>Select all countries</label><input type='checkbox' name='all' id='all'/>");
    var lookup = document.getElementById("lookup");
    
    lookup.onclick = function(){
        if($("#all")[0].checked){
            ajax_request("all=true");
        }else{
            ajax_request("country="+document.getElementById("country").value.trim());
        }
        
    }
}