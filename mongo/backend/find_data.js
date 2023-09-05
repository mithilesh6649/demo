const http = require('http');
const mongo = require('mongodb').MongoClient;
const server = http.createServer((request,response)=>{
     var url = 'mongodb://127.0.0.1:27017';
     
     mongo.connect(url,(error,connection)=>{
        if(error)
            throw error;
       
        const db = connection.db('wap');

        query = {
            id:{
                  $gt:90,
                  $lt:100
            },
            title:{
                $regex : /con/
            },
            body:{
                  $regex : '/^vol/'
            }  
        }

        const selectedData = {
            projection:{
                  _id:0
            }
        }
       
        db.collection('posts').find(query,selectedData).toArray((error,responseData)=>{
             if(error)
                  throw error;
            if(responseData.length){
                  console.log(responseData);
            }else{
                  console.log('Data Not Found');
            }

             
        });

     });

});

server.listen(8080);