const http = require('http');
const mongo = require('mongodb').MongoClient;
const server = http.createServer((request,response)=>{
    url = "mongodb://127.0.0.1:27017";
    mongo.connect(url,(error,connection)=>{
    	if(error)
    		throw error;
    	const db = connection.db('wapinstitute');
    	const data = [
    	{
    		name:"Mithilesh",
    		roll:10
    	},
    	{
    		name:"Raj",
    		roll:11
    	},
    	{
    		name:"Mohan",
    		roll:12
    	},
    	{
    		name:"Rahul",
    		roll:13
    	},
    	]
    	db.collection('result').insertMany(data,(error,resData)=>{
              console.log(resData);
    	});
    }); 

});

server.listen(8080);


//insertOne()
//insertMany()
//insert