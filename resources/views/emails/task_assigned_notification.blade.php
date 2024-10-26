<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task Assigned Notification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center bg-primary text-white">
                <h4>New Task Notification</h4>
            </div>
            <div class="card-body">
                <p class="lead">Dear {{ $task->assignedTo->name }},</p> <!-- Fixed this line -->
                <p>You have been assigned to a new task <strong>{{ $task->title }}</strong>.</p>

                <div class="mb-3">
                    <strong>Description:</strong>
                    <p>{{ $task->description }}</p>
                </div>
                <div class="mb-3">
                    <strong>Due Date:</strong>
                    <p>{{ $task->due_date }}</p>
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