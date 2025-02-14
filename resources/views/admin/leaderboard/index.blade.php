@extends('layouts.app')

@section('title', "Leaderboard")

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Leaderboard</h1>
        </div>

        <div class="section-body">
			<div class="card card-primary">
				<div class="card-header">
                    <h4>Leaderboard List</h4>
				</div>
				<div class="card-body">
                    <table class="table table-striped table-hover table-responsive-lg" id="leaderboard_table" data-table-route="{{ route('admin.leaderboard.datatables') }}">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Member Name</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#leaderboard_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                ordering: false,
                bFilter: false,
                ajax: $('#leaderboard_table').data('table-route'),
                lengthMenu: [5, 10, 25, 50, 100],
                "order": [
                    [0, "asc"]
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'member_name', name: 'member.name' , orderable: false, searchable: true},
                    { data: 'score', name: 'score' , orderable: false, searchable: true}
                ],
            })
        })
    </script>
@endpush