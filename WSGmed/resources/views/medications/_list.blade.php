{{-- resources/views/medications/_list.blade.php --}}

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nazwa leku</th>
            <th>Opis</th>
            {{-- <th>Akcje</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach($medications as $medication)
            <tr>
                <td>{{ $medication->name }}</td>
                <td>{{ $medication->info }}</td>
                {{-- 
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="Akcje">
                        <a href="{{ route('medications.edit', $medication) }}" class="btn btn-warning">Edytuj</a>
                        <form action="{{ route('medications.destroy', $medication) }}" method="POST" onsubmit="return confirm('Na pewno usunąć?')" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Usuń</button>
                        </form>
                    </div>
                </td>
                --}}
            </tr>
        @endforeach
    </tbody>
</table>
