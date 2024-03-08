<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-inner-i">
            <div class="dropdown-topic">
                <ul class="dropdown">
                    <li><a href="dashboard.php"><span class="material-symbols-outlined">
                                team_dashboard
                            </span>Dashboard</a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">Post Management</div>

                    <ul class="dropdown-content">
                        <li><a href="createPost.php">Create Post</a></li>
                        <li><a href="listPost.php">List Post</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">Genre Management</div>

                    <ul class="dropdown-content">
                        <li><a href="createGenre.php">Create Genre</a></li>
                        <li><a href="listGenre.php">List Genre</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">Studio Management</div>

                    <ul class="dropdown-content">
                        <li><a href="createStudio.php">Create Studio</a></li>
                        <li><a href="listStudio.php">List Studio</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">Producer Management</div>
                    <ul class="dropdown-content">
                        <li><a href="createProducer.php">Create Producer</a></li>
                        <li><a href="listProducer.php">List Producer</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">Source Management</div>
                    <!-- <div class="dropbtn">></div> -->
                    <ul class="dropdown-content">
                        <li><a href="createSource.php">Create Source</a></li>
                        <li><a href="listSource.php">List Source</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<script>
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', () => {
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
<style>
    .dropdown {
        position: relative;
        display: block;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        /* position: absolute; */
        /* padding-left: 4px; */
        margin-left: 7px;
        margin-top: 5px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        background-color: aliceblue;
        z-index: 1;
        font-weight: 200;
    }

    .dropdown>li>a {
        text-decoration: none;
        color: #000;

    }

    .dropdown-content>li>a {
        display: block;
        text-decoration: none;
        padding: 4px 0 7px 9px;
        width: 100%;
        color: #000;
        font-weight: 300;
    }

    .dropdown-content>li>a:hover {
        background-color: #8ea1cb;
        /* color: #fff; */
        font-weight: 500;
    }


    .dropdown-topic:hover {
        background-color: #6b77c7;
        font-weight: 500;
        color: aliceblue;
    }
</style>
<?php
include('header_footer/footer.php')
?>