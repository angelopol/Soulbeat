const plus = document.querySelector('.m');
const trans = document.querySelector('.trans');
const mes = document.querySelector('.direct');
const nameofstatus = document.querySelector('.nameofstatus');

trans.addEventListener('click', () => {
    trans.style.color = 'white';
    mes.style.color = 'dimgray';
    
    nameofstatus.innerHTML = 'Transactions';
});

mes.addEventListener('click', () => {
    mes.style.color = 'white';
    trans.style.color = 'dimgray';
    
    nameofstatus.innerHTML = 'Direct messages';
});

Pusher.logToConsole = true;
//Receive messages
channel.bind('chat', function (data) {
    if(pusher.connection.socket_id != data.socket_id){
      $.post("/chats/1/receive", {
      _token:  token,
      message: data.message
      })
      .done(function (res) {
        $(".messages > .message").last().after(res);
        $(document).scrollTop($(document).height());
      });
    }
});

//Broadcast messages
$("form").submit(function (event) {
event.preventDefault();

$.ajax({
    url:     "/chats/1/broadcast",
    method:  'POST',
    headers: {
    'X-Socket-Id': pusher.connection.socket_id
    },
    data:    {
    _token:  token,
    socket_id: pusher.connection.socket_id,
    message: $("form #message").val(),
    }
}).done(function (res) {
    $(".messagesz > .message").last().after(res);
    $("form #message").val('');
    $(document).scrollTop($(document).height());
});
});