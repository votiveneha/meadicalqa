<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nurse-Job Match Score</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f7fa;
      margin: 0;
      padding: 40px;
    }
    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #1a202c;
    }
    .category {
      margin-bottom: 20px;
    }
    .label {
      font-weight: bold;
      color: #2d3748;
    }
    .bar {
      background-color: #e2e8f0;
      border-radius: 8px;
      overflow: hidden;
      height: 24px;
      margin-top: 4px;
    }
    .bar-inner {
      background-color: #3182ce;
      height: 100%;
      color: white;
      padding-left: 8px;
      line-height: 24px;
      white-space: nowrap;
    }
    .total {
      font-size: 1.5em;
      text-align: center;
      margin-top: 40px;
      color: #2b6cb0;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Nurse-Job Match Score Breakdown</h1>

    <div class="category">
      <div class="label">1. Type of Nurse & Role (15%)</div>
      <div class="bar"><div class="bar-inner" style="width: 90%">13.5%</div></div>
    </div>

    <div class="category">
      <div class="label">2. Specialties (15%)</div>
      <div class="bar"><div class="bar-inner" style="width: 75%">11.25%</div></div>
    </div>

    <div class="category">
      <div class="label">3. Experience (15%)</div>
      <div class="bar"><div class="bar-inner" style="width: 80%">12%</div></div>
    </div>

    <div class="category">
      <div class="label">4. Education & Certifications (15%)</div>
      <div class="bar"><div class="bar-inner" style="width: 100%">15%</div></div>
    </div>

    <div class="category">
      <div class="label">5. Vaccination Records (5%)</div>
      <div class="bar"><div class="bar-inner" style="width: 80%">4%</div></div>
    </div>

    <div class="category">
      <div class="label">6. Checks & Clearances (5%)</div>
      <div class="bar"><div class="bar-inner" style="width: 100%">5%</div></div>
    </div>

    <div class="category">
      <div class="label">7. Work Preferences & Flexibility (30%)</div>
      <div class="bar"><div class="bar-inner" style="width: 70%">21%</div></div>
    </div>

    <div class="total">
      <strong>Total Match Score: 81.75%</strong>
    </div>
  </div>
</body>
</html>
