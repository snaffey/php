var http = require('http');

const options = {
    hostname: '127.0.0.1',
    port: 41062,
    method: 'GET',
    path: '/www/testeProjV/pessoal/adicionarquotas',
    headers: {
        'Content-Type': 'application/json'
    }
}

setInterval(()=>{
    var req = http.request(options, res=>{
        console.log(`Status: ${res.statusCode}`);
        res.on('data', data => {
            process.stdout.write("Response => "+data);
        });
    });

    req.on('error', err =>{
        process.stdout.write("Error => "+err);
    });

    req.end();
}, 36000000);

console.log("Server is running");

