<table style="border: 1px solid #000; border-collapse: collapse;">
   <tbody style="border: 1px solid #000;">
      @foreach ($filtered_rows as $row)
         <tr style="@if(isset($row['bg_color']) && $row['bg_color'] == 'red')
                        background: #f87171
                     @elseif(isset($row['bg_color']) && $row['bg_color'] == 'yellow')
                        background: #fde047 
                     @endif;"
         >
            <td style="border: 1px solid #000;">{{ $row['month'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['date'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['day'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['id'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['employee_name'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['department'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['first_in_time'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['last_out_time'] }}</td>
            <td style="border: 1px solid #000;">{{ $row['hours_of_work'] }}</td>
         </tr>
      @endforeach
   </tbody>
</table>