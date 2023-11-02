<!DOCTYPE html>
<html>
<head>
    <title>Bus Schedules</title>
</head>
<style type="text/css">
    table {
        width: 100%;
        border-collapse: collapse;
       
    }
    table td,
    table th {
        padding-bottom: 5px;
        line-height: 2;
        border: 1px solid #ddd;
        width:20%;

    }

     td {
        width: 1px;
    }
  .thead {
 
 color: #fffffc;
 /* opacity: 0.8; */
 background-color: #3A3B3C;
 text-transform: uppercase;

 /* border-color: #792700; */

}
tr:nth-child(even) {
  background-color: #F4F6F6;
}
h2 {
    text-align: center;
}
</style>
<body>
<h2>Bus Schedules</h2>

    <table>
        <tr>
            <th>Bus Name</th>
            <th>Bus No</th>
            <th>Route Name</th>
            <th>Start Point</th>
            <th>End Point</th>
            <th>Distance</th>
            <th>Start Time</th>
            <th>End Time</th>

        </tr>
        @foreach($schedules as $schedule)
        <tr>
            <td>{{$schedule->bus->name}}</td>
            <td>{{$schedule->bus->bus_no}}</td>
            <td>{{$schedule->route->route_name}}</td>
            <td>{{$schedule->route->start_point}}</td>
            <td>{{$schedule->route->end_point}}</td>
            <td>{{$schedule->route->distance}}</td>
            <td>{{$schedule->start_time}}</td>
            <td>{{$schedule->end_time}}</td>

</tr>
        @endforeach
       
</table>
</body>
</html>
