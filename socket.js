/*eslint no-console: */
const server = require('http').Server();

const io = require('socket.io')(server);

const Redis = require('ioredis');

const newComment = new Redis();
const notifications = new Redis();


newComment.subscribe('new-comment', () => console.log('subscribed to new-comment channel'));

newComment.on('message', (channel, comment) => {
  console.log('\x1b[36m%s\x1b[0m', `recived ${channel} 💬`);
  const commentJSON = JSON.parse(comment);
  console.log('\x1b[33m', `emitting data to channel ${channel}:${commentJSON.data.post_id}`);
  io.emit(`${channel}:${commentJSON.data.post_id}`, commentJSON.data);
});




notifications.subscribe('notification', () => console.log('subscribed to notification channel'));
notifications.on('message', (channel, payload) => {
  const payloadToEmit = JSON.parse(payload);
  console.log('\x1b[36m%s\x1b[0m', `recived ${channel} 🔔`);
  console.log('\x1b[33m', `emitting data to channel ${payloadToEmit.event}:${payloadToEmit.data.userId}`);
  io.emit(`${payloadToEmit.event}:${payloadToEmit.data.userId}`, payloadToEmit.data);
});

server.listen(3000, () => console.log('NodeJs started @ 3000 port 🚀'));
