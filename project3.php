<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Cake</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: sans-serif;
            background-color: #f4f4f4;
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            height: 150px;
            background-color: pink;
            background-image: url(" https://live.staticflickr.com/7034/6442775471_f9edee90b0_b.jpg");
            /* Cake image */
            background-size: cover;
            color: white;
            border: 2px solid black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
            position: fixed;
            top: 0;
            width: 100%;
            gap: 30px;
            z-index: 1000;
        }

        h2 {
            font-size: 40px;
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            text-align: center;
            font-size: 60px;
        }

        main {
            padding-top: 170px;
            /* Adjusted padding to clear fixed header */
            padding: 20px;
        }

        .orderbread {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .bread {
            border: 2px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            background-color: #fff;
            height: 480px;
            /* Adjusted height to fit all elements */
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .bread:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .bread img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .bread h3 {
            margin: 10px 0 5px;
            font-size: 1.2em;
            color: #333;
        }

        .price-display {
            font-size: 1.1em;
            font-weight: bold;
            color: #e91e63;
            margin-bottom: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .quantity-control button {
            background-color: #999;
            border: none;
            color: white;
            padding: 8px 15px;
            text-align: center;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .quantity-control button:hover {
            background-color: #777;
        }

        .quantity-control span {
            font-size: 1.2em;
            font-weight: bold;
            min-width: 40px;
            text-align: center;
            margin: 0 8px;
            background-color: #f0f0f0;
            padding: 5px 0;
            border-radius: 5px;
            color: #333;
        }

        .add-to-cart-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
            align-self: center;
            width: 80%;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #45a049;
        }

        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 1.1em;
            text-align: left;
            align-items: left;
        }

        .back-to-home a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-align: left;
            align-items: left;
        }

        .back-to-home a:hover {
            background-color: #007bff;
            color: white;
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
        <div class="back-to-home">
            <a href="index.php">Back to Home Page</a>
        </div>
        <h2>Order Cake</h2>
    </header>

    <main>
        <section class="orderbread">
            <div class="bread" data-name="Chocolate Truffle Cake" data-price="20.00">
                <img src="https://tfcakes.in/images/products/230201_031323_666_454.jpg" alt="Chocolate Truffle Cake" />
                <h3>Chocolate Truffle Cake</h3>
                <p class="price-display">Price: $20.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Vanilla Fruit Cake" data-price="25.00">
                <img src="https://assets.giftalove.com/resources/common/giftimages/productimage2/creamy-vanilla-fruit-cake.jpg"
                    alt="Vanilla Fruit Cake" />
                <h3>Vanilla Fruit Cake</h3>
                <p class="price-display">Price: $25.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Fruit Overload Cake" data-price="30.00">
                <img src="https://www.fnp.com/images/pr/x/v20241007112036/fruit-overload-cake-1-kg_1.jpg"
                    alt="Fruit Overload Cake" />
                <h3>Fruit Overload Cake</h3>
                <p class="price-display">Price: $30.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Fully Loaded Chocolate Truffle" data-price="27.00">
                <img src="https://zukachocolates.com/wp-content/uploads/2021/03/FULLY-LOADED-CHOCOLATE-TRUFFLE-CAKE-1.jpg"
                    alt="Fully Loaded Chocolate Truffle" />
                <h3>Fully Loaded Chocolate Truffle</h3>
                <p class="price-display">Price: $27.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Special Occasion Cake" data-price="19.00">
                <img src="https://www.ambalacakes.com/data/cache/images/cakes/special-occasions/womens-day/chocolates-cakes-440x440.webp"
                    alt="Special Occasion Cake" />
                <h3>Special Occasion Cake</h3>
                <p class="price-display">Price: $19.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Birthday Chocolate Dripping Cake" data-price="50.00">
                <img src="https://cruff.in/cdn/shop/files/Birthday_Chocolate_Dripping_cake_7c3eb254-138b-4561-bf0a-909e101442b2.jpg?crop=center&height=375&v=1731564763&width=375"
                    alt="Birthday Chocolate Dripping Cake" />
                <h3>Birthday Chocolate Dripping Cake</h3>
                <p class="price-display">Price: $50.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Blueberry Cream Cake" data-price="35.00">
                <img src="https://medcakes.co.uk/wp-content/uploads/2021/06/BC-36.jpg" alt="Blueberry Cream Cake" />
                <h3>Blueberry Cream Cake</h3>
                <p class="price-display">Price: $35.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Rainbow Sprinkles Cake" data-price="32.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7x6786VLvfSL2E7XqCKdbO6W844Acv2y5aA&s"
                    alt="Rainbow Sprinkles Cake" />
                <h3>Rainbow Sprinkles Cake</h3>
                <p class="price-display">Price: $32.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Vegan Rainbow Cake" data-price="20.00">
                <img src="https://d1b8m1fazs6o9v.cloudfront.net/eyJidWNrZXQiOiJwcm9kLWZlcmd1c29ucGxhcnJlLWFzc2V0cyIsImtleSI6ImNhdGFsb2cvcHJvZHVjdC92L2UvdmVnYW5fcmFpbmJvd19zcHJpbmtsc2VfZGVjdmVnNi5qcGciLCJlZGl0cyI6eyJyZXNpemUiOnsid2lkdGgiOjUwMCwiaGVpZ2h0IjoxMDAsImZpdCI6ImNvbnRhaW4iLCJiYWNrZ3JvdW5kIjp7InIiOjI1NSwiZyI6MjU1LCJiIjoyNTUsImFscGhhIjoxfX19fQ==?signature=5fb2cc437a0276c85b7d786be8c3fe612f4dbc0b32435ac7337b8cba7826771a"
                    alt="Vegan Rainbow Cake" />
                <h3>Vegan Rainbow Cake</h3>
                <p class="price-display">Price: $20.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Heart Shaped Raspberry Lemon Cake" data-price="22.00">
                <img src="https://www.rainbownourishments.com/wp-content/uploads/2024/02/heart-shaped-cake-decorating-tutorial-vegan-raspberry-lemon-1.jpg"
                    alt="Heart Shaped Raspberry Lemon Cake" />
                <h3>Heart Shaped Raspberry Lemon Cake</h3>
                <p class="price-display">Price: $22.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Unicorn Cake" data-price="23.00">
                <img src="https://www.loveitcakes.com.au/cdn/shop/files/P1010318.jpg?v=1708397384&width=1946"
                    alt="Unicorn Cake" />
                <h3>Unicorn Cake</h3>
                <p class="price-display">Price: $23.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Pink Shaded Rose Cake" data-price="15.00">
                <img src="https://i0.wp.com/ovenfresh.in/wp-content/uploads/2023/02/Pink-Shaded-Cake-With-Assorted-Fresh-Roses-1kg-1.jpg?fit=3456%2C3456&ssl=1"
                    alt="Pink Shaded Rose Cake" />
                <h3>Pink Shaded Rose Cake</h3>
                <p class="price-display">Price: $15.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>

    </main>
    <script src="js/script.js"></script>
</body>

</html>