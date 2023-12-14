<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
  }

  .button-container {
    text-align: center;
  }

  .custom-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    margin: 10px;
    transition: background-color 0.3s ease;
  }

  .custom-button:hover {
    background-color: #2980b9;
  }
</style>
<title>Localcarz | Login</title>
</head>
<body>
  <div class="button-container">
    <a href="{{ route('login') }}" class="custom-button" style="text-decoration:none">Login <span class="mt-2"><br > As a Admin </span></a>
    <a href="{{ route('login') }}" class="custom-button" style="text-decoration:none">Login <span class="mt-2"><br > As a Dealer </span></a>
  </div>
</body>
</html>
