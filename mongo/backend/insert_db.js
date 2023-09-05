 
 const http = require('http');
 const mongo = require('mongodb').MongoClient;
 const server = http.createServer((request,response)=>{
     var url = 'mongodb://127.0.0.1:27017';
     mongo.connect(url,(error,connection)=>{ 
     	if(error)
     		throw error;
       
        const db = connection.db('wapinstitute');
        const data = {
        	name:"rahulas",
        	email:"raahula@gmail.com"
        }; 
        db.collection('result').find(data).toArray((error,result)=>{
        	 if(error)
        	 	 throw error;

        	 	if(result.length==0){
        	 		 db.collection('result').insertOne(data,function(error,dataDetails){
        	 		 	 response.writeHead(200,{
        	 		 	 	'Content-Type':'application/json',
        	 		 	 });

        	 		 	 const successMessage = JSON.stringify({
        	 		 	 	message:"Hurray ! ,Data Inserted Successfully !",
        	 		 	 });
        	 		 	 response.write(successMessage);
        	 		 	 response.end();
        	 		 });
        	 	}else{
        	 		  
        	 		  response.writeHead(409,{
        	 		  	'Content-Type':'application/json',
        	 		  });

        	 		  const failedMessage = JSON.stringify({
        	 		  	message:"Duplicate Entry !",
        	 		  }); 

        	 		  response.write(failedMessage);

        	 		  response.end();

        	 	}

        	 	//console.log(result);
        }); 
        // db.collection('result').insertOne({
        // 	name:'rahula',
        // 	email:'rahula@gmail.com'
        // },(error,recordHis)=>{
        //      if(error)
        //      	 throw error;
        //      	response.writeHead(202,{
        //      		'Content-Type':'application/json',
        //      	});



        //      	const successMessage = JSON.stringify({
        //      		message:recordHis,
        //      	});

        //      	response.write(successMessage);

        //      	request.end();
        // });
     });
 });


 server.listen(8080);