<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: rgb(234, 212, 65);
        }

        .select {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 150px;
            height: 50px;
            padding: 12px;
        }

        .caret {
            border-right: 8px solid transparent;
            border-left: 8px dashed transparent;
            border-top: 6px solid black;
        }

        .caret:hover {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <div class="dropdown">

        <div class="select">
            <label>Dropdown Menu</label>
            <div class="caret"></div>
        </div>
        <ul class="menu">
            <li>Menu 1</li>
            <li>Menu 2</li>
            <li>Menu 3</li>
            <li>Menu 4</li>
        </ul>
    </div>
</body>

</html>