<!DOCTYPE html>
<html>
<head>
    <title>Shortlister</title>
    @vite(['resources/css/index.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Add person</h2>
            <form id="form-addperson" >
                @csrf
                <div class="form-input">
                    <input type="text" name="full_name" id="full_name" placeholder="Full Name">
                    <div class="form-error" id="error-full_name"></div>
                </div>
                <div class="form-input">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <div class="form-error" id="error-email"></div>
                </div>
                <div class="form-input">
                    <input type="text" name="phone_number" id="phone_number" placeholder="Phone">
                    <div class="form-error" id="error-phone_number"></div>
                </div>
                <div class="form-input">
                    <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth">
                    <div class="form-error" id="error-date_of_birth"></div>
                </div>
                <div class="form-submit">
                    <button type="submit">Save</button>
                    <div id="form-message"></div>
                </div>
            </form>
        </div>
        <div class="table-container">
            <h2>List of added people</h2>
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of birth</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody id="people-table-body">
                    @foreach($people as $person)
                    <tr>
                        <td>{{ $person->full_name }}</td>
                        <td><a href="mailto:{{ $person->email }}">{{ $person->email }}</a></td>
                        <td>{{ $person->phone_number }}</td>
                        <td>{{ $person->date_of_birth }}</td>
                        <td>{{ \Carbon\Carbon::parse($person->date_of_birth)->age }} years</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination" id="pagination-wrapper">
                {{ $people->links() }}
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $('#form-addperson').on('submit', function(e){
            e.preventDefault();

            let data = $(this).serialize();
            
            $('input').removeClass('error');
            $('.form-error').html('');

            $.post("{{ route('people.store') }}", data, function(response){
                $('#form-message').html('<p style="color:green;">Person added successfully!</p>');
                $('#form-addperson')[0].reset();
                $('#people-table-body').html($(response.data).find('#people-table-body').html());
                $('#pagination-wrapper').html($(response.data).find('#pagination-wrapper').html());
            })
            .fail(function(xhr) {
                const errors = xhr.responseJSON.errors;
                $('#form-messages').html('');

                $.each(errors, function(field, messages) {
                    $('#' + field).addClass('error');
                    $('#error-' + field).html(messages[0]);
                });
            });
        });
    });
</script>

</body>
</html>
