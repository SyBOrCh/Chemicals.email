Your search results from the {{ ucfirst($mail->group) }} database:

<ul>
@foreach ($results as $keyword => $results)
	<li>
		"<strong> {{ $keyword}} </strong>":
		<ul>
			@foreach ($results as $result)
			<li>
                Name: <a href="http://database.syborchserver.nl/chemical/{{ $result['id'] }}">{{ $result['name'] }}</a> <br>
                Quantity: {{ $result['quantity'] }} <br>
				Location: {{ $result['location'] }} . {{ $result['cabinet'] }} . {{ $result['number'] }} <br>
                MW: {{ $result['molweight'] }} <br>
                density: {{ $result['density'] }}
			</li>
			@endforeach
		</ul>
	</li>
@endforeach
</ul>

