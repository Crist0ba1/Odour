<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Odour</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('/assets/img/favicon.png')?>" >

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/login.css">
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcI28EfAAAAANzA2FzyZgu9csmxoMPPBYSA9hnw"></script>

    <!-- bootstrap css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <script src="https://kit.fontawesome.com/c818a46c29.js" crossorigin="anonymous"></script>

    <!-- STYLES -->
    <style>
        .centrador {
            position: relative;
            align-content: center;
        }

        .img-center {
            display: block;
            margin: auto;
        }
    </style>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body class="gradient-custom-2">

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        
        <div class="col-md-4">

            <div class="card o-hidden border-0 shadow-lg my-5" >
                <div class="card-body p-4">
                    <!-- Nested Row within Card Body -->

                    <div class="text-center">
                        <img alt="Logo" class="img-fluid img-center" src="<?php echo base_url('/assets/img/') ?>/logo.png">
                        <h1 class="h4 text-gray-900 mb-4 mt-2">Monitoreo de sensores en tiempo real</h1>
                    </div>
                    <form id="loginForm" action="<?php echo base_url('/iniciarSession') ?>" class="user" method="post">

                        <input type="hidden" id="g-token" name="g-token">

                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="emailrL" name="emailrL" aria-describedby="emailHelp" placeholder="Correo electrónico" required>
                            <span id="email_error" class="text-danger">
                        </div>
                        <div class="form-group input-group">
                            <input type="password" class="form-control form-control-user" minlength="5" id="passwordrL" name="passwordrL" placeholder="Contraseña" required>
                            <span id="passwordrL_error" class="text-danger">
                                <div class="input-group-append">
                                    <button id="ShowPasswordL" class="btn btn-primary" type="button" onclick="mostrarPasswordrL()"> <span id="icon2" class="fa fa-eye-slash iconL"></span> </button>
                                </div>
                        </div>
                        <?php if (session()->has('mensaje')) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <h5><?php echo session()->get('mensaje') ?> </h5>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                    <label class="form-check-label" for="form2Example31"> Recordarme </label>
                                </div>
                            </div>

                            <div class="col">
                                <!-- Simple link -->
                                <a href="#!">¿Olvidó su contraseña?</a>
                            </div>
                        </div>

                        <!--input type="hidden" name ="action" id="action" value="ini" /-->
                        <input type="submit" name="submit" id="submit_button" class="btn btn-primary btn-block" value="Iniciar sesión" />

                    

                    </form>

                </div>
            </div>

        </div>

    </div>

    

    <script>

        grecaptcha.ready(function() {
        grecaptcha.execute('6LcI28EfAAAAANzA2FzyZgu9csmxoMPPBYSA9hnw', {action: 'homepage'}).then(function(token) {
                // console.log(token);
                document.getElementById("g-token").value = token;
            });
        });


        $(document).ready(function() {
            //CheckBox mostrar contraseña
            $('#ShowPasswordL').click(function() {
                $('#PasswordrL').attr('type', $(this).is(':checked') ? 'text' : 'password');
            });
        });

        function mostrarPasswordrL() {
            var cambio = document.getElementById("passwordrL");
            if (cambio.type == "password") {
                cambio.type = "text";
                $('#iconL').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                cambio.type = "password";
                $('#iconL').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        }
    </script>

</body>

</html>