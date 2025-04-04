<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>New Review Notification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f6f8fa;
      font-family: Arial, sans-serif;
    }
    .email-wrapper {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }
    p {
      font-size: 16px;
      color: #333333;
      margin: 12px 0;
    }
    .label {
      font-weight: bold;
      color: #555555;
    }
    .rating {
      font-weight: bold;
      color: #f39c12;
    }
    .review-box {
      background-color: #f2f2f2;
      padding: 15px;
      border-left: 4px solid #3498db;
      margin-top: 10px;
      font-style: italic;
      color: #444;
    }
    .footer {
      margin-top: 30px;
      font-size: 13px;
      color: #aaa;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <h2>📢 A New Review Has Been Submitted</h2>

    <p><span class="label">Business:</span> {{ $business->name }}</p>
    <p><span class="label">Reviewer:</span> {{ $review['name'] }}</p>
    <p><span class="label">Rating:</span> <span class="rating">{{ $review['rating'] }}/5</span></p>
    <p><span class="label">Review:</span></p>
    <div class="review-box">
      "{{ $review['review'] }}"
    </div>

    <div class="footer">
      &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
  </div>
</body>
</html>
