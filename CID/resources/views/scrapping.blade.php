@extends('main_structure')

@section('content')
<h1>Welcome to "La Spider!"</h1>
<ul>
	@foreach ($chapters as $chapter)
	<li>
	{{$chapter['value']}}
		<ul>
			@foreach ($chapter['groups'] as $group)
			<li>
			{{$group['value']}}
				<ul>
					@foreach ($group['categories'] as $category)
					<li>
					{{$category['value']}}

					</li>
					@endforeach
				</ul>
			</li>
			@endforeach
		</ul>
	</li>
	@endforeach
</ul>
<p>

@stop