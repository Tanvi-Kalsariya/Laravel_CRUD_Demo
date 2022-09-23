<!doctype html>
<html lang="en">

<head>
    <title>Laravel | CRUD</title>
    <!-- requireds meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: lightblue;
        }

        * {
            font-family: poppins;
        }

        .btn-action {
            margin: 10px 10px;
        }

        .student-img {
            width: 100px;
            height: 100px;
        }
        .w-5{
            display: none;
        }
    </style>
</head>

<body>
    <div class="jumbotron jumbotron-fluid text-center">
        <h1 class="display-4">Laravel CRUD</h1>
        <p class="lead">By Aamirsohel Burma</p>
        <hr class="my-4">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                @if (isset($status) && $status == 'Inserted')
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Congratulations!</strong> Record inserted successfully.
                    </div>
                @elseif(isset($updated))
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Done!</strong> Record Upadated successfully.
                    </div>
                @elseif(isset($deleted))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Hmmm!</strong> Record Deleted successfully.
                    </div>
                @endif
                <form name="form1" method="POST" enctype="multipart/form-data"
                    action="{{ isset($record) ? route('student.update') : '/' }}">
                    @csrf
                    @if (isset($record))
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $record->id }}">
                        {{-- {{ method_field('PUT') }} --}}
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" class="form-control"
                                    placeholder="Enter your name" value="{{ isset($record) ? $record->name : '' }}"
                                    aria-describedby="helpId" requireds>
                                @if ($errors->first('name'))
                                    <small class="text-danger"><?= $errors->first('name') ?></small>
                                @else
                                    <small id="helpId" class="text-muted">E.g. : Aamirsohel Burma</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <?php
                                //print_r($record);
                                ?>
                                <input type="email" name="email" value="{{ isset($record) ? $record->email : '' }}"
                                    id="" class="form-control" placeholder="Enter your email"
                                    aria-describedby="helpId" requireds>
                                @if ($errors->first('email'))
                                    <small class="text-danger"><?= $errors->first('email') ?></small>
                                @else
                                    <small id="helpId" class="text-muted">E.g. : aamir@bigscal.com</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-{{ isset($record) ? '12' : '6' }}">
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" id="" class="form-control" placeholder="Enter your address" requireds>{{ isset($record) ? $record->address : '' }}</textarea>
                                @if ($errors->first('address'))
                                    <small class="text-danger"><?= $errors->first('address') ?></small>
                                @else
                                    <small id="helpId" class="text-muted">E.g. : 7/2258, Burma House, Kadiya Street,
                                        rampura,
                                        Surat</small>
                                @endif
                            </div>
                        </div>
                        @if (!isset($record))
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Upload photo</label>
                                    <input type="file" name="photo" id="" class="form-control"
                                        placeholder="Enter yoyur name" aria-describedby="helpId" requireds>
                                    @if ($errors->first('photo'))
                                        <small class="text-danger"><?= $errors->first('photo') ?></small>
                                    @else
                                        <small id="helpId" class="text-muted">Type : jpg/png/webp</small>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ isset($record) ? 'Update' : 'Submit' }}</button>
                        </div>
                    </div>
                    <br />
                    @if (isset($record))
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="/" class="btn btn-secondary btn-block">Insert record</a>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped table-dark table-bordered text-center">
                            <thead>
                                <tr>
                                    <td colspan="3"><input type="search" placeholder="Search..." class="form-control" id="search" /></td>
                                    {{-- <td colspan="3"><span class="bg-da">{{$studentRecord->links()}}</span></td> --}}
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Addess</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Addess</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td colspan="6"><span class="bg-da">{{$studentRecord->onEachSide(2)->links()}}</span></td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                {{-- @foreach ($studentRecord as $item) --}}
                                @foreach ($studentRecord as $student)
                                    <tr>
                                        {{-- <td><input type="hidden" name="id" value=" {{$student->id}} "></td> --}}
                                        <td><?= $i++ ?></td>
                                        <td><?= $student->name ?></td>
                                        <td><?= $student->email ?></td>
                                        <td><?= $student->address ?></td>
                                        {{-- <td><img src="{{ asset(.'/student/'.$item->photo) }}" /></td> --}}
                                        <td><img src="{{ url('storage/student/' . $student->photo) }}"
                                                class="student-img" /></td>
                                        <td><a name="" id=""
                                                class="btn-action btn btn-outline-danger"
                                                href="{{ route('student.destroy', ['id' => $student->id]) }}"
                                                role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                
                                            <a name="" id=""
                                                class="btn-action btn btn-outline-warning"
                                                href="{{ route('student.show', ['student' => $student->id]) }}"
                                                role="button"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @push('script')
                    {{-- <script>
                        $(document).ready(function () {
                            $(document).on('click','.pagination a', function(event){
                                event.preventDefault();
                                var page = $(this).attr('href').split('page=')[1];
                                getMoreStudents(page);
                            });
                        
                        });

                        function getMoreStudents(page){
                            $.ajax({
                                type: "GET",
                                url: "{{ route('student.get-more-students') }}",
                                success: function (response) {
                                    $('#student_data').html(response);
                                },
                            });
                        }

                        $(document).ready(function () {
                            $('#search').keyup(function (e) { 
                                console.log($(this).val());
                                
                            $.ajax({
                                type: "POST",
                                url: "{{ route('student.get-more-students') }}",
                                success: function (response) {
                                    $('#student_data').html(response);
                                },
                            });
                            });
                        });
                    </script> --}}
                @endpush
                <div id="student_data"></div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    @stack('script')
    
</body>

</html>
