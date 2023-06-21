<style>
    table {
        border: 1px solid;
        border-spacing: 0;
        width: 100%;
        table-layout: fixed;
    }

    .center {
        text-align: center;
    }

    .center-nm {
        text-align: center;
        margin: 0;
    }

    .right {
        text-align: right;
        margin: 0;
    }

    .middle {
        vertical-align: middle;
    }

    table td {
        border: 1px solid;
        border-spacing: 0;
        word-wrap: break-word;
        overflow-wrap: break-word;
        vertical-align: top;
    }

    .spann {
        display: inline-block;
        margin: 0 auto;
    }
</style>

<table>
    <tbody>
        <tr>
            <td colspan="24">
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
            <td colspan="8">
                Reviewed by:
            </td>
            <td colspan="4">
                Date
            </td>
            <td colspan="8">
                Approved by:
            </td>
            <td colspan="4">
                Date
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <p> </p>
                <p> </p>
                <p class="center-nm"> <b>{{$Schedule['division_chief']}}</b></p>
                <p class="center-nm"> Division Chief </p>
            </td>
            <td colspan="4">
                <p></p>
                <p></p>
            </td>
            <td colspan="8">
                <p></p>
                <p></p>
                <p class="center-nm"> <b>{{$Schedule['director']}}</b></p>
                <p class="center-nm"> Director </p>
            </td>
            <td colspan="4">
                <p></p>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="5" rowspan="2" class="center"> Output </td>
            <td colspan="5" rowspan="2" class="center"> Success Indicator (Target + Measure) </td>
            <td colspan="5" rowspan="2" class="center"> Actual Accomplishments </td>
            <td colspan="4" class="center"> Rating </td>
            <td colspan="5" rowspan="2" class="center"> Remarks </td>
        </tr>
        <tr>
            <td class="center"> Q1 </td>
            <td class="center"> E2 </td>
            <td class="center"> T3 </td>
            <td class="center"> A4 </td>
        </tr>
        <tr>
            <td colspan="24">
                <b> A. STRATEGIC PRIORITIES </b>
            </td>
        </tr>
        @php
        $index = 0;
        @endphp
        @foreach($Add_inputs as $addinput)
        @if($addinput->code == "SP")
        <tr>
            <td colspan="5"> {{$index + 1}}. {{$addinput['functions']}} </td>
            <td colspan="5"> {{$addinput['success_indicators']}} </td>
            <td colspan="5"> {{$addinput['actual_accomplishments']}} </td>
            <td colspan="1" class="center"> {{$addinput['q1']}} </td>
            <td colspan="1" class="center"> {{$addinput['e2']}} </td>
            <td colspan="1" class="center"> {{$addinput['t3']}} </td>
            <td colspan="1" class="center"> <b> {{$addinput['a4']}} </b> </td>
            <td colspan="5"> {{$addinput['remarks']}} </td>
        </tr>

        @php
        $index++;
        @endphp
        @endif
        @endforeach
        <tr>
            <td colspan="24">
                <b> B. CORE FUNCTIONS </b>
            </td>
        </tr>
        @php
        $index = 0;
        @endphp
        @foreach($Add_inputs as $addinput)
        @if($addinput->code == "CF")
        <tr>
            <td colspan="5"> {{$index + 1}}. {{$addinput['functions']}} </td>
            <td colspan="5"> {{$addinput['success_indicators']}} </td>
            <td colspan="5"> {{$addinput['actual_accomplishments']}} </td>
            <td colspan="1" class="center"> {{$addinput['q1']}} </td>
            <td colspan="1" class="center"> {{$addinput['e2']}} </td>
            <td colspan="1" class="center"> {{$addinput['t3']}} </td>
            <td colspan="1" class="center"> <b> {{$addinput['a4']}} </b> </td>
            <td colspan="5"> {{$addinput['remarks']}} </td>
        </tr>

        @php
        $index++;
        @endphp
        @endif
        @endforeach
        <tr>
            <td colspan="24">
                <b> C. SUPPORT FUNCTIONS </b>
            </td>
        </tr>
        @php
        $index = 0;
        @endphp
        @foreach($Add_inputs as $addinput)
        @if($addinput->code == "SF")
        <tr>
            <td colspan="5"> {{$index + 1}}. {{$addinput['functions']}} </td>
            <td colspan="5"> {{$addinput['success_indicators']}} </td>
            <td colspan="5"> {{$addinput['actual_accomplishments']}} </td>
            <td colspan="1" class="center"> {{$addinput['q1']}} </td>
            <td colspan="1" class="center"> {{$addinput['e2']}} </td>
            <td colspan="1" class="center"> {{$addinput['t3']}} </td>
            <td colspan="1" class="center"> <b> {{$addinput['a4']}} </b> </td>
            <td colspan="5"> {{$addinput['remarks']}} </td>
        </tr>

        @php
        $index++;
        @endphp
        @endif
        @endforeach
        <tr>
            <td colspan="4">
                <p> <b> Final Average Rating </b> </p>
            </td>
            <td colspan="14"> </td>
            <td colspan="1" class="middle center"> <b> {{$Form['far']}} </b> </td>
            <td colspan="5"> </td>
        </tr>
        <tr>
            <td colspan="24">
                Comments and Recommendations for Development Purposes:
                <p></p>
                <p> <b> {{$Form['comment']}} </b> </p>
            </td>
        </tr>
        <tr>
            <td colspan="6"> Discussed with </td>
            <td colspan="2"> Date </td>
            <td colspan="6"> Assessed by </td>
            <td colspan="2"> Date </td>
            <td colspan="6"> Final Ranking By</td>
            <td colspan="2"> Date </td>
        </tr>
        <tr>
            <td colspan="6" class="middle center">
                <p> </p>
                <p> </p>
                <span> <b> {{$Form['first_name']}} {{$Form['mi']}} {{$Form['last_name']}} </b> </span>
                <br>
                {{$Form['position']}}
            </td>
            <td colspan="2"> </td>
            <td colspan="6">
                <p> </p>
                <p> </p>
                <p class="center-nm"> <b>{{$Schedule['division_chief']}}</b></p>
                <p class="center-nm"> Division Chief </p>
            </td>
            <td colspan="2"> </td>
            <td colspan="6">
                <p> </p>
                <p> </p>
                <p class="center-nm"> <b>{{$Schedule['director']}}</b></p>
                <p class="center-nm"> Director </p>
            </td>
            <td colspan="2"> </td>
        </tr>
        <tr>
            <td colspan="24">
                <p> Legend:  1 - Quality     2 - Efficiency      3 - Timeliness      4 - Average </p>
            </td>
        </tr>
    </tbody>
</table>