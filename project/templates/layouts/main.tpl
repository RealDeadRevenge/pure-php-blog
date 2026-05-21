<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{$title|default:'PHP Blog'}</title>

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>
                <a href="/">
                    PHP Blog
                </a>
            </h1>
        </div>
    </header>

    <main class="container">
        {$content}
    </main>
</body>
</html>