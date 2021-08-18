const mysql = require( 'mysql' );

var config = {
    timezone: 'utc',
    host: process.env.DB_HOST,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE
};

class Database {
    constructor() {
        this.connection = mysql.createPool( config );
    }
    query( sql, args ) {
        return new Promise( ( resolve, reject ) => {
            this.connection.query( sql, args, ( err, rows, fields ) => {
                if ( err ) {
                    return reject(err);
                }

                resolve( rows, fields );
            } );
        } );
    }
    close() {
        return new Promise( ( resolve, reject ) => {
            this.connection.end( err => {
                if ( err )
                    return reject( err );
                resolve();
            } );
        } );
    }
}

module.exports = new Database();
