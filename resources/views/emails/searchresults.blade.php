Your search results are ready:

<ul>
@foreach ($results as $keyword => $results)
	<li>
		<strong> {{ $keyword}} </strong>
		<ul>
			@foreach ($results as $result)
			<li>
				Name: {{ $result['name'] }} <br>
				Location: {{ $result['location'] }}
			</li>
			@endforeach
		</ul>
	</li>
@endforeach
</ul>

