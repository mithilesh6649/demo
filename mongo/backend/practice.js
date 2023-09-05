const http  = require('http');
const mongo = require('mongodb').MongoClient;
const server = http.createServer((request,response)=>{
     const url  = 'mongodb://localhost:27017';
     mongo.connect(url,(error,connection)=>{
       
       const query = {
         id:72
       };

       const  fieldControl = {
         projection:{
          id:0,
          _id:0,
           userId:0,
           title:0
         }
       } 

       const db = connection.db('wap');
       
        db.collection('posts').find(null,fieldControl).limit(2).toArray((error,result)=>{
           console.log(result,result.length);
           response.end();
        });
       // db.collection('result').insertOne(data,(error,dataRes)=>{
           
       // });



     });
});

server.listen(8080);