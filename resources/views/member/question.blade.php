@extends('layouts.app')

@section('title', "Member Question")

@push('css')
    <style>
        #clock {
            position: absolute;
            top: 21px;
            right: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Member Question</h1>
        </div>
        <div id="clock">Loading...</div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Question List</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <form action="{{ route('member.question.answer') }}" method="post">
                                        @csrf

                                        @foreach ($list_questions as $key => $question)
                                            <div class="form-group mb-2">
                                                <label for="question">{{ ++$key }}. {{ $question->question->description }}</label>
                                                <input type="text" name="question_id[]" value="{{ $question->id }}" hidden>
                                                <input type="text" name="answer[]" id="answer" class="form-control">
                                            </div>
                                        @endforeach
                                    

                                        <button type="submit" class="btn btn-primary @if($data['status'] == 'lulus') d-none @endif">Submit</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <div class="card @if($data['jumlah_jawab'] == 0 || request()->get('reload') == 1) d-none @endif">
                                        <div class="card-body bg-primary text-center text-white">
                                            <h3>Nilai Anda : {{ $data['total_nilai'] ?? '' }}</h3>
                                            @if ($data['status'] == 'lulus')
                                                <h4>Selamat, Anda lulus!</h4>
                                            @else
                                                <h4>Skor anda dibawah batas minimal, silahkan coba lagi</h4>
                                                <a href="{{ route('member.question.index', ['reload' => 1]) }}" class="btn btn-warning">Coba Lagi</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
    function updateClock() {
        $.ajax({
            url: "/get-time",
            method: "GET",
            success: function(response) {
                // console.log("API Response:", response); // Debugging response

                if (response && response.hour !== undefined && response.minute !== undefined && response.second !== undefined) {
                    let hours = response.hour.toString().padStart(2, '0');
                    let minutes = response.minute.toString().padStart(2, '0');
                    let seconds = response.second.toString().padStart(2, '0');

                    $("#clock").text(hours + ":" + minutes + ":" + seconds);
                } else {
                    // console.error("Invalid response format:", response);
                    $("#clock").text("Invalid time data");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching time:", textStatus, errorThrown);
                $("#clock").text("Error loading time");
            }
        });
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>


@endpush