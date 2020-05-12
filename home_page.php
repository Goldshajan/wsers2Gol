<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
    #fullContainer {
    display: flex;
    align-items: center;
    justify-content: space-around;
    background-color: salmon;
    }

    img {
    height: 100px;
    transition: height 3s;
    }

    .Product {
    position: relative;
    border: 1px solid red;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 10px;
    text-align: center;
    background-color: springgreen;
    transition: background-color 0.5s;
    }

    .Product:hover {
    background-color: brown;
    }

    .SoldOut {
    position: absolute;
    top: 50%;
    background-color: red;
    }

    a {
    background-color: chartreuse;
    transition: font-size 2s;
    }

    a:hover {
    font-size: larger;
    }
</style>

    </head>
    <body>
        <div id="fullContainer">
            <h1>
                The following are Our products:
            </h1>
            <div id="AllProducts"><?php
            include_once "credentials.php";
            $products = $connection->prepare("SELECT * FROM products");
            $products->execute();
            $resultProducts = $products->get_result();
            while (
              $rowProducts = $resultProducts->fetch_assoc()
            ) { ?><div class="Product">
              <img src="<?php print $rowProducts["Picture"]; ?>" />
              <h4><?php print $rowProducts["Description"]; ?></h4>
              <h3><?php print $rowProducts["Price"]; ?> &euro;</h3>
          </div><?php }
            ?>
        </div>
    </body>
</html>
<!-- <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}

@media only screen and (min-width: 600px) {
  /* For tablets: */
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}
@media only screen and (min-width: 768px) {
  /* For desktop: */
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}
</style>
</head>
<body>

<div class="header">
  <h1>The following are Our products:</h1>
</div>

<div class="row">
  <div class="col-3 col-s-3 menu">
    <ul>
      <li><img src="Carrot.jpg"></li>
      <li>The City</li>
      <li>The Island</li>
      <li>The Food</li>
    </ul>
  </div>

  <div class="col-6 col-s-9">
    <h1></h1>
    <p></p>
  </div>

  <div class="col-3 col-s-12">
    <div class="aside">
      <h2></h2>
      <p></p>
      <h2></h2>
      <p></p>
      <h2</h2>
      <p></p>
    </div>
  </div>
</div>

<div class="footer">
  <p>Resize the browser window to see how the content respond to the resizing.</p>
</div>

</body>
</html>
 -->