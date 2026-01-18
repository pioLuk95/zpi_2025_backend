<table class="table table-bordered">
    <thead>
    <tr>
        <th> Imię i nazwisko </th>
        <th> Data urodzenia </th>
        <th> Sala i piętro </th>
    </tr>
    </thead>
    <tbody>
    @foreach($patients as $patient)
        <tr>
            <td> {{ $patient->name }} {{ $patient->s_name }} </td>
            <td> {{ $patient->date_of_birth }} </td>
        </tr>
    @endforeach
    <tbody>
</table>
