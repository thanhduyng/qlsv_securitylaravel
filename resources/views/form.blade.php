<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Dependant Select Box using JQuery Ajax Example</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
<div class="container">
    <h1>jquery ajax </h1>

    <form method="" action="">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Chọn lớp:</label>
            <select class="form-control" name="country">
                <option value="">---</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->tenlophoc }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Chọn sinh viên:</label>
            <select class="form-control" name="city">
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </form>

</div>

<script type="text/javascript">
    var url = "{{ url('/showCitiesInCountry') }}";
    $("select[name='country']").change(function(){
        var id_lophoc = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id_lophoc: id_lophoc,
                _token: token
            },
            success: function(data) {
                $("select[name='city'").html('');
                $.each(data, function(key, value){
                    $("select[name='city']").append(
                        "<option value=" + value.id + ">" + value.hovaten + "</option>"
                    );
                });
            }
        });
    });
</script>
</body>
</html>