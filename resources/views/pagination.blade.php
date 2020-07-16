@include('layouts.app')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
 	@foreach($users as $user)
		<tbody>
	    <tr>
	      <th scope="row">{{ $user->name }}</th>
	       <th scope="row">{{ $user->email }}</th>
	    </tr>
	  </tbody>
 	@endforeach
  

</table>  