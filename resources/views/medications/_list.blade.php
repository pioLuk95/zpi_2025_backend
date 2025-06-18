{{-- resources/views/medications/_list.blade.php --}}
<table class="table table-striped">
    <thead>
        <tr>
            <th> Imię </th>
            <th> Substancja czynna </th>
        </tr>
    </thead>
    <tbody>
    @foreach($medications as $medication)
        <tr>
            <td> {{ $medication->name }} </td>
            <td> {{ $medication->info }} </td>
        </tr>
    @endforeach
    <tbody>
</table>
