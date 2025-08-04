<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Bread</title>
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
        background-image: url("https://media.istockphoto.com/id/1184226145/photo/bakery-shelf-with-many-types-of-bread-tasty-german-bread-loaves-on-the-shelves_.jpg?s=612x612&w=0&k=20&c=WufwyEvYxDNgbHIPxOUtU4Vi_Krn5neLqK5AU2tGUHo=");
        background-size: cover;
        background-position: center;
        color: white;
        border: 2px solid black;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
        position: fixed;
        top: 0;
        width: 100%;
        gap: 30px;

    }


    h2 {
        font-size: 60px;
        font-family: 'Courier New', Courier, monospace;
        margin: 0;
        text-align: center;
    }


    main {
        padding-top: 170px;

        padding-left: 5%;
        padding-right: 5%;
        padding-bottom: 20px;

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
        /* Ensures images fill their space nicely */
        border-radius: 8px;
        margin-bottom: 10px;
    }


    .bread h3 {
        margin: 10px 0 5px;
        font-size: 1.2em;
        color: #333;
        text-align: center;
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
        font-size: 1.1em;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Hover effect for quantity control buttons */
    .quantity-control button:hover {
        background-color: #777;
    }

    /* Styling for the quantity number display */
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
    }

    .back-to-home a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        padding: 10px 20px;
        border: 1px solid #007bff;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;

    }

    .back-to-home a:hover {
        background-color: #007bff;
        color: white;
    }

    main {
        padding-top: 170px;
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
        <h2>Order Bread</h2>
    </header>

    <main>
        <section class="orderbread">
            <div class="bread" data-name="Whole Wheat Bread" data-price="4.00">
                <img src="https://tastesbetterfromscratch.com/wp-content/uploads/2022/01/Whole-Wheat-Bread25-1.jpg"
                    alt="Whole Wheat Bread" />
                <h3>Whole Wheat Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="French Bread" data-price="4.00">
                <img src="https://kirbiecravings.com/wp-content/uploads/2023/10/4-ingredient-french-bread-8.jpg"
                    alt="French Bread" />
                <h3>French Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Rye Bread" data-price="4.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSehbIS2dHz8WsL64lWMycejRwEO8QsKHbo-g&s"
                    alt="Rye Bread" />
                <h3>Rye Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Banana Bread" data-price="4.00">
                <img src="https://www.onceuponachef.com/images/2011/04/Best-Banana-Bread-1200x1370.jpg"
                    alt="Banana Bread" />
                <h3>Banana Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Cheesy Garlic Bread" data-price="4.00">
                <img src="https://www.cookingclassy.com/wp-content/uploads/2015/07/cheesy-garlic-bread-1.jpg"
                    alt="Cheesy Garlic Bread" />
                <h3>Cheesy Garlic Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Japanese Milk Bread" data-price="3.00">
                <img src="https://www.justonecookbook.com/wp-content/uploads/2022/05/Japanese-Milk-Bread-Shokupan-I-1.jpg"
                    alt="Japanese Milk Bread" />
                <h3>Japanese Milk Bread</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Milk Bread" data-price="4.00">
                <img src="https://assets.epicurious.com/photos/62014c8562bef6b97b61bce2/4:3/w_5365,h_4024,c_limit/MilkBread_RECIPE_020322_088.jpg"
                    alt="Milk Bread" />
                <h3>Milk Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Sourdough Bread" data-price="4.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ6GFohRsGTV_zXWTI2froyRW5ddcTeRpKZfQ&s"
                    alt="Sourdough Bread" />
                <h3>Sourdough Bread</h3>
                <p class="price-display">Price: $4.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Brioche Bread" data-price="3.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_7yoNlA_WJWvZ2TYU7pqKLm9h0B3-sqi5IA&s"
                    alt="Brioche Bread" />
                <h3>Brioche Bread</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Ciabatta Bread" data-price="3.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1vz8YrU6346sA4GW_027_EdOUNwBc2_iGFHepgYLJmFDPSmorRygGJa34iQ9DcI6YFgI&usqp=CAU"
                    alt="Ciabatta Bread" />
                <h3>Ciabatta Bread</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="French Toast Bread" data-price="3.00">
                <img src="https://preview.redd.it/french-toast-or-eggy-bread-v0-jwdkyqd1dlhe1.jpeg?auto=webp&s=936a22e2bb38227a4105360b25c84dab7c56a360"
                    alt="French Toast Bread" />
                <h3>French Toast Bread</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Cornbread" data-price="3.00">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS606PgG9Ar8QLdW4GLLMK4OWWTnqPR_atwzg&s"
                    alt="Cornbread" />
                <h3>Cornbread</h3>
                <p class="price-display">Price: $3.00</p>
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