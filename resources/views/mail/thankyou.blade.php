<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Review!</title>
</head>
<body>
    <h2>Thank You, {{ $review['name'] }}!</h2>
    <p>We appreciate your feedback. Your rating: <strong>{{ $review['rating'] }}/5</strong>.</p>
    <p>Your review: "{{ $review['review'] }}"</p>
    <p>We hope to see you again soon!</p>
</body>
</html>
