<!doctype html>
<html>
<head>
<style>

</style>
</head>
<body>
<form method="post" action="/findSearch">				
<input type="text" name= "search">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<button>Search Now</button>				
</form>
<?php
if(isset($search)){
	
	?>
	 <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($search as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
	<?php
}
?>
</body>
</html>