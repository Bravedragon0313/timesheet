"user strict";

const DB = require("./db");
const path = require("path");
const fs = require("fs");

class Helper {
    constructor(app) {
        this.db = DB;
    }

    async addSocketId(userId, userSocketId) {
        try {
            return await this.db.query(
                `UPDATE users SET socket_id = ?, online= ? WHERE id = ?`,
                [userSocketId, "Y", userId]
            );
        } catch (error) {
            console.log(error);
            return null;
        }
    }

    async logoutUser(userSocketId) {
        return await this.db.query(
            `UPDATE users SET socket_id = ?, online= ? WHERE socket_id = ?`,
            ["", "N", userSocketId]
        );
    }

    getChatList(userId) {
        try {
            return Promise.all([
                this.db.query(
                    `SELECT users.id, fullname, filename, socket_id, online , users.updated_at , Count
                    FROM users 
                    LEFT JOIN (SELECT users.id,messages.to_user_id, if(sum(messages.status),sum(messages.status),0) AS Count 
                                FROM users
                                left JOIN messages ON users.id = messages.from_user_id
                                WHERE messages.to_user_id = ?
                                GROUP BY users.id ) AS T ON users.id = T.id
                    WHERE users.id != ?`,
                    [userId, userId]
                )
            ])
                .then(response => {
                    return {
                        chatlist: response[0]
                    };
                })
                .catch(error => {
                    console.warn(error);
                    return null;
                });
        } catch (error) {
            console.warn(error);
            return null;
        }
    }

    async insertMessages(params) {
        try {
            return await this.db.query(
                "INSERT INTO messages (`type`, `file_format`, `file_path`, `from_user_id`,`to_user_id`,`message`, `date`, `time`, `ip`) values (?,?,?,?,?,?,?,?,?)",
                [
                    params.type,
                    params.fileFormat,
                    params.filePath,
                    params.fromUserId,
                    params.toUserId,
                    params.message,
                    params.date,
                    params.time,
                    params.ip
                ]
            );
        } catch (error) {
            console.warn(error);
            return null;
        }
    }

    async getMessages(userId, toUserId) {
        try {
            return await this.db.query(
                `SELECT messages.id,
                from_user_id as fromUserId,
                to_user_id as toUserId,
                message,
                time,
                date,type,file_format as fileFormat,file_path as filePath , filename 
                FROM messages JOIN users ON users.id = messages.from_user_id WHERE
					(from_user_id = ? AND to_user_id = ? )
					OR
					(from_user_id = ? AND to_user_id = ? )	ORDER BY id ASC
				`,
                [userId, toUserId, toUserId, userId]
            );
        } catch (error) {
            console.warn(error);
            return null;
        }
    }
    async updateMessage(userId, toUserId) {
        try {
            return await this.db.query(
                `UPDATE timetrack_new.messages SET status=0  WHERE  status= 1 AND from_user_id = ? AND to_user_id = ?`,
                [userId, toUserId]
            );
        } catch (error) {
            console.warn(error);
            return null;
        }
    }
    async mkdirSyncRecursive(directory) {
        var dir = directory.replace(/\/$/, "").split("/");
        for (var i = 1; i <= dir.length; i++) {
            var segment =
                path.basename("uploads") + "/" + dir.slice(0, i).join("/");
            !fs.existsSync(segment) ? fs.mkdirSync(segment) : null;
        }
    }
}
module.exports = new Helper();
