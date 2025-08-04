<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Coffee</title>
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
        background-image: url("https://images.unsplash.com/photo-1511920170033-d86b977be1bf?q=80&w=1000&auto=format&fit=crop");
        background-size: cover;
        background-position: center;
        color: white;
        border: 2px solid black;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2),
            0 6px 20px rgba(0, 0, 0, 0.19);
        position: fixed;
        top: 0;
        width: 100%;
    }

    h2 {
        font-size: 60px;
        font-family: 'Courier New', Courier, monospace;
        margin: 0;
    }

    main {
        padding-top: 170px;
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
        width: 80%;
        transition: background-color 0.3s ease;
    }

    .add-to-cart-btn:hover {
        background-color: #45a049;
    }

    .back-to-home {
        text-align: center;
        margin-top: 40px;
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
        <h2>Order Coffee</h2>
    </header>

    <main>
        <section class="orderbread">
            <div class="bread" data-name="Espresso" data-price="2.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571187.jpg?width=%s" alt="Espresso" />
                <h3>Espresso</h3>
                <p class="price-display">Price: $2.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Latte" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571185.jpg?width=%s" alt="Latte" />
                <h3>Latte</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Cappuccino" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571178.jpg?width=%s" alt="Cappuccino" />
                <h3>Cappuccino</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Americano" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571182.jpg?width=%s" alt="Americano" />
                <h3>Americano</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Mocha" data-price="2.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571191.jpg?width=%s " alt="Mocha" />
                <h3>Mocha</h3>
                <p class="price-display">Price: $2.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Caramel Macchiato" data-price="3.00">
                <img src=" https://images.deliveryhero.io/image/fd-kh/products/3571180.jpg?width=%s"
                    alt="Caramel Macchiato" />
                <h3>Caramel Macchiato</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Cold Brew" data-price="3.00">
                <img src=" https://images.deliveryhero.io/image/fd-kh/products/3571184.jpg?width=%s" alt="Cold Brew" />
                <h3>Cold Brew</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Frappuccino" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571183.jpg?width=%s" alt="Frappuccino" />
                <h3>Frappuccino</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </section>
        <section class="orderbread">
            <div class="bread" data-name="Matcha Latte" data-price="2.00">
                <img src=" https://images.deliveryhero.io/image/fd-kh/products/3571186.jpg?width=%s"
                    alt="Matcha Latte" />
                <h3>Matcha Latte</h3>
                <p class="price-display">Price: $2.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Chai Latte" data-price="3.00">
                <img src=" https://images.deliveryhero.io/image/fd-kh/products/3571179.jpg?width=%s" alt="Chai Latte" />
                <h3>Chai Latte</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Hot Chocolate" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/Products/3518303.jpg?width=%s"
                    alt="Hot Chocolate" />
                <h3>Hot Chocolate</h3>
                <p class="price-display">Price: $3.00</p>
                <div class="quantity-control">
                    <button class="decrease-quantity">-</button>
                    <span class="quantity">0</span>
                    <button class="increase-quantity">+</button>
                </div>
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
            <div class="bread" data-name="Iced Tea" data-price="3.00">
                <img src="https://images.deliveryhero.io/image/fd-kh/products/3571188.jpg?width=%s" alt="Iced Tea" />
                <h3>Iced Tea</h3>
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