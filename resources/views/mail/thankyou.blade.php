<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You for Your Review!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    h2 {
      color: #333333;
      margin-bottom: 20px;
    }
    p {
      font-size: 16px;
      color: #555555;
      line-height: 1.5;
    }
    .rating {
      font-size: 18px;
      color: #f39c12;
      font-weight: bold;
    }
    .footer {
      margin-top: 30px;
      font-size: 14px;
      color: #999999;
      text-align: center;
    }
    @media (max-width: 600px) {
      .email-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="email-container">
    <h2>Thank You, {{ $review['name'] }}!</h2>
    <p>We appreciate your feedback.</p>
    <p>Your rating: <span class="rating">{{ $review['rating'] }}/5</span></p>
    <p>Your review:</p>
    <blockquote style="font-style: italic; color: #333; border-left: 4px solid #f39c12; padding-left: 10px;">
      "{{ $review['review'] }}"
    </blockquote>
    <p>We hope to see you again soon!</p>

    <div class="footer">
      &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
  </div>

</body>
</html>
