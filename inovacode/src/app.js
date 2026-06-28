const express = require('express');
const config = require('./config');

const profesor = require('./modulos/profesor/rutas')

const app =express();


//configuracion 
app.set('port', config.app.port);



//rutas
app.use('/api/profesor',profesor)

module.exports = app;