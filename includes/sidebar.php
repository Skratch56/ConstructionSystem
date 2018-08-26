<div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
        <!-- Main menu with font awesome icon -->
        <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a>
        </li>
        <?php
        include('dbcon.php');

        $query = mysqli_query($con, "select * from employee where employee_id=" . $_SESSION['id'])or die(mysqli_error($con));
        $row = mysqli_fetch_array($query);
        if ($row['jobtitle'] == "CEO") {
            ?><li><a href="combo.php"><i class="fa fa-bar-chart-o"></i> Service</a></li> 
            <li><a href="contract.php"><i class="fa fa-file-text"></i> Contract</a></li>
            <li><a href="material.php"><i class="fa fa-file-text"></i> Material</a></li>
            <li class="has_sub">
                <a href="#"><i class="fa fa-money"></i> Quotation  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>
                    <li><a href="quickquotation.php">Quick Quotation</a></li> 
                    <li><a href="order.php"> New Quotation</a></li> 
                    <li><a href="quotations.php"> Current Quotations</a></li>                     
                    <li><a href="order2.php"> Quotation Service</a></li> 
                    <li><a href="order3.php"> Job Card</a></li> 
                </ul></li>
            <li class="has_sub">
                <a href="#"><i class="fa fa-money"></i> Purchase Order  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>
                    <li><a href="purchaseorders.php"> Current Purchase Orders</a></li> 
                    <li><a href="purchaseorder.php"> New Purchase Order</a></li> 
                    <li><a href="purchasematerial.php"> Purchase Material</a></li> 

                </ul></li>
            <li class="has_sub">
                <a href="#"><i class="fa fa-file-o"></i> Personel  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>			

                    <li><a href="members.php">Customers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="supplier.php">Suppliers</a></li>

                </ul>

            </li>
            <li class="has_sub">
                <a href="#"><i class="fa fa-file-o"></i> Reports  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>			

                    <li><a href="printServices.php">Print Services</a></li>
                    <li><a href="printMaterial.php">Print Material</a></li>
                    <li><a href="printEmployees.php">Print Employee</a></li>
                    <li><a href="printCustomers.php">Print Customer</a></li>
                    <li><a href="printSuppliers.php">Print Supplier</a></li>
                    <li><a href="reports_8.php">Parameterized Reports</a></li>

                </ul>

            </li>
            <?php
        } else if ($row['jobtitle'] == "HR") {
            ?>
    <!--            <li><a href="combo.php"><i class="fa fa-bar-chart-o"></i> Service</a></li> 
            <li class="has_sub">
                <a href="#"><i class="fa fa-money"></i> Quotation  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>
                    <li><a href="quickquotation.php">Quick Quotation</a></li> 
                    <li><a href="order.php"> New Quotation</a></li> 
                    <li><a href="quotations.php"> Current Quotations</a></li>  
                    <li><a href="order2.php"> Quotation Service</a></li> 
                    <li><a href="order3.php"> Job Card</a></li> 
                </ul>
            </li><li class="has_sub">
                <a href="#"><i class="fa fa-money"></i> Purchase Order  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>
                    <li><a href="purchaseorders.php"> Current Purchase Orders</a></li> 
                    <li><a href="purchaseorder.php"> New Purchase Order</a></li> 
                    <li><a href="purchasematerial.php"> Purchase Material</a></li> 

                </ul></li>-->

            <?php
        } else if ($row['jobtitle'] == "Admin") {
            ?>
            <li><a href="combo.php"><i class="fa fa-bar-chart-o"></i> Service</a></li> 
            <li><a href="contract.php"><i class="fa fa-file-text"></i> Contract</a></li>

            <li class="has_sub">
                <a href="#"><i class="fa fa-file-o"></i> Personel  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>			

                    <li><a href="members.php">Customers</a></li>
                    <li><a href="employees.php">Employees</a></li>
                    <li><a href="supplier.php">Suppliers</a></li>


                </ul>

            </li>
            <li class="has_sub">
                <a href="#"><i class="fa fa-file-o"></i> Reports  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
                <ul>			

                    <li><a href="printServices.php">Print Services</a></li>
                    <li><a href="printMaterial.php">Print Material</a></li>
                    <li><a href="printEmployees.php">Print Employee</a></li>
                    <li><a href="printCustomers.php">Print Customer</a></li>
                    <li><a href="printSuppliers.php">Print Supplier</a></li>
                    <li><a href="reports_8.php">Parameterized Reports</a></li>

                </ul>

            </li>
            <?php
        }
        ?>

</div>
