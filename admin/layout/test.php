<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <style>
        .dropdown {
            position: relative;
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropbtn {
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>

    <div class="dropdown">
        <div class="dropbtn">Dropdown 1</div>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </div>

    <div class="dropdown">
        <div class="dropbtn">Dropdown 2</div>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </div>

    <script>
        // Get all dropdown buttons
        var dropdowns = document.querySelectorAll('.dropdown');

        // Add event listener to each dropdown button
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('click', function() {
                // Toggle dropdown-content visibility
                var dropdownContent = this.querySelector('.dropdown-content');
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Close dropdown-content if clicked outside
        window.addEventListener('click', function(event) {
            dropdowns.forEach(function(dropdown) {
                var dropdownContent = dropdown.querySelector('.dropdown-content');
                if (!dropdown.contains(event.target) && dropdownContent.style.display === 'block') {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>