var previous_number_online = '';
function load_online_user(){
    $.ajax({
        url : "usermysql.php",
        type : "post",
        dataType:"text",
        data : {
        },
        success : function (result){
        	if(result != previous_number_online)
	            $('#online_users').html(result);
	        previous_number_online = result;
        }
    });
}
load_online_user();
setInterval(function() {load_online_user();}, 5000);