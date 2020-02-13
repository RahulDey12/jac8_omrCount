<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Attendance Info</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="baseUrl" data-url="{{ url('/') }}"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="jumbotron mt-3">
                    <h1 class="display-3 text-center">Add Attendance Info</h1>
                    <form action="{{ route('main-page') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="district">District</label>
                            <select name="district" id="district" class="form-control districts">
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" @if(session()->get('dist_id') == $district->id) selected @endif>{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="box">Box No</label>
                            <input type="number" name="box" id="box" class="form-control" required value="{{ session()->get('box') }}"></select>
                        </div>

                        <div class="form-group">
                            <label for="school">School</label>
                            <input type="number" maxlength="6" name="school" id="school" class="form-control school" @if(session()->get('box') != null)autofocus @endif required>
                        </div>

                        <div class="form-group">
                            <label for="total-student">Total Student</label>
                            <input name="total-student" max="500" type="number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success btn-block">Submit</button>
                        </div>
                    </form>
                  </div>
            </div>
        </div>
    </div>
</body>
</html>