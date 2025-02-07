<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br><br>
        <table class="tbl-full">
            <tr>
                <th style="padding:5px">S.N.</th>
                <th style="padding:5px">Food</th>
                <th style="padding:5px">Price</th>
                <th style="padding:5px">Qty.</th>
                <th style="padding:5px">Order Date</th>
                <th style="padding:5px">Total</th>
                <th style="padding:5px">Status</th>
                <th style="padding:5px">Customer Name</th>
                <th style="padding:5px">Customer Contact</th>
                <th style="padding:5px">Email</th>
                <th style="padding:5px">Address</th>
                <th style="padding:5px">Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>
                        <tr>
                            <td style="padding:5px"><?php echo $sn++; ?>.</td>
                            <td style="padding:5px"><?php echo $food; ?></td>
                            <td style="padding:5px"><?php echo $price; ?></td>
                            <td style="padding:5px"><?php echo $qty; ?></td>
                            <td style="padding:5px"><?php echo $order_date; ?></td>
                            <td style="padding:5px"><?php echo $total; ?></td>
                            <td style="padding:5px"><?php echo $status; ?></td>
                            <td style="padding:5px"><?php echo $customer_name; ?></td>
                            <td style="padding:5px"><?php echo $customer_contact; ?></td>
                            <td style="padding:5px"><?php echo $customer_email; ?></td>
                            <td style="padding:5px"><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
                