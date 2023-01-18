<h1>{{ __('messages.label') }}: {{ app('request')->session()->get('locale') }}</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Activities</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($cities as $city)
    <tr>
        <td>{{ $city->id }}</td>
        <td>{{ $city->name }}</td>
        <td>{{ $city->activities }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
