const plus = document.querySelector('.m');
const trans = document.querySelector('.trans');
const mes = document.querySelector('.direct');
const nameofstatus = document.querySelector('.nameofstatus');
const TransactionsButtons = document.querySelectorAll('.TransactionsButton');
const ChatsPeople = document.querySelectorAll('.ChatsPeople');

function ToggleButtons(){
    TransactionsButtons.forEach(button => {
        if(button.style.display === 'none'){
            button.style.display = 'block';
        }else{
            button.style.display = 'none';
        }
    });
}

function AppendMessages(res, div = ".messagesz", element = ".message"){
    if ($(div+" > "+element).length) {
        $(div+" > "+element).last().after(res);
    } else {
        $(div).append(res);
    }
    $(document).scrollTop($(document).height());
}

function ReloadChat(){
    $(".messagesz").html('');
    $("#SendForm").css('display', 'none');
    $("#SendForm #ChatId").val('');
}

function LoadMessages(ChatId){
    $("#SendForm").css('display', 'flex');
    $("#SendForm #ChatId").val(ChatId);

    $.ajax({
        url:     "/chats/"+ChatId,
        method:  'GET'
    }).done(function (res) {
        $(".messagesz").html('');
        AppendMessages(res);
    });
}

function LoadTransactions(){
    trans.style.color = 'white';
    mes.style.color = 'dimgray';
    ToggleButtons();
    ReloadChat();
    
    nameofstatus.innerHTML = 'Transactions';

    $.ajax({
        url:     "/chats/transaction",
        method:  'GET'
    }).done(function (res) {
        $("#PeopleChats").html('');
        AppendMessages(res, "#PeopleChats", '.ChatsPeople');
    });
}

function LoadDirectMessages(){
    mes.style.color = 'white';
    trans.style.color = 'dimgray';
    ToggleButtons();
    ReloadChat();
    
    nameofstatus.innerHTML = 'Direct messages';

    $.ajax({
        url:     "/chats/directs",
        method:  'GET'
    }).done(function (res) {
        $("#PeopleChats").html('');
        AppendMessages(res, "#PeopleChats", '.ChatsPeople');
    });
}

trans.addEventListener('click', LoadTransactions);

mes.addEventListener('click', LoadDirectMessages);

ChatsPeople.forEach(people => {
    people.addEventListener('click', async () => {
        let ChatId = people.getAttribute('ChatId');
        LoadMessages(ChatId);
    });
});

Pusher.logToConsole = true;
//Receive messages
channel.bind('chat', function (data) {
    if(pusher.connection.socket_id != data.socket_id){
      $.post("/chats/1/receive", {
      _token:  token,
      chat: $("#SendForm #ChatId").val(),
      message: data.message
      })
      .done(function (res) {
        AppendMessages(res);
      });
    }
});

//Broadcast messages
$("#SendForm").submit(function (event) {
    event.preventDefault();
    $.ajax({
        url:     "/chats/1/broadcast",
        method:  'POST',
        headers: {
            'X-Socket-Id': pusher.connection.socket_id
        },
        data:    {
            _token:  token,
            chat: $("#SendForm #ChatId").val(),
            socket_id: pusher.connection.socket_id,
            message: $("#SendForm #message").val(),
        }
    }).done(function (res) {
        AppendMessages(res);
        $("#SendForm #message").val('');
    });
});