<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}"><b> Online IPCR Filling System </b></a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    <form method="post" id="registerForm" action="/registeraccount">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-heading"></span></div>
                            </div>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-heading"></span></div>
                            </div>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="mi" class="form-control @error('mi') is-invalid @enderror" value="{{ old('mi') }}" placeholder="MI" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-heading"></span></div>
                            </div>
                            @error('mi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}" placeholder="Position" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('position')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <!-- <input type="text" name="office" class="form-control @error('office') is-invalid @enderror" value="{{ old('office') }}" placeholder="Office">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-object-group"></span></div>
                            </div> -->
                            <select class="form-control @error('office') is-invalid @enderror" value="{{ old('office') }}" name="office" id="office" required>
                                <option value="" selected disabled>Select Office</option>
                                <option value="CMIO">CMIO</option>
                                <option value="PSD">PSD</option>
                            </select>
                            @error('office')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-lock"></span></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                    <label for="agreeTerms">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->

            <!-- /.form-box -->
        </div>
        <!-- /.register-box -->
    </body>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let errorMessages = '';
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData($('#registerForm')[0]);

            Swal.fire({
                title: 'Now Loading',
                html: '<b> Please wait... </b>',
                timer: 15000,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
            $.ajax({
                url: "/registeraccount",
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Display a success message using Swal library
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/";
                            }
                        })
                    } else {
                        // Loop through response errors and concatenate error messages
                        for (let i = 0; i < response.errors.length; i++) {
                            errorMessages += "-" + response.errors[i] + "\n";
                        }

                        // Display an error message with the concatenated error messages
                        Swal.fire({
                            html: '<pre>' + errorMessages + '</pre>',
                            customClass: {
                                popup: 'format-pre'
                            },
                            title: 'Error!',
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        })

                        errorMessages = "";
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred during the registration process.',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                }
            });
        });
    </script>
</x-laravel-ui-adminlte::adminlte-layout>