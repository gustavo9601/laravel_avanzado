require('./bootstrap');

Echo.channel('messages-channel')
    .listen('MessageWasReceived', (data) => {
        console.log("data", data);
    });
