@extends('layouts.app')

@section('content')

<div class="card">
    <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
        <h3> Grade IPCR Forms </h3>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-mm" id="grading_table">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> MI </th>
                        <th> Position </th>
                        <th> Office </th>
                        <th> Semester </th>
                        <th> Year </th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ipcr_form as $ipcrform)
                    <tr>
                        <td> {{$ipcrform["id"]}} </td>
                        <td> {{$ipcrform["first_name"]}} </td>
                        <td> {{$ipcrform["last_name"]}} </td>
                        <td> {{$ipcrform["mi"]}} </td>
                        <td> {{$ipcrform["position"]}} </td>
                        <td> {{$ipcrform["office"]}} </td>
                        <td> {{$ipcrform["covered_period"]}} </td>
                        <td> {{$ipcrform["date_created"]}} </td>
                        <td> {{$ipcrform["status"]}} </td>
                        <td>
                            <a href="/gradedc/{{$ipcrform['id']}}/edit" class="btn btn-primary"> View </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        <th>
                            <select class="form-control">
                                <option value="">All</option>
                                <option value="CMIO">CMIO</option>
                                <option value="PSD">PSD</option>
                            </select>
                        </th>
                        <th>
                            <select class="form-control">
                                <option value="">All</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                            </select>
                        </th>
                        <th>
                            <select class="form-control">
                                <option value="">All</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </th>
                        <th> </th>
                        <th> </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var dataTable = $('#grading_table').DataTable({
            width: '100%',
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });

        // Custom filters for "covered_period," "date_created," and "office" columns
        $('#grading_table tfoot th').each(function() {
            var title = $(this).text();
            if (title == 'Office' || title == 'Semester' || title == 'Year') {
                $(this).html('<select class="form-control"><option value="">All</option></select>');
            }
        });

        dataTable.columns().every(function() {
            var that = this;

            $('select', this.footer()).on('change', function() {
                var value = $.fn.dataTable.util.escapeRegex($(this).val());
                that.search(value != '' ? '^' + value + '$' : '', true, false).draw();
            });
        });
    });
</script>

@endsection