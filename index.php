<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeavLinh Shop Bread</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
            color: #333;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            background: linear-gradient(to right, #d86e0bff, #fad0c4);
            background-size: cover;
            background-position: center;
            height: 150px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        h2 {
            font-size: 22px;
            color: #222;
            margin: 5px 0 0;
        }

        h1 {
            font-size: 38px;
            color: #222;
            margin: 0;
            text-shadow: 2px 2px #fff;
            font-weight: 700;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s, transform 0.2s;
        }

        nav a:hover {
            color: #222;
            transform: scale(1.1);
        }

        /* Main */
        main {
            padding-top: 180px;
            padding: 20px 5%;
        }

        /* Project Cards */
        .project {
            display: grid;
            gap: 40px;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .project_card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .project_card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        }

        .project_card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .project_card:hover img {
            transform: scale(1.05);
        }

        .project_card a {
            display: block;
            padding: 18px;
            font-weight: 600;
            font-size: 20px;
            text-decoration: none;
            color: #333;
            text-align: center;
            background: #f8f8f8;
        }

        /* Cart Section */
        #cart-section {
            margin-top: 50px;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        #cart-section:hover {
            transform: translateY(-5px);
        }

        #cart-items {
            list-style: none;
            padding: 0;
        }

        #cart-items li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #ccc;
            font-size: 16px;
        }

        #cart-total {
            font-weight: bold;
            text-align: right;
            font-size: 1.3em;
            margin-top: 10px;
            color: #e67e22;
        }

        #checkout-btn {
            background: linear-gradient(to right, #f7971e, #ffd200);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            font-size: 16px;
            margin-top: 10px;
        }

        #checkout-btn:hover {
            background: linear-gradient(to right, #ff8c00, #ffda44);
            transform: scale(1.05);
        }

        /* Modal Checkout */
        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            margin: 8% auto;
            border-radius: 15px;
            width: 90%;
            max-width: 650px;
            position: relative;
            animation: fadeIn 0.4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .close-button {
            float: right;
            font-size: 28px;
            color: #aaa;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-button:hover {
            color: #000;
        }

        .checkout-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }

        .checkout-form input,
        .checkout-form textarea {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            width: 100%;
            margin-bottom: 15px;
            transition: border 0.3s ease;
        }

        .checkout-form input:focus,
        .checkout-form textarea:focus {
            border: 1px solid #007bff;
            outline: none;
        }

        .checkout-form button {
            background: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .checkout-form button:hover {
            background: #217dbb;
            transform: scale(1.05);
        }

        /* Payment Option */
        .payment-options label {
            margin-right: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Order History Link */
        #order-history-link {
            text-align: center;
            margin-top: 30px;
            font-size: 1.1em;
        }

        #order-history-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        #order-history-link a:hover {
            text-decoration: underline;
            color: #1d6fa5;
        }

        /* Footer */
        footer {
            text-align: center;
            background: #333;
            color: #fff;
            padding: 25px;
            margin-top: 60px;
            font-size: 1em;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.15);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        main {
            padding-top: 170px;
            /* header is 150px, this gives extra space */
            padding-left: 5%;
            padding-right: 5%;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">

            <a href="admin_login.php"><img
                    src="https://image.similarpng.com/file/similarpng/original-picture/2020/11/Coffee-logo-design-on-transparent-background-PNG.png"
                    alt="Shop Logo">
                <h2>SeavLinh2026</h2>
            </a>
        </div>
        <h1>SeavLinh Shop Bread</h1>
        <nav>
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
            <a href="porj.html">Projects</a>
            <a href="contact.html">Contact</a>
        </nav>
    </header>
    <main>
        <section class="project">
            <div class="project_card">
                <a href="project1.php">Order Bread
                    <img src="https://images.squarespace-cdn.com/content/v1/5da3c95574c72c273ebc24c6/cb91a63a-e233-4ddf-85e9-b5858733419e/20231005-Bread-SHop2207.jpg"
                        alt="Bread Section"></a>
            </div>
            <div class="project_card">
                <a href="project2.php">Order Coffee
                    <img src="https://img.pikbest.com/templates/20250228/psd-menu-coffee-shop-or-restaurant-template_11564229.jpg!w700wp"
                        alt="Coffee Section"></a>
            </div>
            <div class="project_card">
                <a href="project3.php">Order Cake
                    <img src="https://img.pikbest.com/templates/20210514/bg/7b3155ec1a303e5b23f21a086d9591cf_4194.png!sw800"
                        alt="Cake Section"></a>
            </div>
        </section>

        <section id="cart-section">
            <h2>Your Shopping Cart</h2>
            <ul id="cart-items">
                <p>Your cart is empty.</p>
            </ul>
            <p id="cart-total">Total: $0.00</p>
            <button id="checkout-btn">Checkout</button>
            <div style="clear: both;"></div>
        </section>

        <div id="checkoutModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Checkout Information</h2>
                <form id="checkoutForm" class="checkout-form">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="e.g., 012345678" required>
                    <button type="button" id="lookupUserBtn">Lookup Info</button>

                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="address">Delivery Address:</label>
                    <input id="address" name="address" type="text" placeholder="Enter your address" required>


                    <section class="payment-options p-4 bg-white rounded shadow-md max-w-md mx-auto">
                        <h2 class="text-lg font-semibold mb-4 text-gray-700">Payment Method</h2>
                        <div class="flex flex-col gap-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="QR" checked
                                    class="form-radio h-5 w-5 text-blue-600" />
                                <img src="./BankQRcode.jpg" alt="QR Code" class="max-w-[6%] max-h--x object-contain"
                                    style="max-height: 500px;" />
                                <span class="text-gray-800 font-medium">QR Code</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="Cash on Delivery"
                                    class="form-radio h-5 w-5 text-blue-600" />
                                <span class="text-gray-800 font-medium">Cash on Delivery</span>
                            </label>
                        </div>
                    </section>



                    <button type="submit">Place Order</button>
                </form>
            </div>
        </div>

        <div id="order-history-link">
            <p><a href="order_history.php">View Your Order History</a></p>
        </div>

    </main>

    <?php include 'footer.php'; ?>


    <script src="js/script.js"></script>


</body>

</html>