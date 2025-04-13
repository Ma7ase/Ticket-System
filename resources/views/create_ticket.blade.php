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
        <form class="form-wizard" action="{{ route('create.ticket') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Completed Section -->
            <div class="completed" hidden>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3>Ticket Create Successful!</h3>
                <h4>The Ticket Details It Send To Your Email.</h4>
            </div>

            <h1>Create Ticket</h1>

            <!-- Progress Container -->
            <div class="progress-container">
                <div class="progress"></div>
                <ol>
                    <li class="current">Priority</li>
                    <li>Basic Info</li>
                    <li>Attachment</li>
                </ol>
            </div>

            <!-- Steps Container -->
            <div class="steps-container">
                <!-- Step 1: Priority -->
                <div class="step">
                    <h3>Priority Level</h3>
                    <div class="sector-group">
                        <input type="radio" id="privateSector" style="display: none" name="priority" value="Urgent" required />
                        <label for="privateSector" class="sector-option">
                            <h4>Urgent</h4>
                            <p>This ticket is for issues that require immediate attention as they severely impact the service.</p>
                        </label>

                        <input type="radio" id="governmentSector" style="display: none" name="priority" value="High" required />
                        <label for="governmentSector" class="sector-option">
                            <h4>High</h4>
                            <p>This ticket is for issues that are important but not urgent. They impact the service but do not completely halt operations.</p>
                        </label>
                    </div>

                    <div class="sector-group">
                        <input type="radio" id="personalSector" style="display: none" name="priority" value="Medium" required />
                        <label for="personalSector" class="sector-option">
                            <h4>Medium</h4>
                            <p>For issues that are important but do not significantly impact service. They affect individual users or minor functionalities.</p>
                        </label>

                        <input type="radio" id="otherSector" style="display: none" name="priority" value="Low" required />
                        <label for="otherSector" class="sector-option">
                            <h4>Low</h4>
                            <p>For issues that have minimal impact on the service. They are often cosmetic or related to minor inconveniences.</p>
                        </label>
                    </div>
                    <span style="color: red;">@error('priority') {{ $message }} @enderror</span>
                </div>

                <!-- Step 2: Basic Information -->
                <div class="step">
                    <h3>Basic Information</h3>
                    <div class="form-group">
                        <label for="title">Title of Issue</label>
                        <input type="text" id="title" name="title" placeholder="Title of Issue" required />
                        <span style="color: red;">@error('title') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="issue_type">Issue Type</label>
                        <input type="text" id="issue_type" name="issue_type" placeholder="Issue Type" required />
                        <span style="color: red;">@error('issue_type') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="date">Date of Issue</label>
                        <input type="text" id="date" name="date" placeholder="Date" required />
                        <span style="color: red;">@error('date') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="issue_description">Issue Description</label>
                        <textarea id="issue_description" name="issue_description" placeholder="Issue Description"></textarea>
                        <span style="color: red;">@error('issue_description') {{ $message }} @enderror</span>
                    </div>
                </div>

                <!-- Step 3: Attachments -->
                <div class="step">
                    <h3>Attachments</h3>
                    <div class="form-group">
                        <label for="documents">Upload Any Attachment Related To Issue.</label>
                        <div class="file-drop-zone">
                            <input type="file" id="documents" name="documents" required />
                            <span style="color: red;">@error('documents') {{ $message }} @enderror</span>
                            <div class="file-drop-message">
                                <p>You can drag and drop the files directly into the box, file must be no more than 15MB</p>
                            </div>
                        </div>
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
