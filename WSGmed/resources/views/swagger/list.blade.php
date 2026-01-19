<h1>Historia dokumentacji API</h1>

<ul>
@foreach($files as $file)
    <li>
        <a href="{{ url('storage/api-docs/'.$file) }}">
            {{ $file }}
        </a>
    </li>
@endforeach
</ul>