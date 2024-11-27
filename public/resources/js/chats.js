const plus = document.querySelector('.m');
const trans = document.querySelector('.trans');
const mes = document.querySelector('.direct');
const nameofstatus = document.querySelector('.nameofstatus');
const TransactionsButtons = document.querySelectorAll('.TransactionsButton');

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
    let ChatIds = document.querySelectorAll('.ChatId');
    ChatIds.forEach(chat => {
        chat.value = "";
    });
}

function LoadPusher(channel, token){
    //Receive messages
    channel.bind('chat', function (data) {
        let message = data.message.split('~');
        if(message[1] != UserId){
            $.post("/chats/1/receive", {
                _token:  token,
                chat: $("#SendForm #ChatId").val(),
                message: message[0]
            })
            .done(function (res) {
                AppendMessages(res);
            });
        }
    });
}

function LoadMessages(ChatId, FromId){
    $("#SendForm").css('display', 'flex');
    let ChatIds = document.querySelectorAll('.ChatId');
    ChatIds.forEach(chat => {
        chat.value = ChatId;
    });
    if(UserId == FromId){
        $("#accept").remove();
    }

    $.ajax({
        url:     "/chats/"+ChatId,
        method:  'GET'
    }).done(function (res) {
        $(".messagesz").html('');
        AppendMessages(res);
    });

    pusher  = new Pusher(key, {cluster: cluster});
    channel = pusher.subscribe(ChatId+'chat');
    LoadPusher(channel, token);
}

function LoadTransactions(){
    $("#PeopleChats").html('');
    trans.style.color = 'white';
    mes.style.color = 'dimgray';
    ToggleButtons();
    ReloadChat();
    
    nameofstatus.innerHTML = 'Transactions';

    $.ajax({
        url:     "/chats/transaction",
        method:  'GET'
    }).done(function (res) {
        AppendMessages(res, "#PeopleChats", '.ChatsPeople');
        AddChatFunction();
    });
}

function LoadDirectMessages(){
    $("#PeopleChats").html('');
    mes.style.color = 'white';
    trans.style.color = 'dimgray';
    ToggleButtons();
    ReloadChat();
    
    nameofstatus.innerHTML = 'Direct messages';

    $.ajax({
        url:     "/chats/directs",
        method:  'GET'
    }).done(function (res) {
        AppendMessages(res, "#PeopleChats", '.ChatsPeople');
        AddChatFunction();
    });
}

function AddChatFunction(){
    let ChatsPeople = document.querySelectorAll('.ChatsPeople');
    ChatsPeople.forEach(people => {
        people.addEventListener('click', async () => {
            let ChatId = people.getAttribute('ChatId');
            let FromId = people.getAttribute('FromId');
            LoadMessages(ChatId, FromId);
        });
    });
    
}

trans.addEventListener('click', LoadTransactions);

mes.addEventListener('click', LoadDirectMessages);

Pusher.logToConsole = true;

//Broadcast messages
$("#SendForm").submit(function (event) {
    event.preventDefault();
    $.ajax({
        url:     "/chats/1/broadcast",
        method:  'POST',
        data:    {
            _token:  token,
            chat: $("#SendForm #ChatId").val(),
            message: $("#SendForm #message").val()+"~"+UserId
        }
    }).done(function (res) {
        AppendMessages(res);
        $("#SendForm #message").val('');
    });
});