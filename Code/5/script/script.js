(function () {
    localStorage.setItem('user', uuidv4())
})();

/* Time */

let deviceTime = document.querySelector('.status-bar .time');
let messageTime = document.querySelectorAll('.message .time');

deviceTime.innerHTML = moment().format('h:mm');

setInterval(function () {
    deviceTime.innerHTML = moment().format('h:mm');
}, 1000);

for (let i = 0; i < messageTime.length; i++) {
    messageTime[i].innerHTML = moment().format('h:mm A');
}

/* Message */

let form = document.querySelector('.conversation-compose');
let conversation = document.querySelector('.conversation-container');

form.addEventListener('submit', newMessage);

function newMessage(e) {
    let input = e.target.input;
    if (input.value) {
        let clientMessage = buildClientMessage(input.value);
        conversation.appendChild(clientMessage);
        animateClientMessage(clientMessage, input.value);
    }
    input.value = '';
    conversation.scrollTop = conversation.scrollHeight;
    e.preventDefault();
}

function buildClientMessage(text) {
    let element = document.createElement('div');
    element.classList.add('message', 'sent');
    element.innerHTML = text +
        '<span class="metadata">' +
        '<span class="time">' + moment().format('h:mm A') + '</span>' +
        '<span class="tick tick-animation">' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg>' +
        '</span>' +
        '</span>';
    return element;
}

function buildServerMessage(text) {
    let element = document.createElement('div');
    element.classList.add('message', 'received');
    element.innerHTML = text +
        '<span class="metadata">' +
        '<span class="time">' + moment().format('h:mm A') + '</span>' +
        '</span>';
    return element;
}

function animateClientMessage(message, text) {
    fetch('./api/index.php?user=' + localStorage.getItem('user') + '&data=' + text)
        .then(response => {
            return response.json();
        })
        .then(res => {
            if (res?.data) {
                let tick = message.querySelector('.tick');
                tick.classList.remove('tick-animation');
                let serverMessage = buildServerMessage(res?.data);
                conversation.appendChild(serverMessage);
                conversation.scrollTop = conversation.scrollHeight;
            }
        })
}

function uuidv4() {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}