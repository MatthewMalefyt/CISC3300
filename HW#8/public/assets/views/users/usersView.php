<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Users Validation</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>

        <h3><?= $title ?></h3>

        <button id="fetch-db">
            fetch users from backend with query string
        </button>

        <div id="users-container"></div>

        <h3 style="margin-top: 50px">create a user</h3>


        <form id="form-id">
            <div style="margin: 20px 0">
                <label>name</label>
                <input type="text" id='name-input' name="name">
                <br>
                <label>age</label>
                <input type="text" id='age-input' name="age">
                <br>
                <label>email</label>
                <input type="text" id='email-input' name="email">
            </div>
            <div style="margin: 20px 0">
                <input type="submit" value="submit"><br/>
            </div>
        </form>

        <div id="data-container"></div>

        <script>

            $(document).ready(function () {

                $("#fetch-db").click(function () {
                    $.ajax({
                        url: 'http://localhost:8888/users?name=pinecone',
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data)
                            $('#users-container').html('')
                            $.each( data, function( key, value ) {
                                console.log(value)
                                $('#users-container').append(`
                                   <p>${value['id']} ${value['name']}</p> `)
                            });
                        }
                    });
                })



                $('#form-id').on('submit', function (e) {
                    e.preventDefault();
                    var name = $('#name-input').val();
                    var age = $('#age-input').val();
                    var email = $('#email-input').val();

                    const data = {
                        name: name,
                        age: age,
                        email: email,
                    }

                    $.ajax({
                        url: 'http://localhost:8888/users',
                        type: "POST",
                        data: data,
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            $('#name-input').val('')
                            $('#age-input').val('')
                            $('#email-input').val('')
                            $('#data-container').html(
                                `<div>
success:
                                    <p>${data.name}</p>
                                    <p>${data.age}</p>
                                    <p>${data.email}</p>
                                 </div>`
                            )
                        },
                        error: function (data){

                            $('#data-container').html('')
                            $.each( data.responseJSON, function( key, value ) {
                                $('#data-container').append(`
                                   <p>${value}</p> `)
                            });

                        }
                    });

                });
            })


        </script>

    </body>
</html>
