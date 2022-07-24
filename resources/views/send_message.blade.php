<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Chat Message Module</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8" >
                            <div id="messages" style="border: 1px solid #121212; margin-bottom: 5px; height: 250px; padding: 2px; overflow: scroll;"></div>
                        </div>
                        <div class="col-lg-8" >
                            <form action="sendmessage" method="POST">
                                @csrf
                                <input type="hidden" name="user" value="basel" >
                                <textarea class="form-control message"></textarea>
                                <br/>
                                <input type="button" value="Send" class="btn btn-success" id="send-message">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>
<script>
    var socket = io.connect('http://localhost:8890');
    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
    });
    $("#send-message").click(function(e){
        e.preventDefault();
        var _token = $("input[name='_token']").val();
        var user = $("input[name='user']").val();
        var message = $(".message").val();
        if(message != ''){
            $.ajax({
                type: "POST",
                url: '{!! URL::to("sendmessage") !!}',
                dataType: "json",
                data: {'_token':_token, 'message':message, 'user':user},
                success:function(data) {
                    $(".message").val('');
                }
            });
        }
    })
</script>
</body>
</html>
