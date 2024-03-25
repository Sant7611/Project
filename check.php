<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Popup Dialogue Box</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
    }
    .dialog-box {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
    }
    h2 {
        margin-top: 0;
    }
    p {
        margin-bottom: 20px;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="overlay" id="overlay">
    <div class="dialog-box">
        <h2>Welcome to Our Website</h2>
        <p>Thank you for visiting our website. How can we assist you today?</p>
        <button onclick="closeDialog()" class="btn">Close</button>
    </div>
</div>

<button onclick="openDialog()" class="btn">Open Dialog</button>

<script>
    function openDialog() {
        document.getElementById("overlay").style.display = "flex";
    }

    function closeDialog() {
        document.getElementById("overlay").style.display = "none";
    }
</script>

</body>
</html>
