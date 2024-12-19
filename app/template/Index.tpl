<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VarTrade - Variable Trading</title>
    <link rel="stylesheet" href="css/Index.css">
</head>

<body>
    <div class="background-overlay"></div>

    <header>
        <nav>
            <div class="logo">VarTrade</div>
        </nav>
    </header>

    <main>
        <div class="search-container">
            <h1>Discover Cryptocurrency Prices</h1>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search coins...">
                <button id="searchButton">
                    <svg viewBox="0 0 24 24" class="search-icon">
                        <path
                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                </button>
            </div>
            <div id="search-results" class="results-container"></div>
        </div>
    </main>

    <script type="module" src="js/Index.js"></script>
    <script type="module" src="js/ui.js"></script>
    <script type="module" src="js/api.js"></script>
</body>

</html>