<?php
include('db.php');
$userId = $_SESSION['userid'];
$sql = "SELECT picture_path FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$imagePath = $user['picture_path'] ? $user['picture_path'] : 'profile_pictures/default.png';
?>

<div class="navbar navbar-expand-md header-menu-one bg-light">
    <div class="nav-bar-header-one">
        <div class="header-logo">
            <a href="index.php">
            </a>
        </div>
        <div class="toggle-button sidebar-toggle">
            <button type="button" class="item-link">
                <span class="btn-icon-wrap">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </button>
        </div>
    </div>
    
    <div class="d-md-none mobile-nav-bar">
        <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
            <i class="far fa-arrow-alt-circle-down"></i>
        </button>
        <button type="button" class="navbar-toggler sidebar-toggle-mobile">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
        <ul class="navbar-nav">
            <div id="clock" style="color: blue;">Loading time...</div>
            <script>
                function updateClock() {
                    const now = new Date();
                    const adjustedTime = new Date(now.getTime() + 60 * 60 * 1000); // Add one hour

                    const options = {
                        timeZone: 'UTC',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: true
                    };
                    
                    const formatter = new Intl.DateTimeFormat('en-US', options);
                    const timeString = formatter.format(adjustedTime);
                    document.getElementById('clock').textContent = timeString;
                }

                setInterval(updateClock, 1000);
                updateClock();
            </script>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item">
                <h3>Digital Meteorological Observatory</h3>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="navbar-item dropdown header-admin">
                <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <div class="admin-title">
                        <h5 class="item-title"><b><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['middle_name'] . ' ' . $_SESSION['last_name']; ?></b></h5>
                        <span><?php echo strtoupper($_SESSION['role']); ?></span>
                    </div>

                    <div class="admin-img">
                        <?php if ($imagePath): ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Admin" class="profile-image">
                        <?php endif; ?>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="item-header">
                        <h6 class="item-title"><?php echo $_SESSION['email']; ?></h6>
                    </div>
                    <div class="item-content">
                        <ul class="settings-list">
                            <li><a href="logout.php"><i class="flaticon-turn-off"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<style>
    .admin-img img {
        width: 40px; 
        height: 40px;
        object-fit: cover; 
        border-radius: 50%;
        border: 2px solid #0088cc;
    }
</style>
