<?php
session_start();

if(!isset($_SESSION['logged_in']) ||  $_SESSION['logged_in'] != true){
    header('Location: login.php');
    exit();
}

if(isset($_GET['logout'])){
    session_destroy();
    header('Location: login.php');
    exit();
}

if(!isset($_SESSION['orders'])){
    $_SESSION['orders'] = [];
    $_SESSION['next_id'] = 1;
}

//food items and their prices
$menu = [
    'Butter Chicken'  => 280,
    'Paneer Tikka'    => 220,
    'Veg Biryani'     => 180,
    'Chicken Biryani' => 250,
    'Dal Makhani'     => 160,
    'Naan'            => 40,
    'Garlic Bread'    => 80,
    'Pasta'           => 200,
    'Burger'          => 150,
    'Pizza'           => 320,
];

$menuImages = [
    'Butter Chicken'  => 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398?w=400&q=80',
    'Paneer Tikka'    => 'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=400&q=80',
    'Veg Biryani'     => 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400&q=80',
    'Chicken Biryani' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?w=400&q=80',
    'Dal Makhani'     => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=400&q=80',
    'Naan'            => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400&q=80',
    'Garlic Bread'    => 'https://images.unsplash.com/photo-1619531040576-f9416740661d?w=400&q=80',
    'Pasta'           => 'https://images.unsplash.com/photo-1555949258-eb67b1ef0ceb?w=400&q=80',
    'Burger'          => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&q=80',
    'Pizza'           => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400&q=80',
];

$success = "";
$error = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])){

    if($_POST['action'] == 'create'){
        $cname  = htmlspecialchars(trim($_POST['cname']));
        $food   = htmlspecialchars(trim($_POST['food']));
        $qty    = intval($_POST['qty']);
        $addr   = htmlspecialchars(trim($_POST['addr']));
        $mobile = htmlspecialchars(trim($_POST['mobile']));

        //$_SESSION['ordersc'][] = $_ POST['m']
        // $_SESSION['orders'][] = $_POST;

        if($cname && $food && $qty && $addr && $mobile){
            //make this a function if time
            if(!preg_match('/^[0-9]{10}$/', $mobile)){
                $error = "Mobile number must be 10 digits.";
            } elseif($qty < 1){
                $error = "Quantity must be at least 1.";
            } else {
                $price = isset($menu[$food]) ? $menu[$food] :  0;
                $total = $price * $qty;
                //add discounts later
                $id = $_SESSION['next_id']++;
                // autoincrement - works fine for now
                $_SESSION['orders'][$id] = [
                    'id' => $id,
                    'cname' =>  $cname,
                    'food' => $food,
                    'qty' => $qty,
                    'addr' => $addr,
                    'mobile' => $mobile,
                    'price' => $price,
                    'total' => $total,
                    'date' => date('d M Y, h:i A')  // format: 20 May 2026, 03:45 PM
                ];
                $success  = "Order placed successfully!";
            }
        } else {
            $error= "Please fill in all fields.";
        }
    }

    elseif($_POST[' action' ] =='update' ){
        $id = intval($_POST['id']);
        $cname= htmlspecialchars(trim($_POST[ 'cname']));
        $food = htmlspecialchars(trim($_POST[' food']));
        $qty = intval($_POST['qty']);
        $addr= htmlspecialchars(trim($_POST['addr']));
        $mobile = htmlspecialchars(trim($_POST[ 'mobile']));

        if(isset($_SESSION['orders'][ $id]) && $cname && $food && $qty && $addr && $mobile){
            $price= isset($menu[$food]) ? $menu[$food] :0;
            $total= $price *$qty;
            $_SESSION['orders'] [$id]['cname']= $cname;
            $_SESSION['orders'][$id]['food']= $food;
            $_SESSION['orders'][$id]['qty']= $qty;
            $_SESSION['orders'][$id] ['addr']= $addr;
            $_SESSION['orders'][$id]['mobile']= $mobile;
            $_SESSION['orders'][$id] ['price'] =$price;
            $_SESSION['orders'][$id] ['total'] =$total;
            $success ="Order updated!";
        }
    }

    elseif($_POST['action'] =='delete'){
        $id =intval( $_POST['id']);
        
        // array_splice($_SESSION['orders'], $id, 1);
        if(isset($_SESSION[' orders'][$id])){
            unset($_SESSION['orders'][$id]);
            $success=  "Order deleted.";
        }
    }
}

$editOrder= null;
if(isset($_GET['edit ' ])){
    $editId =intval($_GET['edit']);
    if(isset($_SESSION['orders'][$editId])){
        $editOrder =$_SESSION['orders'] [$editId];
    }
}

//newestt orders first
$allOrders =array_reverse($_SESSION['orders' ], true);

$grandTotal =0;
foreach($_SESSION['orders'] as $o){  // $o = order
    $grandTotal += $o['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <title>Hangry -Food Order System</title>
    <link rel= "stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <div class="logo">HANGRY<span>🔥</span></div>
        <div class="header-right">
            <div class="order-count"><?= count($_SESSION['orders']) ?> Orders</div>
            <div class="total-badge">₹<?= number_format($grandTotal, 0) ?> Total</div>
            <span class="logged-user">👤 <?= $_SESSION['username' ] ?></span>
            <a href="index.php?logout=1" class="btn-logout" onclick="return confirm('Logout?')">Logout</a>
        </div>
    </div>
</header>

<section class="hero">
    <div class="hero-img">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1600&q=80" alt="Food">
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <p class="hero-tag">Order Management System</p>
        <h1>Feed The<br><span>Hunger.</span></h1>
        <p class="hero-sub">Fast orders. Hot food. Zero wait. </p>
        <a href="#order-form" class="btn-hero">Place Order Now</a>
    </div>
</section>

<div class="menu-strip">
    <!--correction needed here-->
    <?php foreach($menu as $item => $price): ?>
    <div class="menu-chip">
        <img src="<?= $menuImages[$item] ?>" alt="<?= $item ?>">
        <div class="chip-info">
            <span class="chip-name"><?= $item ?></span>
            <span class="chip-price">₹<?= $price ?></span>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="main-grid">

    <div class="left-col">

        <?php if($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?php if($editOrder): ?>
        <div class="form-card" id="order-form">
            <div class="form-card-header">
                <h2>Edit Order #<?= $editOrder['id'] ?></h2>
            </div>
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= $editOrder['id'] ?>">

                <label>Customer Name</label>
                <input type="text" name="cname" value="<?= $editOrder['cname'] ?>" required>

                <label>Food Item</label>
                <select name="food" required>
                    <?php foreach($menu as $item => $price): ?>
                        <option value="<?= $item ?>" <?= $editOrder['food'] == $item ? 'selected' : '' ?>>
                            <?= $item ?> - Rs.<?= $price ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Quantity</label>
                <input type="number" name="qty" value="<?= $editOrder['qty'] ?>" min="1" required>

                <label>Delivery Address</label>
                <textarea name="addr" required><?= $editOrder['addr'] ?></textarea>

                <label>Mobile Number</label>
                <input type="text" name="mobile" value="<?= $editOrder['mobile'] ?>" maxlength="10" required>

                <button type="submit" class="btn-submit btn-update">Update Order</button>
                <a href="index.php" class="btn-cancel">← Cancel</a>
            </form>
        </div>

        <?php else: ?>
        <div class="form-card" id="order-form">
            <div class="form-card-header">
                <h2>🛒 Place New Order</h2>
            </div>
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="create">

                <label>Customer Name</label>
                <input type="text" name="cname" placeholder="Enter customer name" required>

                <label>Food Item</label>
                <select name="food" required>
                    <option value="">-Select Food Item- </option>
                    <?php foreach($menu as $item => $price): ?>
                        <option value="<?= $item ?>"><?= $item ?> - Rs.<?= $price ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Quantity</label>
                <input type="number" name="qty" placeholder="Enter quantity" min="1" required>

                <label>Delivery Address</label>
                <textarea name="addr" placeholder="Enter delivery address" required></textarea>

                <label>Mobile Number</label>
                <input type="text" name="mobile" placeholder="10-digit mobile number" maxlength="10" required>

                <button type="submit" class="btn-submit">🔥 Place Order</button>
            </form>
        </div>
        <?php endif; ?>

        <div class="bill-card">
            <h3>Bill Summary</h3>
            <div class="bill-row">
                <span>Total Orders</span>
                <strong><?= count($_SESSION['orders']) ?></strong>
            </div>
            <div class="bill-divider"></div>
            <div class="bill-row grand">
                <span>Grand Total</span>
                <strong>₹<?= number_format($grandTotal, 2) ?></strong>
            </div>
        </div>

    </div>

    <div class="right-col">
        <div class="orders-card">
            <div class="orders-header">
                <h2>All Orders</h2>
                <span class="orders-count"><?= count($allOrders) ?></span>
            </div>

            <?php if(empty($allOrders)): ?>
                <div class="empty-state">
                    <div class="empty-icon"></div>
                    <p>No orders yet! Place your first order.</p>
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Food</th>
                                <th>Qty</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Bill</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($allOrders as $o): ?>
                            <tr>
                                <td><span class="order-id">#<?= $o['id'] ?></span></td>
                                <td><strong><?= $o['cname'] ?></strong></td>
                                <td>
                                    <div class="food-cell">
                                        <img src="<?= $menuImages[$o['food']] ?? '' ?>" alt="<?= $o['food'] ?>">
                                        <span><?= $o['food'] ?></span>
                                    </div>
                                </td>
                                <td><span class="qty-badge">x<?= $o['qty'] ?></span></td>
                                <td><?= $o['mobile'] ?></td>
                                <td class="addr-cell"><?= $o['addr'] ?></td>
                                <td><span class="bill-amt">₹<?= number_format($o['total'], 0) ?></span></td>
                                <td>
                                    <div class="action-btns">
                                        <a href="index.php?edit=<?= $o['id'] ?>" class="btn-edit">Edit</a>
                                        <form method="POST" action="index.php" style="display:inline" onsubmit="return confirm('Delete this order?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $o['id'] ?>">
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="tfoot-label">Grand Total</td>
                                <td class="tfoot-total">₹<?= number_format($grandTotal, 0) ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<footer>
    <p>🔥 HANGRY &copy; 2025. All rights reserved.</p>
</footer>

</body>
</html>