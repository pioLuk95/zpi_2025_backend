{{-- resources/views/medications/_list.blade.php --}}
<ul class="list-group">
    @foreach($medications as $medication)
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
                <div class="fw-bold">Nazwa leku: {{ $medication->name }}</div>
                substancja czynna: {{ $medication->info }}
            </div>
{{--            <div class="btn-group btn-group-sm" role="group" aria-label="Akcje">
                <a href="{{ route('medications.edit', $medication) }}" class="btn btn-warning">Edytuj</a>
                <form action="{{ route('medications.destroy', $medication) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Usuń</button>
                </form>
            </div>--}}
        </li>
    @endforeach
</ul>
