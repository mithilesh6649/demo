 const http = require('http');
 const mongo = require('mongodb').MongoClient;
 const server = http.createServer((request,response)=>{
       url = "mongodb://127.0.0.1:27017";
       mongo.connect(url,(error,connection)=>{
          if(error)
             throw error;

          const db = connection.db('wap');
          const query = {
            id:2
          };
          const updateData = {
             $set : {
               product_name:"desktop",
               price:1599
             }
          };
          // db.collection('products').find().sort({
          //   purchased_at:-1
          // }).toArray((error,allData)=>{
          //   console.log(allData);
          // });

          db.collection('products').updateOne(query,updateData,(error,checkUpdate)=>{
            if(error)
              throw error;
            console.log('Update Succcss');
          });

       });
 });

 server.listen(8080);