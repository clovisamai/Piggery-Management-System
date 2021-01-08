<nav class="sidebar-nav">
<ul id="sidebarnav">
    <li class="nav-small-cap">&nbsp;&nbsp;&nbsp; OVERVIEW</li>

    <?php if($_SESSION['role'] != 2 ){ ?>
    <li> <a class="waves-effect waves-dark" href="../dashboard/dash.php"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</span></a>
    </li>
    <?php } ?>
    <!-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Inbox</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="app-email.html">Mailbox</a></li>
            <li><a href="app-email-detail.html">Mailbox Detail</a></li>
            <li><a href="app-compose.html">Compose Mail</a></li>
        </ul>
    </li> -->
    <?php if($_SESSION['role'] == 1 ){ ?>
    <li class="nav-small-cap">&nbsp;&nbsp;&nbsp; FARM RECORDS</li>
    
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-utensils"></i><span class="hide-menu">Pigs</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="../pigs/all-pigs.php">All Pigs</a></li>
            <li><a href="../pigs/add-pig.php">Add Pig</a></li>
            <!-- <li><a href="../pigs/edit-pig.php">Edit Pig</a></li> -->
        
        </ul>
    </li>
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Sales</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="../sales/all-sales.php">All Sales</a></li>
            <li><a href="../sales/add-sale.php">Add Sale</a></li>
            <!-- <li><a href="../sales/edit-sale.php">Edit Worker</a></li> -->
        </ul>
    </li>
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Farm Assests</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="../farm_assets/all-assets.php">All Farm Assets</a></li>
            <li><a href="../farm_assets/add-asset.php">Add Farm Asset</a></li>
            <!-- <li><a href="../farm_assets/edit-asset.php">Edit Farm Asset</a></li> -->
        </ul>
    </li>
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-people"></i><span class="hide-menu">Expenses</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="../farm_expenses/all-expenses.php">All Expenses</a></li>
            <li><a href="../farm_expenses/add-expense.php">Add Expense</a></li>
            <!-- <li><a href="../farm_expenses/edit-expense.php">Edit Expense</a></li> -->
            
        </ul>
    </li>
    <!-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-chart"></i><span class="hide-menu">Reports</span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="farm-general-report.html">General Report</a></li>
            <li><a href="farm-income-report.html">Income Report</a></li>
            <li><a href="farm-expense-report.html">Expense Report</a></li>
        </ul>
    </li> -->

    
    
    <li class="nav-small-cap">&nbsp;&nbsp;&nbsp; MANAGE FARM</li>

    <li><a href="../messages/inbox.php"><i class="fas fa-inbox text-dark"></i><span class="hide-menu">Inbox</span></a></li>            
    <li><a href="../quarantine/quarantine.php"><i class="far fa-circle text-dark"></i><span class="hide-menu">Quarantine</span></a></li>            
    <li><a href="../messages/chat_with_vet.php"><i class="fas fa-newspaper text-dark"></i><span class="hide-menu">Chat With Vets</span></a></li>            
    <?php } ?>

    <?php if($_SESSION['role'] == 2 ){ ?>
        <li><a href="../messages/inbox.php"><i class="fas fa-inbox text-dark"></i><span class="hide-menu">Inbox</span></a></li>            
    <?php } ?>


    <li class="nav-small-cap">&nbsp;&nbsp;&nbsp; USER</li>

    <li> <a class="waves-effect waves-dark" href="../users/my_profile.php" aria-expanded="false"><i class="far fa-user text-warning"></i><span class="hide-menu">My Profile</span></a></li>
    <li> <a class="waves-effect waves-dark" href="../../logout.php" aria-expanded="false"><i class="far fa-circle text-success"></i><span class="hide-menu">Log Out</span></a></li>

</ul>
</nav>