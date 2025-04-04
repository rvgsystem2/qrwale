<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Review Submitted</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }

    p {
      font-size: 16px;
      color: #555555;
      line-height: 1.6;
    }

    strong {
      color: #333;
    }

    .rating {
      font-size: 18px;
      color: #f1c40f;
      font-weight: bold;
    }

    .review-box {
      margin: 15px 0;
      padding: 15px;
      border-left: 4px solid #3498db;
      background-color: #f9f9f9;
      font-style: italic;
    }

    .footer {
      text-align: center;
      color: #999;
      font-size: 14px;
      margin-top: 30px;
    }

    @media (max-width: 600px) {
      .container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>📢 New Review Submitted</h2>
    <p>New review submitted for your business: <strong>{{ $business->name }}</strong></p>
    <p><strong>Reviewer:</strong> {{ $review->name }}</p>
    <p><strong>Rating:</strong> <span class="rating">{{ $review->rating }}/5</span></p>
    <p><strong>Review:</strong></p>
    <div class="review-box">
      "{{ $review->review }}"
    </div>
    <p>Stay engaged with your customers and keep up the great work!</p>

    <div class="footer">
      &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
  </div>

</body>
</html>
