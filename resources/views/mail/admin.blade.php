<!DOCTYPE html>
<html>
<head>
    <title>New Review Notification</title>
</head>
<body>
    <h2>A new review has been submitted</h2>
    <p><strong>Business:</strong> {{ $business->name }}</p>
    <p><strong>Reviewer:</strong> {{ $review['name'] }}</p>
    <p><strong>Rating:</strong> {{ $review['rating'] }}/5</p>
    <p><strong>Review:</strong> "{{ $review['review'] }}"</p>
</body>
</html>
