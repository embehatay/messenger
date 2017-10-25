<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script language="javascript">
            $(document).ready(function() {
               $('#number').keypress(function(event) {
                   if(event.which == 13) {
                    load_ajax();
                   } 
                }); 
            });
            function load_ajax(){
                alert("hihi");
                $.ajax({
                    url : "test.php",
                    type : "post",
                    dataType:"text",
                    data : {
                         number : $('#number').val()
                    },
                    success : function (result){
                        $('#result').html(result);
                    }
                });
            }            
        </script>
    </head>
    <body>
        <div id="result">
            Nội dung ajax sẽ được load ở đây
        </div>
        <br/>
        <input type="text" value="" id="number"/>
        <input type="button" name="clickme" id="clickme" value="Click Me"/>
    </body>
</html>