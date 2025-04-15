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
  <br><br>
  <!--<h1>Welcome, {{ $email }}</h1>-->
  <h3>Your Tickets</h3>

  <!-- Form container (centered) -->
  <div class="form-container">

    @if($tickets->isEmpty())
      <p>No tickets found.</p>
    @else
    <table id="customers">
      <thead>
        <tr>
          <th>ID</th>
          <th>Priority</th>
          <th>Title</th>
          <th>Issue Type</th>
          <th>Date</th>
          <th>Description</th>
          <th>Documents</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tickets as $ticket)
          <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->priority }}</td>
            <td>{{ $ticket->title }}</td>
            <td>{{ $ticket->issue_type }}</td>
            <td>{{ $ticket->date }}</td>
            <td>{{ $ticket->issue_description }}</td>
            <td>
              @if($ticket->documents)
                <a href="{{ asset($ticket->documents) }}" target="_blank" style="color: white;">View</a>
              @else
                N/A
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    @endif

  </div>

  <!-- Button BELOW the table -->
  <form action="{{ route('create.ticket') }}" method="GET" style="margin-top: 20px; text-align: center;">
    <button type="submit">Create Ticket</button>
  </form>

  <script src="{{ asset('js/ticket.js') }}"></script>
</body>
</html>
