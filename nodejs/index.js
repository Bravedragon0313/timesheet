"use strict";

const express = require("express");
const http = require("http");
const socketio = require("socket.io");
const socketEvents = require("./utils/socket");
var cors = require("cors");
var whitelist = ['http://localhost']
var corsOptions = {
  origin: function (origin, callback) {
    if (whitelist.indexOf(origin) !== -1) {
      callback(null, true)
    } else {
      callback(new Error('Not allowed by CORS'))
    }
  }
}
class Server {
    constructor() {
        // process.env.HOST = `172.16.1.65`;
        this.port = process.env.PORT || 3000;
        this.host = process.env.HOST || `172.16.1.65`;
        this.app = express();
        this.app.use(cors());
 	      this.app.use(express.static(__dirname + "/uploads"));
        this.http = http.Server(this.app);
        this.socket = socketio(this.http);
    }

    appRun() {
        new socketEvents(this.socket).socketConfig();
        this.app.use(express.static(__dirname + "/uploads"));

        this.app.use((req, res, next) => {
          res.header('Access-Control-Allow-Origin', '*');
          next();
        });
        this.http.listen(this.port, this.host, () => {
            console.log(`Listening on http://${this.host}:${this.port}`);
        });
    }
}

const app = new Server();
app.appRun();
