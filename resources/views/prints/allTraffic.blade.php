{{-- <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style> --}}
<h2>HTML Table</h2>

<table>
  <tr>
    <th>شماره کاربری</th>
    <th>نام</th>
    <th>نام خانوادگی</th>
    <th>جهت تردد</th>
    <th>دستگاه تردد</th>
    <th>تاریخ تردد</th>
    <th>پیام</th>
  </tr>
  @foreach ($traffic as $element)
  <tr>
    <td>{{ $element->user->code }}</td>
    <td>{{ $element->user->people->name }}</td>
    <td>{{ $element->user->people->lastname }}</td>
    <td>{{ $element->gatedirect->name }}</td>
    <td>{{ $element->gatedevice->name }}</td>
    {{-- <td>{{ toPersian(record.gatedate) }}</td> --}}
    <td>{{ $element->gatemessage->message }}</td>
  </tr>
	@endforeach
  

</table>


