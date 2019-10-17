Your search results from the <strong>{{ ucfirst($mail->group) }}</strong> database:

<ul>
@foreach ($results as $keyword => $results)
	<li>
		"<strong>{{ $keyword }}</strong>":
		<ul>
			@foreach ($results as $result)
			<li>
                <a href="http://{{ $mail->group == 'syborch' ? 'database' : 'medchemdb' }}.syborchserver.nl/chemical/{{ $result['id'] }}">{{ $result['name'] }}</a> <br>
                Quantity: {{ $result['quantity'] }} <br>
				Location: {{ $result['location'] }}.{{ $result['cabinet'] }}.{{ $result['number'] }} <br>
                Properties: {{ $result['molweight'] }} g/mol | density: {{ $result['density'] }} g/mL
			</li>
			@endforeach
		</ul>
	</li>
@endforeach
</ul>

