<html> 
    <head>
        <title>Login with PHP</title>
        <link rel="stylesheet" href="/website/css/index.css">
        <link rel="stylesheet" href="/website/css/header.css">
        <link rel="stylesheet" href="/website/css/footer.css">
    </head>
    <body>
        <style>
            body > div {
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        </style>
        <div>
            <?php include './website/components/header.php'; ?>
            <?php include './website/components/authentication-form.php'; ?>
            <?php include './website/components/footer.php'; ?>
        </div>
    </body>
 </html>