<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
</head>
<body>
    <div class="email-container">
        <!-- Header section with logo -->
        <div class="header">
            <!--<img src="https://store.tabayyun.com.sa/tabayyun.png" alt="Company Logo">-->
        </div>

        <!-- Email content section -->
        <div class="content">
            <h2>Tabayyun Ticket</h2>
            
            <div class="details">
                <p><strong>
                    <br>
                    <br>
                    Dear,
                    <br>
                    I hope this message finds you well. Below are the details of Tabayyun Ticket:
                    <br>
                    <br>
                    <p><strong>Ticket Id:</strong> {{ $data['id'] }}</p>
                    <p><strong>Priority:</strong> {{ $data['priority'] }}</p>
                    <p><strong>Title:</strong> {{ $data['title'] }}</p>
                    <p><strong>Issue Type:</strong> {{ $data['issue_type'] }}</p>
                    <p><strong>Date Of Issue:</strong> {{ $data['date'] }}</p>
                    <p><strong>Issue Description:</strong> {{ $data['issue_description'] }}</p>
                    <br>
                    <br>          
                    A support representative will be reviewing your Issue and will Solve the Issue as soon as possible.
                    <br>
                    <br>
                    Thank you.
                </p>
            </div>
        </div>

        <!-- Footer section -->
        <div class="footer">
            <p>Best regards,<br>Tabayyun Team</p>
        </div>
    </div>
</body>
</html>