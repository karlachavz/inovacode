const mysql = require('mysql2');
const config = require('../config');
const { error } = require('../red/respuestas');

const dbconfig = {
    host: config.mysl.host,
    user: config.mysl.user,
    password: config.mysl.password,
    database: config.mysl.database,
}

let conexion;

function conMysql(){
    conexion = mysql.createConnection(dbconfig);
    conexion.connect((err) => {
        if(err){
            console.log('[db err]', err);
            setTimeout(conMysql, 200);
        }else{
            console.log('DB Conectada!!!')
        }
    });

    conexion.on('error', err => {
        console.log('[db err]', err);
        if(err.code === 'PROTOCOL_CONNECTION_LOST'){
            conMysql();
        }else{
            throw err;
        }
    })
}
conMysql();

// SQL CLASES

function todos(tabla) {
    return new Promise ( (resolve, reject) => {
        conexion.query(`SELECT * FROM ${tabla}`,(error,result) => {
            if(error) return reject(error);
            resolve(result);
        })
    });

}


function uno (tabla,id){

}


function agregar(tabla,data){

}

function eliminar(tabla,data){

}

module.exports ={
    todos,
    uno,
    agregar,
    eliminar,
}
