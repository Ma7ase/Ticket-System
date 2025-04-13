<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Ticket</title>
    <link rel="stylesheet" href="{{ asset('css/ticket.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('images/logo3.png') }}" />
  </head>
  <body>
    <!-- Image container at the bottom-left -->
    <div class="image-container">
        <img src="{{ asset('images/tabayyun_back.svg') }}" alt="Tabayyun Background" />
    </div>

    <!-- Form container (centered) -->
    <div class="form-container">
        <form class="form-wizard" action="{{ route('login-user') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Completed Section -->
            <div class="completed" hidden>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3>Ticket Create Successful!</h3>
                <h4>The Ticket Details It Send To Your Email.</h4>
            </div>

            <h1>Ticket System</h1>

            <!-- Progress Container -->
            <div class="progress-container">
                <div class="progress"></div>
                <ol>
                    <!--<li class="current">Login</li>-->
                </ol>
            </div>

            <!-- Steps Container -->
            <div class="steps-container">

                <!-- Step 2: Basic Information -->
                <div class="step">
                    <h3>Login To Ticket System</h3>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email" required />
                        <span style="color: red;">@error('email') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter Password" required />
                        <span style="color: red;">@error('password') {{ $message }} @enderror</span>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="controls">
                <button type="button" class="prev-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/ticket.js') }}"></script>
</body>
</html>

