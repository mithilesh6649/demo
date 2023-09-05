const http  = require('http');
const mongo = require('mongodb').MongoClient;
const server = http.createServer((req,response)=>{
    var  url  = 'mongodb://127.0.0.1:27017';
    mongo.connect(url,(error,conn)=>{
        if(error)
            throw error;
        const db = conn.db('waps');
        db.createCollection('admission',(error,collection)=>{
            if(error) {
                if(error.code == 48){
                    
                     //failed

                     response.writeHead(409,{
                        'Content-Type':'application/json',
                     });
                    
                     const failedMessages = JSON.stringify({
                        message:'Duplicate Collection',
                     }); 

                     response.write(failedMessages);

                }
                response.end();
            }else{
                 
                 //Success........
                  const data = {
                    name:"Mithilesh Kumar",
                    email:'mithilesh@gmail.com', 
                  };
                 db.collection("admission").insertOne(data,(error,dataRes)=>{
                      if(error)
                        throw error;

                       //success message

                       response.writeHead(202,{
                         'Content-Type':'application/json',
                       });

                       const successMessage = JSON.stringify({
                         'data':dataRes,
                       });

                       response.write(successMessage);

                       response.end();

                 });
                   
                 
            }

        });
      
    });
    //response.write('Hii');
   // console.log("Hello Baby");
    
});
server.listen(8081);