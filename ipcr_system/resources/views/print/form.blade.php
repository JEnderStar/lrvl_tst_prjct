<style>
    table {
        border: 1px solid;
        border-spacing: 0;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }
    table td{
        border: 1px solid;
        border-spacing: 0;
    }
</style>

<table>
    <tbody>
        <tr>
            <td colspan="12">
                <p class="center"> <b> INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) </b> </p>
                <p>   </p>
                <p> I, <b>{{$Form['first_name']}} {{$Form['mi']}} {{$Form['last_name']}}</b>, {{$Form['position']}} of the <b>{{$Form['office']}}</b> of the <b>Central Management Information Office</b> to deliver and agee to be rated on the attainment of the following actual in accordance with the indicated measures for the period {{$Schedule['duration_from']}} to {{$Schedule['duration_to']}}. </p>
                <p>   </p>
                <p class="right">________________________</p>
                <p class="right"><b>{{$Form['first_name']}} {{$Form['mi']}} {{$Form['last_name']}}</b></p>
                <p class="right">{{$Form['position']}}</p>
                <p class="right">Date: __________________</p>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Reviewed by:
            </td>
            <td colspan="2">
                Date
            </td>
            <td colspan="4">
                Approved by:
            </td>
            <td colspan="2">
                Date
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <br>
                <p class="center"> <b> {{$Schedule['division_chief']}}</b></p>
                <p class="center"> Division Chief </p>
            </td>
            <td colspan="2">
                <br>
                <br>
            </td>
            <td colspan="4">
            <br>
                <p class="center"> <b> {{$Schedule['director']}}</b></p>
                <p class="center"> Director </p>
            </td>
            <td colspan="2">
                <br>
                <br>
            </td>
        </tr>
    </tbody>
</table>