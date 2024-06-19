<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Implementation of an RFID-Based College Management System Using PHP and MySQL</title>
<style>
  @keyframes colorShift {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
  }

  body, html {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: white;
    background: linear-gradient(-45deg, #FF007A, #9C27B0, #2196F3, #FF007A);
    background-size: 400% 400%;
    animation: colorShift 15s ease infinite;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
  }

  .header img {
    width: 100%;
    height: auto;
    display: block; /* Removes any space below the image */
  }

  .title {
    margin: 20px 0;
    font-size: 2.5em;
    font-weight: 900; /* Boldness increased for more impact */
    text-align: center;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5); /* Shadow added for depth */
  }

  .navigation {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Updated to accommodate five links */
    gap: 20px;
    margin-top: 20px;
    width: 80%; /* Adjust based on your preference */
  }

  .nav-link {
    background-color: rgba(255,255,255,0.3); /* Semi-transparent to blend with the background */
    padding: 20px;
    text-align: center;
    text-decoration: none;
    color: white;
    font-weight: bold;
    font-size: 1.2em; /* Size increased for readability */
    border: none; /* Remove border for a smoother look */
    border-radius: 10px;
    transition: transform 0.3s, background-color 0.3s;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5); /* Shadow added for depth */
  }

  .nav-link:hover {
    transform: scale(1.05);
    background-color: rgba(255,255,255,0.5);
  }
</style>
</head>
<body>

<div class="header">
  <img src="college.png" alt="College Logo" style="max-height: 100px;"> <!-- Adjust max-height as needed -->
</div>

<div class="title">Implementation of an RFID-Based College Management System Using PHP and MySQL</div>

<div class="navigation">
  <a href="hod_login.php" class="nav-link">HOD Page</a>
  <a href="professor_page.php" class="nav-link">Professor Page</a>
  <a href="instructor_page.php" class="nav-link">Instructor Page</a>
  <a href="library_page.php" class="nav-link">Library Page</a>
  <a href="student_portal.php" class="nav-link">Student Portal</a> <!-- New link added -->
</div>

</body>
</html>
