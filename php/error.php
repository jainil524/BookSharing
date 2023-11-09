<style>
@import url('https://fonts.googleapis.com/css2?family=Lora&family=Open+Sans:wght@500&family=Poppins&family=Space+Mono:wght@400;700&display=swap');
body {
    font-size: 26px;
}

.container {
    width: 80%;
    height: 80%;
    margin: auto;
    text-align: center;
}

.container h1 {
    height: 13rem;
    font-size: 10rem;
    background: linear-gradient(to bottom right, #33ccff 0%, #ff99cc 100%);
    background-clip: content-box;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.container h3 {
    font-size: 2rem;
    text-transform: uppercase;
    color: rgb(107, 103, 103);
    margin-bottom: 1rem;
}

.container p {
    width: 60%;
    margin: auto;
}

.btn {
    border-radius: 20rem;
    border: none;
    padding: .5rem 2rem;
    background: #23abd9;
    font-weight: 130;
    letter-spacing: .02rem;
    word-spacing: .2rem;
    margin-top: 1rem;
}

.btn a {
    text-decoration: none;
}

@media screen and (max-width: 700px) {
    .container p {
        width: 80%;
    }
}

@media screen and (max-width: 460px) {
    .container h1 {
        font-size: 7rem;
        height: 10rem;
    }
    .container h3 {
        font-size: 1.2rem;
    }
    .container p {
        width: 95%;
    }
}
</style>
<link rel="stylesheet" href="css/error.css">
<div class="container">
    <h1><?php echo $erro_code; ?></h1>
    <h3><?php echo $erro_title; ?></h3>
    <p><?php echo $erro_desc; ?></p>
    <button class="btn"><a href="index.php"> Return Home</a></button>
</div>
</body>

</html>