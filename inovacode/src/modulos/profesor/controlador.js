const db = require('../../DB/mysql');

const TABLA ='clases'

function todos() {
    return db.todos(TABLA);
}

module.exports ={
    todos,
}