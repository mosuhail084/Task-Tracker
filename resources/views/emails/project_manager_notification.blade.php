<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager Notification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h4>Project Notification</h4>
            </div>
            <div class="card-body">
                <p class="lead">Dear {{ $managerName }},</p>
                @if($isPreviousManager)
                    <p>The management of project <strong>{{ $project->name }}</strong> has been transferred to another manager.</p>
                @else
                    <p>You have been assigned to manage the project <strong>{{ $project->name }}</strong>.</p>
                @endif

                <div class="mb-3">
                    <strong>Description:</strong>
                    <p>{{ $project->description }}</p>
                </div>
                <div class="mb-3">
                    <strong>Start Date:</strong>
                    <p>{{ $project->formatted_start_date }}</p>
                </div>
                <div class="mb-3">
                    <strong>End Date:</strong>
                    <p>{{ $project->formatted_end_date }}</p>
                </div>

                <p>Thank you!</p>
            </div>
            <div class="card-footer text-muted text-center">
                &copy; {{ date('Y') }} Task Tracker
            </div>
        </div>
    </div>
</body>
</html>
