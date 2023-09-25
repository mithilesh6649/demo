<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

 <table>
 	@foreach($branchcity as $data)
 	 <tr>
         <td> {{$data->id}}</td>
         <td>{{$data->branch_id}}</td>
         <td>{{$data->created_at}}</td>
 	 </tr>
 	@endforeach
 </table>

</body>
</html>