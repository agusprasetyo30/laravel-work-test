@extends('layouts.app')

@section('title', "Master Quiz")

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Master Quiz</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Members</h4>

                            <div class="card-header-action">
                                <a type="button" class="btn btn-primary text-white add-member-button">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Member</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-responsive-lg" id="members_table" data-table-route="{{ route('admin.master.datatables.members') }}">
                                <thead>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <th width="50%">Email</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h4>Question</h4>

                            <div class="card-header-action">
                                <a type="button" class="btn btn-primary text-white add-question-button">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Question</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-responsive-lg" id="questions_table" data-table-route="{{ route('admin.master.datatables.questions') }}">
                                <thead>
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="90%">Question</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Assigned Question</h4>
                        </div>
                        <div class="card-body">
                            <a type="button" class="btn btn-primary text-white assign-question-button mb-2" data-assign-question-route="{{ route('admin.master.assign-question') }}">
                                <i class="fa fa-plus"></i>
                                <span> Assign Data</span>
                            </a>
                            <table class="table table-striped table-hover table-responsive-lg" id="assigned_question_table" data-table-route="{{ route('admin.master.datatables.assigned-question') }}">
                                <thead>
                                    <tr align="center">
                                        <th>Member Name</th>
                                        <th>Question</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
    </section>

    @include('admin.master-quiz.modal-add-member')
    @include('admin.master-quiz.modal-add-question')
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#members_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                ordering: false,
                ajax: $('#members_table').data('table-route'),
                lengthMenu: [5, 10, 25, 50, 100],
                "order": [
                    [0, "asc"]
                ],
                columns: [
                    { data: 'name', name: 'name' , orderable: false, searchable: true},
                    { data: 'email', name: 'email' , orderable: false, searchable: true},
                    { data: 'actions', name: 'actions'},
                ],
            })

            $('#questions_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                ordering: false,
                ajax: $('#questions_table').data('table-route'),
                lengthMenu: [5, 10, 25, 50, 100],
                "order": [
                    [0, "asc"]
                ],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'description', name: 'description' , orderable: false, searchable: true}
                ],
            })

            $('#assigned_question_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                bDestroy: true,
                ordering: false,
                searchable: false,
                ajax: $('#assigned_question_table').data('table-route'),
                lengthMenu: [5, 10, 25, 50, 100],
                "order": [
                    [0, "asc"]
                ],
                columns: [
                    { data: 'member_name', name: 'member_name' , orderable: false, searchable: false},
                    { data: 'question_description', name: 'question_description' , orderable: false, searchable: false}
                ],
            })
        });

        $(document).on('click', '.delete-member-button', function() {
            let data_row = $('#members_table').DataTable().row($(this).parents('tr')).data()
            let url = $(this).data('delete-route')
            url = url.replace(':id', data_row['id'])

            Swal.fire({
                title: "Delete Data  ?",
                text: "Data changes will affect the stored data!",
                icon: "question",
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#DC3545',
                confirmButtonText: 'Delete!',
                cancelButtonText: 'Cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            if (data.error == 0) {
                                toast.fire({
                                    icon: 'success',
                                    title: data.message
                                })

                                $('#members_table').DataTable().ajax.reload()
                            }

                            // Muncul alert error ketika tidak lolos validasi
                            if (data.error == 1) {
                                if (data.code == 'validation') {
                                    $.each(data.message, function (index, message) {
                                        toast.fire({
                                            icon: 'error',
                                            title: data.message
                                        })
                                    })
                                } else {
                                    $.each(data.message, function (index, message) {
                                        toast.fire({
                                            icon: 'error',
                                            title: data.message
                                        })
                                    })
                                }
                            }
                        }
                    })
                }
            })
        })

        $('.add-member-button').on('click', function() {
            $('#modalAddMember').modal('show');
        });

        $('#save_member').click(function() {
            let name = $('#name').val();
            let email = $('#email').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).data('save-member-route'),
                data: {
                    name : name,
                    email : email
                },
                type: 'POST',
                success: function (data) {
                    if (data.error == 0) {
                        toast.fire({
                            icon: 'success',
                            title: data.message
                        })

                        $('#modalAddMember').modal('hide')
                        $('#members_table').DataTable().ajax.reload()
                    }

                    // Muncul alert error ketika tidak lolos validasi
                    if (data.error == 1) {
                        if (data.code == 'validation') {
                            $.each(data.message, function (index, message) {
                                toast.fire({
                                    icon: 'error',
                                    title: data.message
                                })
                            })
                        } else {
                            $.each(data.message, function (index, message) {
                                toast.fire({
                                    icon: 'error',
                                    title: data.message
                                })
                            })
                        }
                    }
                }, 
                error: function(xhr, status) {
                    console.log(xhr);
                    console.log(status);
                }
            })
        })

        // Question

        $('.add-question-button').on('click', function() {
            $('#modalAddQuestion').modal('show');
        });

        // Upload CSV
        $('#upload_file_csv').click(function() {
            let file = $('#csv_file')[0].files[0];
            let formData = new FormData();
            formData.append('csv_file', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: $(this).data('save-question-route'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.error == 0) {
                        toast.fire({
                            icon: 'success',
                            title: data.message
                        })

                        $('#modalAddQuestion').modal('hide');
                        $('#questions_table').DataTable().ajax.reload()
                        $('#uploadMessage').text(data.message).css('color', 'green');
                    }

                },
                error: function(response) {
                    $('#uploadMessage').text('Gagal mengupload CSV!').css('color', 'red');
                }
            });
        });
        

        $('.assign-question-button').on('click', function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).data('assign-question-route'),
                type: 'POST',
                success: function (data) {
                    if (data.error == 0) {
                        toast.fire({
                            icon: 'success',
                            title: data.message
                        })

                        $('#assigned_question_table').DataTable().ajax.reload()
                    }

                    // Muncul alert error ketika tidak lolos validasi
                    if (data.error == 1) {
                        if (data.code == 'validation') {
                            $.each(data.message, function (index, message) {
                                toast.fire({
                                    icon: 'error',
                                    title: data.message
                                })
                            })
                        } else {
                            $.each(data.message, function (index, message) {
                                toast.fire({
                                    icon: 'error',
                                    title: data.message
                                })
                            })
                        }
                    }
                }, 
                error: function(xhr, status) {
                    console.log(xhr);
                    console.log(status);
                }
            })
        });
    </script>
@endpush