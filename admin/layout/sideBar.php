<?php 
include('header_footer/header.php')
?>


    <div class="sidebar">
        <div class="sidebar-inner">
        <div class="sidebar-inner-i">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li>Post Management
                    <ul>
                    <li><a href="createPost.php">Create Post</a></li>
                        <li><a href="listPost.php">List Post</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li>Genre Management
                    <ul>
                        <li><a href="createGenre.php">Create Genre</a></li>
                        <li><a href="listGenre.php">List Genre</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li>Studio Management
                    <ul>
                        <li><a href="createStudio.php">Create Studio</a></li>
                        <li><a href="listStudio.php">List Studio</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<?php 
include('header_footer/footer.php')
?>