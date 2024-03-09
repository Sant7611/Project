<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-inner-i">
            <div class="dropdown-topic">
                <ul>
                    <li class="dropdown">
                        <a href="dashboard.php">
                            <div class="icon-space">
                                <span class="material-icons-outlined">space_dashboard</span>
                                <span>Dashboard</span>
                                <span></span>
                            </div>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-inner-i">
            <ul>
                <li class="dropdown">
                    <div class="dropdown-topic">
                        <div class="icon-space">
                            <span class="material-icons-outlined">post_add</span>
                            <span>Post Management</span>
                            <span class="material-icons-outlined toggle">expand_less</span>
                        </div>
                    </div>

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
                    <div class="dropdown-topic">
                        <div class="icon-space">
                            <span class="material-icons-outlined">library_music</span>
                            <span>Genre Management</span>
                            <span class="material-icons-outlined toggle">expand_less</span>
                        </div>

                    </div>

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
                    <div class="dropdown-topic">
                        <div class="icon-space">
                            <span class="material-icons-outlined">theaters</span>
                            <span>Studio Management</span>
                            <span class="material-icons-outlined toggle">expand_less</span>
                        </div>
                    </div>

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
                    <div class="dropdown-topic">
                        <div class="icon-space">
                            <span class="material-icons-outlined">business</span>
                            <span>Producer Management</span>
                            <span class="material-icons-outlined toggle">expand_less</span>
                        </div>
                    </div>
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
                    <div class="dropdown-topic">
                        <div class="icon-space">
                            <span class="material-icons-outlined">dynamic_form</span>
                            <span>Source Management</span>
                            <span class="material-icons-outlined toggle">expand_less</span>

                        </div>
                    </div>
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
            const icon = dropdown.querySelector('.toggle');
            icon.style.transform = icon.style.transform === 'rotate(0deg)' ? 'rotate(180deg)' : 'rotate(0deg)';
        });
    });
</script>
<?php
include('header_footer/footer.php')
?>